<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coupon_model extends CI_Model
{
    private $error_message = "";
    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    function get_error() : string
    {
        return $this->error_message;
    }
    function is_coupon_conditions_appliable_bundle($coupon_code, $bundle_id) 
    {
        $coupon_details = $this->crud_model->get_coupon_details_by_code($coupon_code)->row_array();
        $bundle_details = $this->db->get_where('course_bundle', array('id', $bundle_id))->row_array();

        $expiry = $this->check_coupon_expiry($coupon_code);
        if(!$expiry) return false;

        $student = $this->is_coupon_student($coupon_details);
        if(!$student) return false;

        $bundle = $this->is_coupon_bundle($coupon_details, $bundle_id);
        if(!$bundle) return false;

        $min = $this->is_bundle_min($coupon_details, $bundle_details);
        if(!$min) return false;

        return true;
    }

    function is_coupon_conditions_appliable_cart($coupon_code, array $cart) 
    {
        $coupon_details = $this->crud_model->get_coupon_details_by_code($coupon_code)->row_array();

        $expiry = $this->check_coupon_expiry($coupon_code);
        if(!$expiry) return false;

        $student = $this->is_coupon_student($coupon_details);
        if(!$student) return false;

        $included = $this->get_included_cart_price($coupon_details, $cart);
        if($included == 0)
        {
            $this->error_message = get_phrase('This coupon not for these cart');
            return false;
        }

        $min = $this->is_cart_minmum($coupon_details, $included);
        if(!$min) return false;

        return true;
    }

    public function calc_discount_bundle($coupon_code, $bundle_id)
    {
        $coupon_details = $this->crud_model->get_coupon_details_by_code($coupon_code)->row_array();

        $bundle_details = $this->crud_model->get_bundles($bundle_id)->row_array();

        if($coupon_details['discount_type'] == 'percent'):
            $bundle_price = $bundle_details['price'];
            $coupon_discount = $coupon_details['discount'];
            //Percent Type
            return ($bundle_price * $coupon_discount) / 100;
        else:
            //Fixed Type
            return ($bundle_details['price'] < $coupon_details['discount']) ? $bundle_details['price'] : $coupon_details['discount'];
        endif; 
    }

    private function is_coupon_student(array $coupon_details) : bool
    {
        if($coupon_details['students'] == 1)
        {   
            $validty_student = $this->db->get_where('coupon_student', array('coupon_id' => $coupon_details['id'], 'student_id' => $this->session->userdata('user_id')));
            if($validty_student->num_rows() == 0){
                $this->error_message = get_phrase('Coupon code isn\'t avillable for you');
                return false;
            }
        }
        return true;
    }

    private function is_coupon_bundle(array $coupon_details, int $bundle_id) : bool 
    {
        if($coupon_details['bundles'] == 1)
        {
            $validty_bundle = $this->db->get_where('coupon_bundle', array('coupon_id' => $coupon_details['id'], 'bundle_id' => $bundle_id));
            if($validty_bundle->num_rows() == 0)
            {
                $this->error_message = get_phrase('Coupon code isn\'t avillable for this bundle');
                return false;
            }
        }
        if(($coupon_details['categories'] == 1 || $coupon_details['sub_categories'] == 1) && $coupon_details['bundles'] == 0) {
            $this->error_message = get_phrase('Coupon code isn\'t avillable for this bundle');
            return false;
        } 
        return true;
    }

    private function is_bundle_min($coupon_details, $bundle_details) : bool 
    {
        if($coupon_details['min'] > 0 && $coupon_details['min'] > $bundle_details['price']):
            $this->error_message = get_phrase('coupon order min') . " " . currency($coupon_details['min']);
            return false;
        endif;

        return true;
    }

    private function check_coupon_expiry($coupon_code) : bool 
    {
        if(!$this->crud_model->check_coupon_validity($coupon_code))
        {
            $this->error_message = get_phrase('Your coupon code has expired');
            return false;
        }
        return true;
    }

    function get_included_cart_price($coupon_details, $cart)
    {
        $included_price = 0;

        foreach($cart as $item):
            $course_details = $this->crud_model->get_course_by_id($item)->row_array();
            $item_valid = $this->is_item_valid($coupon_details, $course_details);
            if ($item_valid)
            {
                $included_price += $course_details['price'];
                $included_price += $course_details['discount_flag'];
            }
        endforeach;

        return $included_price;
    }

    private function is_item_valid($coupon_details, $course_details)
    {
        if($coupon_details['categories'] == 1 || $coupon_details['sub_categories'] == 1 || $coupon_details['bundles'] == 1):
            $category_validty = $this->db->get_where('coupon_category', array('coupon_id' => $coupon_details['id'], 'category_id' => $course_details['category_id']));
            $sub_category_validty = $this->db->get_where('coupon_sub_category', array('coupon_id' => $coupon_details['id'], 'sub_category_id' => $course_details['sub_category_id']));
            if($category_validty->num_rows() > 0 || $sub_category_validty->num_rows() > 0):
                return true;
            endif;
            return false;
        endif;
        return true;
    }

    private function is_cart_minmum(array $coupon_details, $included_price)
    {
       if($coupon_details['min'] > 0 && $coupon_details['min'] > $included_price) :
        $this->error_message = get_phrase('coupon order min') . " " . currency($coupon_details['min']);
        return false;
       endif;

       return true;
    }

    function calc_cart_discount(array $coupon_details, $cart)
    {
        $included_price = $this->get_included_cart_price($coupon_details, $cart);

        if($coupon_details['discount_type'] == 'percent'):
            //Percent Type
            $coupon_discounted_price = ($included_price * $coupon_details['discount']) / 100;
        else:
            //Fixed Type
            $coupon_discounted_price = ($included_price < $coupon_details['discount']) ? 0 : $coupon_details['discount'];
        endif;

        $coupon_discounted_price = $included_price >= $coupon_discounted_price ? $coupon_discounted_price : $included_price;

        return $coupon_discounted_price;
    }
}