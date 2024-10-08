<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bootcamp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(get_settings('timezone'));
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->user_model->check_session_data();
        $this->load->model('addons/bootcamp_model');
        date_default_timezone_set(get_settings('timezone'));
    }

    /*--------------------------------------------------------------------------------------------------*/
    //                                       reuseable functions
    /*--------------------------------------------------------------------------------------------------*/
    function sendRes($type = '', $msg = '', $url = '')
    {
        $msg_type = 'flash_message';
        if ($type == 'err') {
            $msg_type = 'error_message';
        }
        $this->session->set_flashdata($msg_type, site_phrase($msg));
        if ($url != '') {
            redirect(site_url($url), 'refresh');
        }
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    //                                       1. load all live classes
    /*--------------------------------------------------------------------------------------------------*/

    function list()
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'bootcamp_list';
        $page_data['page_title'] = get_phrase('bootcamp_list');
        $page_data['bootcamps'] = $this->db->where('owner_id', $this->session->userdata('user_id'))->get('bootcamp');
        $this->load->view('backend/index.php', $page_data);
    }

    //                                       2. bootcamp category
    /*--------------------------------------------------------------------------------------------------*/
    function category($action = '', $param = '')
    {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        if ($action == '') {
            $page_data['page_name'] = 'category';
            $page_data['page_title'] = get_phrase('category');
            $this->load->view('backend/index.php', $page_data);
        } elseif ($action == 'form') {
            $this->load->view('backend/admin/category_form.php');
        } elseif ($action == 'add') {
            $add = $this->bootcamp_model->category_action('add');
            $this->sendRes($add[0], $add[1]);
        } elseif ($action == 'edit') {
            $category = $this->bootcamp_model->get_table('bootcamp_category', $param)->row_array();
            $this->load->view('backend/admin/category_form.php', compact('category'));
        } elseif ($action == 'update') {
            $update = $this->bootcamp_model->category_action('update', $param);
            $this->sendRes($update[0], $update[1]);
        } elseif ($action == 'delete') {
            $delete = $this->bootcamp_model->delete_item('bootcamp_category', $param);
            if ($delete) {
                $this->sendRes('', 'category_deleted.');
            }
        }
    }

    //                                       3. bootcamp crud action
    /*--------------------------------------------------------------------------------------------------*/
    function action($action, $param = '')
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        if ($action == 'form') {
            $page_data['page_name'] = 'bootcamp_form';
            $page_data['page_title'] = get_phrase('bootcamp_form');
            $this->load->view('backend/index.php', $page_data);
        } elseif ($action == 'create') {
            $add = $this->bootcamp_model->bootcamp_action('add');
            if ($add) {
                $this->sendRes($add[0], $add[1], $add[2]);
            }
        } elseif ($action == 'edit') {
            // check ownership
            $owned = $this->bootcamp_model->has_ownership($param, 'bootcamp');
            if (!$owned) {
                $this->sendRes('err', 'data_not_found.', 'addons/bootcamp/list');
            }

            $page_data['page_name'] = 'bootcamp_form';
            $page_data['page_title'] = get_phrase('edit_bootcamp');
            $page_data['bootcamp_id'] = $param;

            $this->db->select('bootcamp.*, bootcamp_category.category_name as category_title');
            $this->db->from('bootcamp');
            $this->db->where('bootcamp.id', $param);
            $this->db->join('bootcamp_category', 'bootcamp.category = bootcamp_category.id');
            $page_data['bootcamp_details'] = $this->db->get()->row_array();

            $this->db->where('bootcamp_id', $param);
            $live_class = $this->db->get('bootcamp_live_class')->result_array();

            // enable live class if time schedule matched
            foreach ($live_class as $class) {
                if (time() >= ($class['class_schedule'] - (60 * 15)) && (time() - 60) <= $class['estimated_time']) {
                    $this->db->where('live_class_id', $class['id']);
                    $this->db->where('status', 'active');
                    $existing_class = $this->db->get('bootcamp_online_class')->row_array();
                    if (!$existing_class) {
                        $start_class = $this->generate_class_link($class['id']);
                    }
                }
            }
            $this->load->view('backend/index.php', $page_data);
        } elseif ($action == 'update') {
            // check ownership
            $owned = $this->bootcamp_model->has_ownership($param, 'bootcamp');
            if (!$owned) {
                $this->sendRes('err', 'data_not_found.', 'addons/bootcamp/live_classes');
            }

            $update = $this->bootcamp_model->bootcamp_action('update', $param);
            if ($update) {
                $this->sendRes($update[0], $update[1]);
            }
        } elseif ($action == 'delete') {
            $delete = $this->bootcamp_model->delete_item('bootcamp', $param);
            if ($delete) {
                $this->sendRes('', 'bootcamp_deleted.');
            }
        }
    }

    //                                       4. bootcamp module action
    /*--------------------------------------------------------------------------------------------------*/
    function module($action, $param = '')
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        if ($action == 'edit' || $action == 'update' || $action == 'delete') {
            $owned = $this->bootcamp_model->has_ownership($param, 'module');
        } elseif ($action == 'form' || $action == 'sort') {
            $owned = $this->bootcamp_model->has_ownership($param, 'bootcamp');
        }

        if (isset($owned) && !$owned) {
            $this->sendRes('err', 'data_not_found.');
        }

        if ($action == 'form') {
            $bootcamp_id = $param;
            $this->load->view('backend/admin/module_form.php', compact('bootcamp_id'));
        } elseif ($action == 'add') {
            $add = $this->bootcamp_model->module_action('add', $param);
            $this->sendRes($add[0], $add[1]);
        } elseif ($action == 'edit') {
            $module = $this->bootcamp_model->get_table('bootcamp_modules', $param)->row_array();
            $this->load->view('backend/admin/module_form.php', compact('module'));
        } elseif ($action == 'update') {
            $update = $this->bootcamp_model->module_action('update', $param);
            $this->sendRes($update[0], $update[1]);
        } elseif ($action == 'delete') {
            $delete_category = $this->bootcamp_model->delete_item('bootcamp_modules', $param);
            $this->sendRes('', 'Module deleted.');
        } elseif ($action == 'sort') {
            $id = $param;
            $this->load->view('backend/admin/module_sort.php', compact('id'));
        } elseif ($action == 'update_sorted_modules') {
            $section_modules = $this->input->post('itemJSON');
            $this->bootcamp_model->module_action('update_sorted_module', $section_modules);
        }
    }

    // generate a class link when time matches class schedule
    public function generate_class_link($id)
    {
        // general user can not create a class link
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            return 'admin and instructor access only';
        }

        // check old class
        $this->db->where('live_class_id', 14);
        $this->db->where('status !=', 'complete');
        $check_old_class = $this->db->get('bootcamp_online_class')->row_array();
        if ($check_old_class) {
            return 'class in progress.';
        }

        // check class schedule
        $this->db->where('id', $id);
        $live_class = $this->db->get('bootcamp_live_class')->row_array();
        if (time() < ($live_class['class_schedule'] - (60 * 15))) {
            return 'not available.';
        }

        // check old class status
        $this->db->where('live_class_id', $id);
        $has_online_class = $this->db->get('bootcamp_online_class')->result_array();
        if (count($has_online_class) > 0) {
            $old_schedule = $has_online_class[count($has_online_class) - 1]['schedule'];
            if ($live_class['class_schedule'] == $old_schedule) {
                return 'start class with new date.';
            }
        }

        // check module schedule
        $this->db->where('id', $live_class['module_id']);
        $module = $this->db->get('bootcamp_modules')->row_array();

        $lock = NULL;
        if ($module['restricted_by'] == 'date_range' && (time() < $module['class_start'] || time() > $module['class_end'])) {
            return 'module schedule mis matched.';
        } elseif ($module['restricted_by'] == 'start_date' && time() < $module['class_start']) {
            return 'module schedule mis matched.';
        }

        // start new class
        $user = $this->bootcamp_model->get_table('users', $this->session->userdata('user_id'))->row_array();
        $data['owner_id'] = $user['id'];
        $data['live_class_id'] = $id;

        $class = $this->bootcamp_model->get_table('bootcamp_live_class', $id)->row_array();
        $data['bootcamp_id'] = $class['bootcamp_id'];

        // start and insert a new online class
        $make_pass = str_shuffle($user['first_name'] . $user['last_name'] . $user['email']);
        $make_pass = explode(' ', $make_pass);
        $join_pass = implode('', $make_pass);
        $data['pass'] = $join_pass;
        $data['link'] = site_url('/addons/bootcamp/online_class/' . strtolower($class['title']) . '/' . $id);
        $data['status'] = 'active';
        $data['room_name'] = get_settings('system_name') . '-' . uniqid();
        $data['schedule'] = $live_class['class_schedule'];
        $data['added_date'] = time();
        $data['updated_date'] = $data['added_date'];

        if ($this->db->insert('bootcamp_online_class', $data)) {
            return $data['link'];
        }
        return FALSE;
    }

    // admin join online class
    function online_class($param, $id)
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        $user = $this->bootcamp_model->get_table('users', $this->session->userdata('user_id'))->row_array();
        $class_details['owner_id'] = $user['id'];
        $class_details['class_title'] = $param;

        $class_details['user_email'] = $user['email'];
        $class_details['user_name'] = $user['first_name'] . ' ' . $user['last_name'];

        $this->db->where('live_class_id', $id);
        $this->db->order_by('id', 'desc');
        $active_class = $this->db->get('bootcamp_online_class')->row_array();
        $class_details['room_name'] = $active_class['room_name'];
        $class_details['pass'] = $active_class['pass'];

        $this->db->where('live_class_id', $id);
        $this->db->where('status', 'active');
        $this->db->update('bootcamp_online_class', ['status' => 'running']);

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/bootcamp_online_class', compact('class_details'));
    }

    // admin ends online class
    function end_class($param1)
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $this->db->where('live_class_id', $param1);
        $this->db->where('status', 'running');
        $this->db->update('bootcamp_online_class', ['status' => 'complete', 'updated_date' => time()]);
        $this->sendRes('', 'Class ended.');
    }


    //                                     5. bootcamp live class action
    /*--------------------------------------------------------------------------------------------------*/
    function live_class($action, $param = '')
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        if ($action == 'edit' || $action == 'update' || $action == 'delete') {
            $owned = $this->bootcamp_model->has_ownership($param, 'live_class');
        } elseif ($action == 'form') {
            $owned = $this->bootcamp_model->has_ownership($param, 'bootcamp');
        }
        if (isset($owned) && !$owned) {
            $this->sendRes('err', 'data_not_found.');
        }

        if ($action == 'form') {
            $bootcamp_id = $param;
            $this->load->view('backend/admin/bootcamp_live_class_form.php', compact('bootcamp_id'));
        } elseif ($action == 'add') {
            $add = $this->bootcamp_model->live_class_action('add', $param);
            $this->sendRes($add['0'], $add['1']);
        } elseif ($action == 'edit') {
            $this->db->select('bootcamp_live_class.*, bootcamp_modules.bootcamp_id, bootcamp_modules.title as module_title');
            $this->db->from('bootcamp_live_class');
            $this->db->where('bootcamp_live_class.id', $param);
            $this->db->join('bootcamp_modules', 'bootcamp_live_class.module_id = bootcamp_modules.id');
            $live_class = $this->db->get()->row_array();
            $this->load->view('backend/admin/bootcamp_live_class_form.php', compact('live_class'));
        } elseif ($action == 'update') {
            $update = $this->bootcamp_model->live_class_action('update', $param);
            $this->sendRes($update[0], $update[1]);
        } elseif ($action == 'delete') {
            $this->bootcamp_model->delete_item('bootcamp_live_class', $param);
            $this->sendRes('', 'Class deleted.');
        } elseif ($action == 'sort') {
            $module_id = $param;
            $this->load->view('backend/admin/bootcamp_live_class_sort.php', compact('module_id'));
        } elseif ($action == 'update_sorted_modules') {
            $section_modules = $this->input->post('itemJSON');
            $this->bootcamp_model->live_class_action('update_sorted_modules', $section_modules);
        }
    }

    //                                     6. bootcamp class resource action
    /*--------------------------------------------------------------------------------------------------*/
    function resource($action, $param = '')
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        // check ownership
        $this->db->select('bootcamp_resources.*, bootcamp_live_class.bootcamp_id, bootcamp.owner_id');
        $this->db->from('bootcamp_resources');
        $this->db->join('bootcamp_live_class', 'bootcamp_resources.class_id = bootcamp_live_class.id');
        $this->db->join('bootcamp', 'bootcamp_live_class.bootcamp_id = bootcamp.id');
        $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
        $this->db->where('bootcamp_resources.id', $param);
        $owned = $this->db->get()->row_array();


        if ($action == 'form') {
            $page_data['class_id'] = $param;
            $this->db->where('class_id', $param);
            $page_data['resource_details'] = $this->db->get('bootcamp_resources')->result_array();
            $this->load->view('backend/admin/class_resource.php', $page_data);
        } elseif ($action == 'add') {
            $add = $this->bootcamp_model->resource_action('add', $param);
            $this->sendRes($add[0], $add[1]);
        } elseif ($action == 'delete') {
            if (!$owned) {
                $this->sendRes('err', 'data_not_found.');
            }
            $delete = $this->bootcamp_model->delete_item('bootcamp_resources', $param);
            $this->sendRes('', 'Resource deleted.');
        } elseif ($action == 'download') {
        }
    }

    //                                     7. bootcamp payment report
    /*--------------------------------------------------------------------------------------------------*/
    function payment_report($param = '')
    {
        if ($this->session->userdata('role_id') == 2 && $this->session->userdata('is_instructor') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param == '') {
            $this->db->select('bootcamp_purchase.*, bootcamp.owner_id, users.first_name, users.last_name, users.image');
            $this->db->from('bootcamp_purchase');
            $this->db->join('bootcamp', 'bootcamp_purchase.bootcamp_id = bootcamp.id');
            $this->db->join('users', 'bootcamp_purchase.user_id = users.id');
            $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
            $page_data['payment_reports'] = $this->db->get()->result_array();

            $page_data['page_name'] = 'payment_report';
            $page_data['page_title'] = get_phrase('payment_report');
        } else {
            if ($param < 1) {
                $this->sendRes('', 'not_in_collection.');
            }

            $this->db->select('bootcamp_purchase.*, bootcamp.owner_id, bootcamp.title');
            $this->db->from('bootcamp_purchase');
            $this->db->where('bootcamp_purchase.id', $param);
            $this->db->join('bootcamp', 'bootcamp_purchase.bootcamp_id = bootcamp.id');
            $this->db->join('users', 'bootcamp_purchase.user_id = users.id');
            $page_data['payment_info'] = $this->db->get()->row_array();

            $page_data['page_name'] = 'payment_invoice';
            $page_data['page_title'] = get_phrase('payment_invoice');
        }
        $this->load->view('backend/index.php', $page_data);
    }

    //                                 8. download resource for creator and user
    /*--------------------------------------------------------------------------------------------------*/
    function download($type, $param)
    {
        $this->load->helper('download');
        $file = $this->db->where('id', $param)->get('bootcamp_resources')->row_array();

        $role_id = $this->session->userdata('role_id');
        $is_instructor = $this->session->userdata('is_instructor');

        if ($role_id == 2 && $is_instructor != 1) {
            $type = 'resource';
        }

        if ($file) {
            $class = $this->db->where('id', $file['class_id'])->get('bootcamp_live_class')->row_array();

            // check ownership or purchase
            $ownership = $this->bootcamp_model->has_ownership($class['bootcamp_id'], 'bootcamp');
            $purchased = $this->bootcamp_model->is_purchased($class['bootcamp_id']);

            if ($ownership || $purchased) {
                force_download('./uploads/bootcamp/' . $type . '/' . $file['resource'], NULL);
                return true;
            }
        }
        $this->sendRes('err', 'data_not_found');
    }

    //                                       9. frontend all bootcamps
    /*--------------------------------------------------------------------------------------------------*/
    function bootcamp_list($uri_sagement = 0)
    {

        if (isset($_GET['category']) && $_GET['category'] != 'all') {
            $this->db->where('category_name', implode(' ', explode('-', $_GET['category'])));
            $category = $this->db->get('bootcamp_category')->row_array();
            $category_val = $category['category_name'];

            $this->db->where('category', $category['id']);
        } else {
            $category_val = 'all';
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('title', $this->input->get('search'));
            $search_val = $_GET['search'];
        } else {
            $search_val = '';
        }

        $all_filtered_courses = $this->db->get('bootcamp');

        $config = array();
        $config = pagintaion($all_filtered_courses->num_rows(), 9);
        $config['base_url']  = site_url('addons/bootcamp/bootcamp_list/');

        if (isset($_GET['search']) || isset($_GET['category'])) {
            $config['suffix']  = '?search=' . $search_val . '&category=' . $category_val;
            $config['first_url']  = site_url('addons/bootcamp/bootcamp_list') . '?search=' . $search_val . '&category=' . $category_val;
        }

        $this->pagination->initialize($config);

        if (isset($_GET['category']) && $_GET['category'] != 'all') {
            $this->db->where('category', $category['id']);
        }
        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('title', $this->input->get('search'));
        }
        $page_data['bootcamps'] = $this->db->get('bootcamp', $config['per_page'], $uri_sagement)->result_array();
        $page_data['page_name'] = 'bootcamp_list';
        $page_data['page_title'] = 'Bootcamps';

        $page_data['selected_category'] = $category_val;
        $page_data['searched_keyword'] = $search_val;

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    //                                  10. frontend single bootcamp details
    /*--------------------------------------------------------------------------------------------------*/
    function details($id)
    {
        $this->db->where('id', $id);
        $bootcamp_details = $this->db->get('bootcamp')->row_array();

        $page_data['page_name'] = 'bootcamp_details';
        $page_data['page_title'] = $bootcamp_details['title'];
        $page_data['bootcamp_details'] = $bootcamp_details;
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    //                                       11. bootcamp purchase
    /*--------------------------------------------------------------------------------------------------*/
    function purchase($param)
    {
        // check user login status
        if (!$this->session->userdata('user_login')) {
            set_url_history(site_url('addons/bootcamp/details/' . $param));
            redirect(site_url('login'), 'refresh');
        }

        // validate param
        if ($param != '' && $param > 0) {
            $bootcamp_details = $this->db->where('id', $param)->get('bootcamp')->row_array();
        } else {
            $this->sendRes('err', 'data_not_found.');
        }

        // creator can not buy own bootcamp
        if ($bootcamp_details['owner_id'] == $this->session->userdata('user_id')) {
            $this->sendRes('err', 'you_can_not_buy_own_item');
        }

        // check selected bootcamp is free or not
        if ($bootcamp_details['is_free'] == 1) {
            $this->sendRes('err', 'this_item_is_free.');
        }

        // check selected bootcamp price over 0
        if ($bootcamp_details['price'] < 1) {
            $this->sendRes('err', 'invalid_price');
        }

        // check selected item purchased or not
        if ($this->bootcamp_model->is_purchased($param)) {
            $this->sendRes('err', 'item_already_purchased.');
        }

        // proceed to payment configuration
        $this->bootcamp_model->configure_bootcamp_payment($bootcamp_details);
        redirect(site_url('payment'));
    }

    // bootcamp payment success function
    function success_bootcamp_payment($payment_method = "")
    {
        //STARTED payment model and functions are dynamic here
        $response = false;
        $payer_user_id = $this->session->userdata('user_id');
        $enrol_user_id = $payer_user_id;
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_method])->row_array();
        $model_name = strtolower($payment_gateway['model_name']);
        if ($payment_gateway['is_addon'] == 1 && $model_name != null) {
            $this->load->model('addons/' . strtolower($payment_gateway['model_name']));
        }

        if ($model_name != null) {
            $payment_check_function = 'check_' . $payment_method . '_payment';
            $response = $this->$model_name->$payment_check_function($payment_method, 'bootcamp');
        }

        //ENDED payment model and functions are dynamic here
        if ($response === true) {
            $payment = $this->bootcamp_model->store_payment_history($payment_method, $payment_details);
            $this->sendRes($payment[0], $payment[1], $payment[2]);
        } else {
            $this->session->set_flashdata('error_message', site_phrase('an_error_occurred_during_payment'));
            redirect('addons/bootcamp/details/' . $payment_details['items'][0]['id'], 'refresh');
        }
    }

    //                                       12. bootcamp join now action
    /*--------------------------------------------------------------------------------------------------*/
    function join_now($bootcamp_id)
    {
        if (ctype_digit($bootcamp_id) && $bootcamp_id > 0) {
            $purchase = $this->bootcamp_model->is_purchased($bootcamp_id);
            $msg = '';
            // check its a free bootcamp
            $bootcamp_details = $this->db->where('id', $bootcamp_id)->get('bootcamp')->row_array();
            if ($bootcamp_details['is_free'] == 1) {
                if (!$purchase) {
                    $data['user_id'] = $this->session->userdata('user_id');
                    $data['bootcamp_id'] = $bootcamp_id;
                    $data['price'] = 'free';
                    $data['payment_method'] = 'free';
                    $data['request_date'] = time();
                    $data['added_date'] = time();
                    $data['updated_date'] = time();
                    $purchase = $this->db->insert('bootcamp_purchase', $data);
                    $msg = 'bootcamp_purchased';
                }
            }

            // check purchase
            if ($purchase) {
                $this->sendRes('', $msg, 'addons/bootcamp/my_bootcamp/' . $bootcamp_id);
            }
            $this->sendRes('err', 'not_purchased_yet', 'addons/bootcamp/details/' . $bootcamp_id);
        }
        $this->sendRes('err', 'data_not_found', 'addons/bootcamp/bootcamp_list');
    }

    //                                       13. frontend my bootcamps
    /*--------------------------------------------------------------------------------------------------*/
    function my_bootcamp($param = '')
    {
        if ($param == '') {
            $page_data['page_name'] = "my_bootcamp";
            $page_data['page_title'] = site_phrase('my_bootcamp');

            $this->db->select('bootcamp.*');
            $this->db->from('bootcamp_purchase');
            $this->db->where('bootcamp_purchase.user_id', $this->session->userdata('user_id'));
            $this->db->join('bootcamp', 'bootcamp_purchase.bootcamp_id = bootcamp.id');
            $my_bootcamps = $this->db->get()->result_array();
            $page_data['bootcamps'] = $my_bootcamps;
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        } else {
            $this->db->where('bootcamp_id', $param);
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $is_purchased = $this->db->get('bootcamp_purchase')->row_array();
            if (!$is_purchased) {
                $this->sendRes('', 'not_in_collection.', 'addons/bootcamp/my_bootcamp/');
            }

            $page_data['page_name'] = "my_bootcamp_details";
            $page_data['page_title'] = site_phrase('my_bootcamp');
            $page_data['bootcamp_details'] = $this->bootcamp_model->get_table('bootcamp', $param)->row_array();
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        }
    }

    //                                       14. frontend join bootcamps
    /*--------------------------------------------------------------------------------------------------*/
    function join_class($param, $param2)
    {
        // check purchase
        $bootcamp = $this->db->where('id', $param2)->get('bootcamp_live_class')->row_array();
        $is_purchased = $this->bootcamp_model->is_purchased($bootcamp['bootcamp_id']);
        if (!$is_purchased) {
            $this->sendRes('err', 'not_in_collection', 'addons/bootcamp/my_bootcamp');
        }

        // end class
        $this->db->where('id', $param2);
        $class_schedule = $this->db->get('bootcamp_live_class')->row_array();
        if (!$class_schedule || time() >= $class_schedule['estimated_time']) {
            $this->sendRes('err', 'class_ended');
        }

        // check class started or not
        $this->db->where('live_class_id', $param2);
        $this->db->order_by('id', 'desc');
        $has_live_class = $this->db->get('bootcamp_online_class')->row_array();

        if (isset($has_live_class) && $has_live_class['status'] != 'complete') {
            if ($has_live_class['status'] == 'active' || $has_live_class['status'] == 'running') {
                $user = $this->bootcamp_model->get_table('users', $this->session->userdata('user_id'))->row_array();
                $class_details['owner_id'] = $user['id'];

                $class_details['room_name'] = $has_live_class['room_name'];
                $class_details['class_title'] = $param;

                $class_details['user_email'] = $user['email'];
                $class_details['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $class_details['password'] = $has_live_class['pass'];

                $this->load->view('frontend/' . get_frontend_settings('theme') . '/bootcamp_online_class', compact('class_details'));
            }
        } else {
            $this->sendRes('err', 'class_not_available.');
        }
    }

    //                                       15. watch uploaded class record
    /*--------------------------------------------------------------------------------------------------*/
    function watch($class_name, $resource_id)
    {
        if ($class_name != '' && $resource_id != '' && is_numeric($resource_id) && $resource_id > 0) {
            $resource = $this->db->where('id', $resource_id)->get('bootcamp_resources')->row_array();

            if ($resource) {
                $class_details = $this->db->where('id', $resource['class_id'])->get('bootcamp_live_class')->row_array();
                if ($class_details) {
                    // check purchase
                    $is_purchased = $this->bootcamp_model->is_purchased($class_details['bootcamp_id']);
                    if ($is_purchased) {
                        $page_data['page_name'] = 'watch_bootcamp_cls_rec';
                        $page_data['page_title'] = $class_name;
                        $page_data['class_details'] = $resource;
                        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
                    }
                }
            }
        } else {
            $this->sendRes('err', 'data_not_found.');
        }
    }

    function my_resources($param)
    {
        $this->db->where('class_id', $param);
        $this->db->where('type', 'resource');
        $resources = $this->db->get('bootcamp_resources')->result_array();

        $page_data['resources'] = $resources;
        $page_data['type'] = 'resource';
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/my_bootcamp_resource', $page_data);
    }

    function watch_video($resource_name, $param)
    {
        if (ctype_digit($param) && $param > 0) {
            // Check if the selected file exists
            $resource = $this->db->where('id', $param)->get('bootcamp_resources')->row_array();

            if (!empty($resource)) {
                // Check purchase
                $class_details = $this->db->where('id', $resource['class_id'])->get('bootcamp_live_class')->row_array();
                $purchase = $this->bootcamp_model->is_purchased($class_details['bootcamp_id']);

                if ($purchase) {
                    $page_data['resource_url'] = base_url() . 'uploads/bootcamp/class_record/' . $resource['resource'];
                    $page_data['class_details'] = $this->db->where('id', $resource['class_id'])->get('bootcamp_live_class')->row_array();
                    $this->load->view('frontend/' . get_frontend_settings('theme') . '/watch_bootcamp_cls_rec', $page_data);
                    return;
                }
            }
        }
        $this->sendRes('err', 'data_not_found');
    }
}
