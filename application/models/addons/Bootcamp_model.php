<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bootcamp_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    // reuseable functions
    // 1. get record from any table
    function get_table($table, $id = '', $sort = '')
    {
        if ($sort != '') {
            $this->db->order_by('order_by', $sort);
        }
        if ($id != '' && is_numeric($id)) {
            $this->db->where('id', $id);
        } elseif ($id != '' && !is_numeric($id)) {
            $arr = explode('-', $id);
            $this->db->where($arr[0], $arr[1]);
        }

        return $this->db->get($table);
    }

    // 2. file uploader function
    function upload_files($name, $path, $original = '')
    {
        if (isset($_FILES[$name]) && $_FILES[$name]['name'] != "") {
            $extension = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
            if ($original == 'original') {
                $file_name = $_FILES[$name]['name'];
            } elseif ($original == 'class_record') {
                if ($extension == 'mp4' || $extension == 'mov' || $extension == 'avi' || $extension == 'wmv' || $extension == 'WebM') {
                    $file_name = 'cls_rec_' . rand(100000, 999999) . '.' . $extension;
                } else {
                    return FALSE;
                }
            } elseif ($original == '') {
                $file_name = md5(rand(10000000, 20000000)) . '.' . $extension;
            }

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES[$name]['tmp_name'], $path . $file_name);
            return $file_name;
        }
        return FALSE;
    }

    // 3. trim and json response
    function trim_and_return_json($untrimmed_array = [])
    {
        if (!is_array($untrimmed_array)) {
            $untrimmed_array = [];
        }
        $trimmed_array = array();
        if (sizeof($untrimmed_array) > 0) {
            foreach ($untrimmed_array as $row) {
                if ($row != "") {
                    array_push($trimmed_array, $row);
                }
            }
        }
        return json_encode($trimmed_array);
    }

    // .4 delete row
    function delete_item($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
        return true;
    }

    // 5. check bootcamp ownership
    function has_ownership($param, $table)
    {
        if ($table == 'bootcamp') {
            $this->db->where('id', $param);
            $this->db->where('owner_id', $this->session->userdata('user_id'));
            $ownership = $this->db->get('bootcamp')->row_array();
        } elseif ($table == 'live_class') {
            $this->db->select('bootcamp.owner_id, bootcamp_live_class.*');
            $this->db->from('bootcamp_live_class');
            $this->db->join('bootcamp', 'bootcamp_live_class.bootcamp_id = bootcamp.id');
            $this->db->where('bootcamp_live_class.id', $param);
            $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
            $ownership = $this->db->get()->row_array();
        } elseif ($table == 'module') {
            $this->db->select('bootcamp.owner_id, bootcamp_modules.*');
            $this->db->from('bootcamp_modules');
            $this->db->join('bootcamp', 'bootcamp_modules.bootcamp_id = bootcamp.id');
            $this->db->where('bootcamp_modules.id', $param);
            $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
            $ownership = $this->db->get()->row_array();
        } elseif ($table == 'resource') {
            $this->db->select('bootcamp_resources.*, bootcamp_live_class.bootcamp_id, bootcamp.owner_id');
            $this->db->from('bootcamp_resources');
            $this->db->join('bootcamp_live_class', 'bootcamp_resources.class_id = bootcamp_live_class.id');
            $this->db->join('bootcamp', 'bootcamp_live_class.bootcamp_id = bootcamp.id');
            $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
            $this->db->where('bootcamp_resources.id', $param);
            $ownership = $this->db->get()->row_array();
        }
        return $ownership ? TRUE : FALSE;
    }

    // 6. check is purchased by bootcamp
    function is_purchased($param)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('bootcamp_id', $param);
        $is_purchased = $this->db->get('bootcamp_purchase')->row_array();
        return $is_purchased;
    }

    // 7. get bootcamp enrollments
    function bootcamp_enrollment($param, $enrol_type)
    {
        if ($param != '' && is_numeric($param) && $param > 0 && $enrol_type != '') {

            if ($enrol_type == 'bootcamp') {
                $this->db->where('bootcamp_id', $param);
                $users = $this->db->get('bootcamp_purchase')->result_array();
                $select = 'bootcamp_id';
            } elseif ($enrol_type == 'user') {
                $this->db->where('user_id', $param);
                $users = $this->db->get('bootcamp_purchase')->result_array();
                $select = 'user_id';
            } elseif ($enrol_type == 'instructor') {
                $instructor_bootcamps = $this->db->where('owner_id', $param)->get('bootcamp')->result_array();
                $count_bootcamp = 0;
                foreach ($instructor_bootcamps as $bootcamp) {
                    $count_bootcamp += $this->bootcamp_model->bootcamp_enrollment($bootcamp['id'], 'bootcamp');
                }
                return $count_bootcamp;
            }

            // for bootcamp and user
            $get_users = [];
            foreach ($users as $item) {
                array_push($get_users, $item[$select]);
            }
            return count(array_unique($get_users));
        }
        return 0;
    }

    // ---------------------------------------------- bootcamp addon ----------------------------------------------


    //                                          1. bootcamp category action
    /*------------------------------------------------------------------------------------------------------------*/
    function category_action($action, $param = '')
    {
        $data['category_name'] = $this->input->post('category_name');
        $data['updated_date'] = time();

        if ($action == 'add') {
            $data['added_date'] = time();

            $duplicate = $this->db->where('category_name', $data['category_name'])->get('bootcamp_category')->num_rows();
            if ($duplicate > 0) {
                return ['err', 'data_exists.'];
            }
            $this->db->insert('bootcamp_category', $data);
            return ['', 'category_added.'];
        } elseif ($action == 'update') {
            $data['category_name'] = $this->input->post('category_name');
            $duplicate = $this->db->where('category_name', $data['category_name'])->get('bootcamp_category')->row_array();
            if (isset($duplicate['id']) && $duplicate['id'] != $param) {
                return ['err', 'data_exists.'];
            }
            $update = $this->db->where('id', $param)->update('bootcamp_category', $data);
            if ($update) {
                return ['', 'category_updated'];
            }
        }
        return ['err', 'something_went_wrong'];
    }

    //                                       	2. bootcamp action
    /*------------------------------------------------------------------------------------------------------------*/
    function bootcamp_action($action = '', $param = '')
    {
        $input = $this->input->post();
        unset($input['files']);
        $data = $input;

        if ($data['category'] == '') {
            return ['err', 'category_not_selected', ''];
        }

        if ($action == 'add') {
            // check duplicate
            $is_duplicate = $this->db->where('title', $data['title'])->get('bootcamp')->row_array();
            if ($is_duplicate) {
                return ['err', 'data_exists.'];
            }

            // upload bootcamp thumbnail
            $bootcamp_thumbnail = $this->bootcamp_model->upload_files('bootcamp_thumbnail', 'uploads/bootcamp/bootcamp_thumbnail/');
            if ($bootcamp_thumbnail) {
                $data['bootcamp_thumbnail'] = $bootcamp_thumbnail;
            }

            $data['owner_id'] = $this->session->userdata('user_id');
            $data['is_free'] = isset($data['is_free']) ? 1 : 0;
            $data['start_date'] = strtotime($input['start_date']);
            $data['added_date'] = time();
            $data['updated_date'] = $data['added_date'];

            $field = ['faqs', 'faq_descriptions', 'requirements', 'outcomes'];
            for ($i = 0; $i < count($field); $i++) {
                $input[$field[$i]] = $this->trim_and_return_json($input[$field[$i]]);
                $data[$field[$i]] = $input[$field[$i]];
            }

            $insert =  $this->db->insert('bootcamp', $data);
            if ($insert) {
                $last = $this->db->order_by('id', 'desc')->get('bootcamp')->row_array();
                return ['', 'bootcamp_created', 'addons/bootcamp/action/edit/' . $last['id']];
            }
        } elseif ($action == 'update') {

            // check duplicate
            $is_duplicate = $this->db->where('title', $data['title'])->get('bootcamp')->row_array();
            if (isset($is_duplicate) && $is_duplicate['id'] != $param) {
                return ['err', 'data_already_exists.'];
            }

            // upload bootcamp
            if ($_FILES['bootcamp_thumbnail']['name'] != '') {
                $bootcamp_thumbnail = $this->bootcamp_model->upload_files('bootcamp_thumbnail', 'uploads/bootcamp/bootcamp_thumbnail/');
                if ($bootcamp_thumbnail) {
                    $data['bootcamp_thumbnail'] = $bootcamp_thumbnail;
                }
            }

            $data['is_free'] = isset($data['is_free']) ? 1 : 0;
            $data['updated_date'] = time();
            $field = ['faqs', 'faq_descriptions', 'requirements', 'outcomes'];
            for ($i = 0; $i < count($field); $i++) {
                $input[$field[$i]] = $this->trim_and_return_json($input[$field[$i]]);
                $data[$field[$i]] = $input[$field[$i]];
            }
            $update = $this->db->where('id', $param)->update('bootcamp', $data);
            return $update ? ['', 'bootcamp_updated'] : ['err', 'bootcamp_updated_failed'];
        }
    }

    //                                       	3. bootcamp module action
    /*------------------------------------------------------------------------------------------------------------*/
    function module_action($action, $param = '')
    {
        if ($action == 'add') {
            // check duplicate
            $this->db->select('bootcamp.owner_id, bootcamp_modules.*');
            $this->db->from('bootcamp_modules');
            $this->db->join('bootcamp', 'bootcamp_modules.bootcamp_id = bootcamp.id');
            $this->db->where('bootcamp_modules.title', $this->input->post('title'));
            $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
            $has_module = $this->db->get()->row_array();
            if ($has_module) {
                return ['err', 'data_already_exists.'];
            }

            $data = $this->input->post();
            $study_plan = explode('-', $this->input->post('study_plan'));
            $data['class_start'] = strtotime($study_plan[0]);
            $data['class_end'] = strtotime($study_plan[1]);
            $data['added_date'] = time();
            $data['updated_date'] = $data['added_date'];
            unset($data['study_plan']);
            $add = $this->db->insert('bootcamp_modules', $data);
            if ($add) {
                return ['', 'module_created'];
            }
        } elseif ($action == 'update') {

            // check old data
            $old_data = $this->db->where('id', $param)->get('bootcamp_modules')->row_array();
            if ($old_data['title'] != $this->input->post('title')) {
                // check duplicate
                $this->db->select('bootcamp.owner_id, bootcamp_modules.*');
                $this->db->from('bootcamp_modules');
                $this->db->join('bootcamp', 'bootcamp_modules.bootcamp_id = bootcamp.id');
                $this->db->where('bootcamp_modules.title', $this->input->post('title'));
                $this->db->where('bootcamp.owner_id', $this->session->userdata('user_id'));
                $has_module = $this->db->get()->row_array();

                if ($has_module) {
                    return ['err', 'data_already_exists.'];
                }
            }

            $data['title'] = $this->input->post('title');
            $data['restricted_by'] = $this->input->post('restricted_by');
            $study_plan = explode('-', $this->input->post('study_plan'));
            if ($data['restricted_by'] == 'start_date') {
                $data['class_start'] = strtotime($study_plan[0]);
            } elseif ($data['restricted_by'] == 'date_range') {
                $data['class_start'] = strtotime($study_plan[0]);
                $data['class_end'] = strtotime($study_plan[1]);
            }
            $data['updated_date'] = time();
            $this->db->where('id', $param);
            $update = $this->db->update('bootcamp_modules', $data);
            if ($update) {
                return ['', 'module_updated.'];
            }
        } elseif ($action == 'update_sorted_module') {
            $modules = json_decode($param);
            foreach ($modules as $key => $value) {
                $updater = array(
                    'order_by' => $key + 1
                );
                $this->db->where('id', $value);
                $this->db->update('bootcamp_modules', $updater);
            }
        }
    }

    //                                       	4. bootcamp live class action
    /*------------------------------------------------------------------------------------------------------------*/
    function live_class_action($action, $param = '')
    {
        if ($action == 'add') {
            $input = $this->input->post();
            $data = $input;
            unset($data['files']);

            // must have a module
            if ($data['module_id'] == '') {
                return ['err', 'please_select_a_module.'];
            }

            // estimated time must be greater than class schedule
            if (($data['class_schedule'] >= $data['estimated_time'])) {
                return ['err', 'please_set_schedule_properly'];
            }

            $start = strtotime($data['class_schedule']);
            $end = strtotime($data['estimated_time']);
            // check current time
            // if ($start < (time() - 60)) {
            //     return ['err', 'enter_a_valid_schedule'];
            // }

            // check class schedule matches module schedule or not
            $module = $this->db->where('id', $data['module_id'])->get('bootcamp_modules')->row_array();
            if ($module['restricted_by'] == 'start_date' && $start < $module['class_start']) {
                return ['err', 'please_set_schedule_properly'];
            }
            if ($module['restricted_by'] == 'date_range' && (($start < $module['class_start'] || $start > $module['class_end']) && ($end < $module['class_start'] || $end > $module['class_end']))) {
                return ['err', 'please_set_schedule_properly'];
            }
            $data['class_schedule'] = $start;
            $data['estimated_time'] = $end;
            $data['added_date'] = time();
            $data['updated_date'] = $data['added_date'];

            $add = $this->db->insert('bootcamp_live_class', $data);
            if ($add) {
                return ['', 'live_class_added'];
            }
        } elseif ($action == 'update') {
            $input = $this->input->post();

            // must have a module
            if ($input['module_id'] == '') {
                return ['err', 'please_select_a_module.'];
            }

            // estimated time must be greater than class schedule
            if (($input['class_schedule'] >= $input['estimated_time'])) {
                return ['err', 'please_set_schedule_properly'];
            }

            $start = strtotime($input['class_schedule']);
            $end = strtotime($input['estimated_time']);

            // check class schedule matches module schedule or not
            $module = $this->db->where('id', $input['module_id'])->get('bootcamp_modules')->row_array();
            if ($module['restricted_by'] == 'start_date' && $start < $module['class_start']) {
                return ['err', 'please_set_schedule_properly'];
            }
            if ($module['restricted_by'] == 'date_range' && (($start < $module['class_start'] || $start > $module['class_end']) && ($end < $module['class_start'] || $end > $module['class_end']))) {
                return ['err', 'please_set_schedule_properly'];
            }

            $data['title'] = $input['title'];
            $data['module_id'] = $input['module_id'];
            $data['description'] = $input['description'];
            $data['class_schedule'] = $start;
            $data['estimated_time'] = $end;
            $data['status'] = $input['status'];
            $data['updated_date'] = time();

            $this->db->where('id', $param);
            $update = $this->db->update('bootcamp_live_class', $data);
            return $update ? ['', 'live_class_updated.'] : ['err', 'update_failed'];
        } elseif ($action == 'update_sorted_modules') {
            $classes = json_decode($param);
            foreach ($classes as $key => $value) {
                $updater = array(
                    'order_by' => $key + 1
                );
                $this->db->where('id', $value);
                $this->db->update('bootcamp_live_class', $updater);
            }
        }
    }

    //                                       	5. bootcamp resource action
    /*------------------------------------------------------------------------------------------------------------*/
    function resource_action($action, $param = '')
    {
        if ($action == 'add') {

            $data['class_id'] = $this->input->post('class_id');
            $data['added_date'] = time();
            $data['updated_date'] = $data['added_date'];

            $check_class = $this->db->where('id', $data['class_id'])->get('bootcamp_live_class')->row_array();
            if (!$check_class) {
                return ['err', 'data_not_found'];
            }

            if (isset($_FILES['resource']) &&  $_FILES['resource']['name'] != "") {
                $data['type'] = 'resource';
                $resource = $this->bootcamp_model->upload_files('resource', 'uploads/bootcamp/resource/', 'original');
                if ($resource) {
                    $data['resource'] = $resource;
                }
            } elseif (isset($_FILES['class_record']) &&  $_FILES['class_record']['name'] != "") {

                // check class has ended or not
                $this->db->where('id', $param);
                $class_details = $this->db->get('bootcamp_live_class')->row_array();

                if (time() < $class_details['estimated_time']) {
                    return ['err', 'class_is_not_finished_yet.'];
                }

                $data['type'] = 'class_record';
                $resource = $this->bootcamp_model->upload_files('class_record', 'uploads/bootcamp/class_record/', 'class_record');
                if ($resource) {
                    $data['resource'] = $resource;
                }
            }
            if (isset($data['resource'])) {
                $insert = $this->db->insert('bootcamp_resources', $data);
                if ($insert) {
                    return ['', 'resource_added.'];
                }
            }
            return ['err', 'select_a_resource_file'];
        }
    }

    //                                       	6. bootcamp payment config
    /*------------------------------------------------------------------------------------------------------------*/
    function configure_bootcamp_payment($param)
    {
        $items = [];
        $total_payable_amount = 0;

        //item detail
        $item_details['id'] = $param['id'];
        $item_details['title'] = $param['title'];
        $item_details['creator_id'] = $param['owner_id'];
        $item_details['discount_flag'] = $param['discount_flag'];
        $item_details['discounted_price'] = $param['discounted_price'];
        $item_details['price'] = $param['price'];
        $item_details['actual_price'] = ($param['discount_flag'] == 1) ? $param['price'] - $param['discounted_price'] : $param['price'];

        $items += [$item_details];

        //ended item detail

        //common structure for all payment gateways and all type of payment
        $data['total_payable_amount'] = $item_details['actual_price'];

        $data['items'] = $items;
        $data['payment_title'] = get_phrase('pay_for_purchasing_bootcamp');
        $data['success_url'] = site_url('addons/bootcamp/success_bootcamp_payment');
        $data['cancel_url'] = site_url('payment');
        $data['back_url'] = site_url('addons/bootcamp/details/' . $item_details['id']);
        $this->session->set_userdata('payment_details', $data);
    }

    //                                       	7. bootcamp payment history
    /*------------------------------------------------------------------------------------------------------------*/
    function store_payment_history($payment_method, $payment_details)
    {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['bootcamp_id'] = $payment_details['items'][0]['id'];
        $data['price'] = $payment_details['items'][0]['actual_price'];
        $data['payment_method'] = $payment_method;
        $data['request_date'] = time();
        $data['added_date'] = time();
        $data['updated_date'] = $data['added_date'];

        $insert = $this->db->insert('bootcamp_purchase', $data);
        if ($insert) {
            return ['', 'Payment successful.', 'addons/bootcamp/details/' . $data['bootcamp_id']];
        }
        return ['err', 'something_went_wrong', ''];
    }
}
