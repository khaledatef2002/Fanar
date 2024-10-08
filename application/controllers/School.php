<?php
defined('BASEPATH') or exit('No direct script access allowed');

class School extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));

        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('stripe');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


        // CHECK CUSTOM SESSION DATA
        $this->user_model->check_session_data();


        //CHECKING COURSE ACCESSIBILITY STATUS
        if (get_settings('course_accessibility') != 'publicly' && !$this->session->userdata('user_id')) {
            redirect(site_url('login'), 'refresh');
        }

        //If user was deleted
        if ($this->session->userdata('user_login') && $this->user_model->get_all_user($this->session->userdata('user_id'))->num_rows() == 0) {
            $this->user_model->session_destroy();
        }

        ini_set('memory_limit', '1024M');
    }

    public function index()
    {
        $this->home();
    }

    public function home()
    {
        $page_data['page_name'] = "school";
        $page_data['page_title'] = site_phrase('school');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function get_sub_categories()
    {
        $id = $this->input->post('id');
        $sub_categories = $this->crud_model->get_sub_categories($id);

        $data['sub_categories'] = $sub_categories;
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/school_categories', $data);
    }

    public function get_courses()
    {
        $id = $this->input->post('id');

        $this->db->where('sub_category_id', $id);
        $this->db->where('status', "active");
        $courses = $this->db->get('course');

        $data['courses'] = $courses->result();


        $this->db->where('sub_category_id', $id);
        $this->db->where('status', "1");
        $bundles = $this->db->get('course_bundle');

        $data['bundles'] = $bundles->result();

        $data['id'] = $id;

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/school_courses', $data);
    }
}
