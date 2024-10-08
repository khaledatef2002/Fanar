<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));
        
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


        //Check custom session data
        $this->user_model->check_session_data();
    }

    public function index()
    {
        //Check custom session data
        $this->user_model->check_session_data('login');

        $page_data['page_name'] = 'login';
        $page_data['page_title'] = site_phrase('login');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function sign_up()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'sign_up';
        $page_data['page_title'] = site_phrase('sign_up');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }


    public function validate_login($from = "")
    {
        if ($this->crud_model->check_recaptcha() == false && get_frontend_settings('recaptcha_status') == true) {
            $this->session->set_flashdata('error_message', get_phrase('recaptcha_verification_failed'));
            redirect(site_url('login'), 'refresh');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $credential = array('email' => $email, 'password' => sha1($password), 'status' => 1);

        // Checking login credential for admin
        $query = $this->db->get_where('users', $credential);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->user_model->new_device_login_tracker($row->id);
            $this->user_model->set_login_userdata($row->id);
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_login_credentials'));
            redirect(site_url('login'), 'refresh');
        }
    }

    function new_login_confirmation($param1 = ""){
        $new_device_code_expiration_time = $this->session->userdata('new_device_code_expiration_time');
        if(!$new_device_code_expiration_time || $new_device_code_expiration_time < (time())){
            $this->session->set_flashdata('error_message', get_phrase('time_over').'! '.site_phrase('please_try_again'));
            redirect(site_url('login'), 'refresh');
        }

        if($param1 == 'submit'){
            $new_device_verification_code = $this->input->post('new_device_verification_code');
            if($new_device_verification_code != $this->session->userdata('new_device_verification_code')){
                $this->session->set_flashdata('error_message', get_phrase('verification_code_is_wrong'));
                redirect(site_url('login/new_login_confirmation'), 'refresh');
            }

            // Checking login credential for admin
            $query = $this->db->get_where('users', array('id' => $this->session->userdata('new_device_user_id')));

            if ($query->num_rows() > 0) {
                $row = $query->row();

                // For device login tracker
                $this->user_model->new_device_login_tracker($row->id, true);
                $this->user_model->set_login_userdata($row->id);
            }
            $this->session->set_flashdata('error_message', get_phrase('something_is_wrong').'! '.site_phrase('please_try_again'));
            redirect(site_url('home'), 'refresh');
        }

        if($param1 == 'resend'){
            $this->email_model->new_device_login_alert();
            return;
        }

        $page_data['page_name'] = 'new_login_confirmation';
        $page_data['page_title'] = site_phrase('new_login_confirmation');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    
    public function fb_validate_login($access_token = "", $fb_user_id = "") {
        $this->social_login_modal->fb_validate_login($access_token, $fb_user_id);
    }








    public function register()
    {

        if ($this->crud_model->check_recaptcha() == false && get_frontend_settings('recaptcha_status') == true) {
            $this->session->set_flashdata('error_message', get_phrase('recaptcha_verification_failed'));
            redirect(site_url('register'), 'refresh');
        }

        $data['first_name'] = html_escape($this->input->post('first_name'));
        $data['last_name']  = html_escape($this->input->post('last_name'));
        $data['email']  = html_escape($this->input->post('email'));
        $data['password']  = sha1($this->input->post('password'));

        if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['password'])) {
            $this->session->set_flashdata('error_message', site_phrase('your_sign_up_form_is_empty') . '. ' . site_phrase('fill_out_the_form with_your_valid_data'));
            redirect(site_url('sign_up'), 'refresh');
        }

        if(empty($_POST['phone'])){
            $this->session->set_flashdata('error_message', get_phrase('Enter your valid phone number'));
            redirect(site_url('sign_up'), 'refresh');
        }

        if(empty($_POST['tel_code'])){
            $this->session->set_flashdata('error_message', get_phrase('Enter your country code number'));
            redirect(site_url('sign_up'), 'refresh');
        }

        $data['phone'] = $this->input->post('tel_code') . $this->input->post('phone');

        $verification_code =  rand(100000, 200000);
        $data['verification_code'] = $verification_code;

        if (get_settings('student_email_verification') == 'enable') {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $data['wishlist'] = json_encode(array());
        $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
        $social_links = array(
            'facebook' => "",
            'twitter'  => "",
            'linkedin' => ""
        );
        $data['social_links'] = json_encode($social_links);
        $data['role_id']  = 2;

        $data['payment_keys'] = json_encode(array());

        $validity = $this->user_model->check_duplication('on_create', $data['email']);

        if ($validity === 'unverified_user' || $validity == true) {


            //Check instructor application document
            if(get_settings('allow_instructor')):
                if(isset($_POST['instructor']) && $_POST['instructor'] == 'yes'){
                    if(empty($_FILES['document']['name'])){
                        $this->session->set_flashdata('error_message', get_phrase('Please choice your document file'));
                        redirect(site_url('sign_up'), 'refresh');
                    }
                    $accepted_ext = array('doc', 'docs', 'pdf', 'txt', 'png', 'jpg', 'jpeg');
                    $ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
                    if (in_array(strtolower($ext), $accepted_ext)) {
                        $instructor_apply = true;
                    }else{
                        $this->session->set_flashdata('error_message', get_phrase('Invalide document file'));
                        redirect(site_url('sign_up'), 'refresh');
                    }
                }
            endif;
            //End Check  instructor application document

            if ($validity === true) {
                $user_id = $this->user_model->register_user($data);
            } else {
                $this->user_model->register_user_update_code($data, $data['status']);
            }

            //instructor application
            if(isset($instructor_apply) && $instructor_apply == true):
                $this->user_model->instructor_application();
            endif;
            //End instructor application

            if (get_settings('student_email_verification') == 'enable') {
                $this->email_model->send_email_verification_mail($data['email'], $verification_code);

                if ($validity === 'unverified_user') {
                    $this->session->set_flashdata('info_message', get_phrase('you_have_already_registered') . '. ' . get_phrase('please_verify_your_email_address'));
                } else {
                    $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done') . '. ' . get_phrase('please_check_your_mail_inbox_to_verify_your_email_address') . '.');
                }
                $this->session->set_userdata('register_email', $this->input->post('email'));
                redirect(site_url('sign_up/verification_code'), 'refresh');
            } else {
                if(isset($user_id)){
                    $this->email_model->signup_mail($user_id);
                }
                $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done'));
                redirect(site_url('login'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('you_have_already_registered'));
            redirect(site_url('login'), 'refresh');
        }
    }

    public function register_teacher()
    {
        // Check if instructor sign up allowed
        if(!get_settings('allow_instructor')):
            $this->session->set_flashdata('error_message', site_phrase('Sign Up As Instructor Is Not Allowed'));
            redirect(site_url('sign_up_teacher'), 'refresh');
        endif;

        if ($this->crud_model->check_recaptcha() == false && get_frontend_settings('recaptcha_status') == true) {
            $this->session->set_flashdata('error_message', get_phrase('recaptcha_verification_failed'));
            redirect(site_url('sign_up_teacher'), 'refresh');
        }

        $data['first_name'] = html_escape($this->input->post('first_name'));
        $data['last_name']  = html_escape($this->input->post('last_name'));
        $data['email']  = html_escape($this->input->post('email'));
        $data['password']  = sha1($this->input->post('password'));

        if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['password'])) {
            $this->session->set_flashdata('error_message', site_phrase('your_sign_up_form_is_empty') . '. ' . site_phrase('fill_out_the_form with_your_valid_data'));
            redirect(site_url('sign_up_teacher'), 'refresh');
        }

        if(empty($_POST['phone'])){
            $this->session->set_flashdata('error_message', get_phrase('Enter your valid phone number'));
            redirect(site_url('sign_up_teacher'), 'refresh');
        }

        if(empty($_POST['tel_code'])){
            $this->session->set_flashdata('error_message', get_phrase('Enter your country code number'));
            redirect(site_url('sign_up_teacher'), 'refresh');
        }

        $data['phone'] = $this->input->post('tel_code') . $this->input->post('phone');

        $verification_code =  rand(100000, 200000);
        $data['verification_code'] = $verification_code;

        if (get_settings('student_email_verification') == 'enable') {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $data['wishlist'] = json_encode(array());
        $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
        $social_links = array(
            'facebook' => "",
            'twitter'  => "",
            'linkedin' => ""
        );
        $data['social_links'] = json_encode($social_links);
        $data['role_id']  = 2;
        $data['is_instructor'] = 1;

        $data['payment_keys'] = json_encode(array());

        $validity = $this->user_model->check_duplication('on_create', $data['email']);

        if ($validity === 'unverified_user' || $validity == true) {


            //Check instructor application document
            if(empty($_FILES['document']['name'])){
                $this->session->set_flashdata('error_message', get_phrase('Please choice your document file'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            $accepted_ext = array('doc', 'docs', 'pdf', 'txt', 'png', 'jpg', 'jpeg');
            $ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
            if (in_array(strtolower($ext), $accepted_ext)) {
                $instructor_apply = true;
            }else{
                $this->session->set_flashdata('error_message', get_phrase('Invalide document file'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            //End Check  instructor application document

            // Check Other Instructor Info
            ini_set('display_errors', 1);
            if(empty($_POST['country']) || !$this->isValidCountryCode($_POST['country']))
            {
                $this->session->set_flashdata('error_message', get_phrase('choose a valid country' . $_POST['country']));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(empty($_POST['mother_lang']) || !in_array($_POST['mother_lang'], [0, 1, 2, 3]))
            {               
                $this->session->set_flashdata('error_message', get_phrase('Enter your mother language'));
                redirect(site_url('sign_up_teacher'), 'refresh');                
            }
            if(count($_POST['other_lang']) == 0)
            {
                $this->session->set_flashdata('error_message', get_phrase('enter your other languages'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            else
            {
                foreach($_POST['other_lang'] as $lang)
                {
                    if(!in_array($lang, [0, 1, 2, 3, 4]))
                    {
                        $this->session->set_flashdata('error_message', get_phrase('enter your other languages'));
                        redirect(site_url('sign_up_teacher'), 'refresh');
                    }
                }
            }
            if(!in_array($_POST['gender'], [0, 1]))
            {
                $this->session->set_flashdata('error_message', get_phrase('enter your gender'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(!in_array($_POST['apply_as'], [0, 1]))
            {
                $this->session->set_flashdata('error_message', get_phrase('choose a valid employment type'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(count($_POST['subjects']) == 0)
            {
                $this->session->set_flashdata('error_message', get_phrase('choose at least one subject'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            else
            {
                foreach($_POST['subjects'] as $subject)
                {
                    if(!in_array($subject, [0, 1, 2, 3, 4, 5, 6, 7, 8, 'other']))
                    {
                        $this->session->set_flashdata('error_message', get_phrase('choose at least one subject'));
                        redirect(site_url('sign_up_teacher'), 'refresh');
                    }
                }
            }
            if(in_array('other', $_POST['subjects']) && empty($_POST['other-subjects']))
            {
                $this->session->set_flashdata('error_message', get_phrase('enter the other subjects name'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(!empty($_POST['other_jobs']) && !in_array($_POST['other_jobs'], [0, 1]))
            {
                $this->session->set_flashdata('error_message', get_phrase('enter a valid value for other jobs'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(!empty($_POST['experince']) && !in_array($_POST['experince'], [0, 1]))
            {
                $this->session->set_flashdata('error_message', get_phrase('enter a valid value for experince'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(empty($_POST['how_to_conduct']) || !in_array($_POST['how_to_conduct'], [0, 1, 2]))
            {
                $this->session->set_flashdata('error_message', get_phrase('choose how would you counduct your lessons'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(count($_POST['prefered_school']) == 0)
            {
                $this->session->set_flashdata('error_message', get_phrase('choose your prefered school level'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            else
            {
                foreach($_POST['prefered_school'] as $level)
                {
                    if(!in_array($level, [0, 1, 2, 3]))
                    {
                        $this->session->set_flashdata('error_message', get_phrase('choose your prefered school level'));
                        redirect(site_url('sign_up_teacher'), 'refresh'); 
                    }
                }
            }
            if(empty($_POST['experince-years']))
            {
                $this->session->set_flashdata('error_message', get_phrase('please enter your experince years'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }
            if(empty($_POST['reference']))
            {
                $this->session->set_flashdata('error_message', get_phrase('please tell us how did you hear about us'));
                redirect(site_url('sign_up_teacher'), 'refresh');
            }



            if ($validity === true) {
                $user_id = $this->user_model->register_user($data);
            } else {
                $this->user_model->register_user_update_code($data, $data['status']);
            }

            //instructor application
            if(isset($instructor_apply) && $instructor_apply == true):
                $this->user_model->instructor_application();
            endif;
            //End instructor application

            if (get_settings('student_email_verification') == 'enable') {
                $this->email_model->send_email_verification_mail($data['email'], $verification_code);

                if ($validity === 'unverified_user') {
                    $this->session->set_flashdata('info_message', get_phrase('you_have_already_registered') . '. ' . get_phrase('please_verify_your_email_address'));
                } else {
                    $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done') . '. ' . get_phrase('please_check_your_mail_inbox_to_verify_your_email_address') . '.');
                }
                $this->session->set_userdata('register_email', $this->input->post('email'));
                redirect(site_url('sign_up/verification_code'), 'refresh');
            } else {
                if(isset($user_id)){
                    $this->email_model->signup_mail($user_id);
                }
                $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done'));
                $this->session->set_flashdata('instructor_success', get_phrase('instructor success register'));
                redirect(site_url('login'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('you_have_already_registered'));
            redirect(site_url('login'), 'refresh');
        }
    }

    function isValidCountryCode($code) {
        $url = "https://restcountries.com/v3.1/alpha/$code";
    
        // Initialize cURL session
        $ch = curl_init($url);
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for simplicity (not recommended for production)
        
        // Execute the cURL request
        $response = curl_exec($ch);
    
        // Check if any error occurred
        if (curl_errno($ch)) {
            curl_close($ch);
            return false; // cURL error
        }
    
        // Close cURL session
        curl_close($ch);
    
        // Check HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode == 200) {
            return true; // Valid country code
        } else {
            return false; // Invalid country code
        }
    }

    public function logout($from = "")
    {
        //destroy sessions of specific userdata. We've done this for not removing the cart session
        $this->user_model->session_destroy();
        redirect(site_url('login'), 'refresh');
    }

    public function forgot_password_request()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'forgot_password';
        $page_data['page_title'] = site_phrase('forgot_password');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    function forgot_password($from = "")
    {

        if ($this->crud_model->check_recaptcha() == false && get_frontend_settings('recaptcha_status') == true) {
            $this->session->set_flashdata('error_message', get_phrase('recaptcha_verification_failed'));
            redirect(site_url('login'), 'refresh');
        }
        $email = $this->input->post('email');
        $query = $this->db->get_where('users', array('email' => $email, 'status' => 1));
        if ($query->num_rows() > 0) {
            $this->crud_model->forgot_password();
            redirect(site_url('login'), 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('user_not_found'));
            redirect(site_url('login'), 'refresh');
        }
    }

    function change_password($verification_code = ""){
        
        if($verification_code == ""){
            $this->session->set_flashdata('error_message', get_phrase('invalid_verification_code').'. '.get_phrase('please_send_a_new_forgot_password_request'));
            redirect(site_url('login'), 'refresh');
        }else{
            $verification_code = str_replace(' ', '', $verification_code);
            $verification_code = str_replace('%20', '', $verification_code);
            $verification_code = str_replace('=', '', $verification_code);

            $decoded_verification_code = explode('--', base64_decode($verification_code));
            $solid_email = $decoded_verification_code[0];
            $email = str_replace('__', '@', $solid_email);

            $current_time = time();
            $expired_time = $current_time-900;
            $this->db->where('email', $email);
            $this->db->where('verification_code', $verification_code);
            $row = $this->db->get('users');

            if($row->row('last_modified') < $expired_time || $row->num_rows() <= 0){
                $this->session->set_flashdata('error_message', get_phrase('This link has been expired.').' '.get_phrase('Please send a new request'));
                redirect(site_url('login/forgot_password_request'), 'refresh');
            }
        }


        if(isset($_POST['new_password']) && isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && $verification_code){
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            if($new_password == $confirm_password):
                $this->crud_model->change_password_from_forgot_passord($verification_code);
                $this->session->set_flashdata('flash_message', get_phrase('password_has_changed_successfully'));
                redirect(site_url('login'), 'refresh');
            else:
                $this->session->set_flashdata('error_message', get_phrase('the_confirmed_password_is_not_matching_with_the_new_password'));
                redirect(site_url('login/change_password/'.$verification_code), 'refresh');
            endif;
        }


        $page_data['verification_code'] = $verification_code;
        $page_data['page_name'] = 'change_password_from_forgot_password';
        $page_data['page_title'] = site_phrase('change_password');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

    }

    public function resend_verification_code()
    {
        $email = $this->input->post('email');
        $verification_code = $this->db->get_where('users', array('email' => $email))->row('verification_code');
        $this->email_model->send_email_verification_mail($email, $verification_code);

        return true;
    }

    public function verify_email_address()
    {
        $email = $this->input->post('email');
        $verification_code = $this->input->post('verification_code');
        $user_details = $this->db->get_where('users', array('email' => $email, 'verification_code' => $verification_code));
        if ($user_details->num_rows() > 0) {
            $user_details = $user_details->row_array();

            $updater = array(
                'status' => 1
            );
            $this->db->where('id', $user_details['id']);
            $this->db->update('users', $updater);

            $this->email_model->signup_mail($user_details['id']);

            $this->session->set_flashdata('flash_message', get_phrase('congratulations') . '! ' . get_phrase('your_email_address_has_been_successfully_verified') . '.');
            $this->session->set_userdata('register_email', null);

            echo true;
        } else {
            $this->session->set_flashdata('error_message', get_phrase('the_verification_code_is_wrong') . '.');
            echo false;
        }
    }


    function check_recaptcha_with_ajax()
    {
        if ($this->crud_model->check_recaptcha()) {
            echo true;
        } else {
            echo false;
        }
    }

}
