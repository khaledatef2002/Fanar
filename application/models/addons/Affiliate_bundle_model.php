<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliate_bundle_model extends CI_Model
{
    public function get__affiliator_status_table_info_by_user_id($user_id="")
    {
        return $this->db->where(array('user_id' => $user_id))->get('affiliator_status')->row_array();
    }
    public function get_user_by_unique_identifier($unique_identifier = "")
    {
        // for getting the parent of ref code 
        return  $this->db->get_where('affiliator_status', array('unique_identifier' => $unique_identifier))->row_array();
    }
    public function get_user_by_their_unique_identifier($unique_identifier = "")
    {
        return  $this->db->get_where('affiliator_status', array('unique_identifier' => $unique_identifier))->row_array();
    }
    public function get_userby_id($id = "")
    {
        return  $this->db->get_where('users', array('id' => $id))->row_array();
    }
}