<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'email', 'table', 'session']);
        $this->load->database();
        $this->load->helper(array('string', 'url', 'form'));
        $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
    }

    public function index()
    {
        if ($this->session->userdata('reguser')) {

            $data['page_name'] = "dashboard";
            $this->load->view('user/dashboard', $data);
        } else {
            $data['page_name'] = "login";
            $this->load->view('user/login', $data);
        }
    }


    public function regist_insert()
    {
        if ($_POST) {
            $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
            log_message('error', 'fname' . $fname);
            $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
            $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
            $pin = filter_input(INPUT_POST, 'pin', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('fname', 'First name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('mobile', 'Phone', 'trim|required|callback_mobile_check');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('dob', 'Birthday', 'trim|required');
            $this->form_validation->set_rules('pin', 'Pin code', 'trim|required');

            if (empty($_FILES['image']['name'])) {

                $response['status'] = 'error';
                $response['image_error'] = 'Please select an image.';
            }

            if ($this->form_validation->run()) {

                // Check if an image file has been selected
                $originalFileName = $_FILES['image']['name'];
                $config = array(
                    'file_name' => $originalFileName,
                    'upload_path' => "assets/images",
                    'allowed_types' => "jpg|png|jpeg|pdf",
                    'overwrite' => false,
                    'encrypt_name' => TRUE,
                    'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)

                );
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $response['status'] = 'error';
                    $response['image_error'] = $this->upload->display_errors();
                } else {
                    $img = $this->upload->data()['file_name'];
                    log_message('error', 'image' . $img);
                    $inn = $this->user->register_manage($img);
                    if ($inn)
                        $this->session->set_userdata('reguser', $inn['username']);
                    $response['status'] = 'success';
                    $response['message'] = 'Registered Successfully';
                    $response['username'] = $inn['username'];
                    $response['password'] = $inn['password'];
                }
            } else {
                $response['status'] = 'error';
                $response['fname_error'] = form_error('fname');
                $response['lname_error'] = form_error('lname');
                $response['email_error'] = form_error('email');
                $response['mob_error'] = form_error('mobile');
                $response['gender_error'] = form_error('gender');
                $response['dob_error'] = form_error('dob');
                $response['pin_error'] = form_error('pin');
            }
            echo json_encode($response);
        }
    }

    public function email_check()
    {
        $email = $this->input->post('email');
        $check = $this->db->where('email', $email)->get('user_role')->row();
        if ($check) {
            $this->form_validation->set_message('email_check', 'Email Already Exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function mobile_check()
    {
        $mobile = $this->input->post('mobile');
        $check = $this->db->where('mob', $mobile)->get('user_role')->row();
        if ($check) {
            $this->form_validation->set_message('mobile_check', 'Mobile Number Already Exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function login()
    {
        if ($_POST) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            log_message('error', 'username' . $username);
            log_message('error', 'Password' . $password);
            $check = $this->user->login($username, $password);
            log_message('error', 'check' . json_encode($check));
            if (isset($check['error'])) {
                $this->session->set_flashdata('error_message', $check['error']);
                redirect('user', 'refresh');
            } elseif ($check !== false) {
                $this->session->set_userdata('reguser', $check['username']);
                $this->session->set_userdata('regemail', $check['email']);
                $this->session->set_userdata('regname', $check['fname']);
                $this->session->set_flashdata('popup_message', 'success');
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('error_message', 'Please enter valid username and password');
                redirect('user', 'refresh');
            }
        } else {
            $user = $this->db->where('username', $this->session->userdata('reguser'))->get('user_role')->row_array;
            if ($user) {
                log_message('error', 'reg login user' . json_encode($user));
                $data['username'] = $user['username'];
                $data['password'] = $user['pwd'];
                $this->load->view('user/login', $data);
            }
            $this->load->view('user/login');
        }
    }


    public function emailcheck()
    {

        $email_check = $this->db->where('email', $this->input->post('email'))->where('username!=', $this->session->userdata('reguser'))->get('user_role')->row_array();

        if (!empty($email_check)) {
            $this->form_validation->set_message('emailcheck', 'Email ID already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function phonecheck()
    {

        $email_check = $this->db->where('mob', $this->input->post('mob'))->where('username!=', $this->session->userdata('reguser'))->get('user_role')->row_array();

        if (!empty($email_check)) {
            $this->form_validation->set_message('phonecheck', 'Mobile Number already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function profile_update()
    {
        if (!$this->session->userdata('reguser'))
            redirect('admin', 'refresh');

        if ($_POST) {
            $this->form_validation->set_rules('fname', 'First name', 'trim');
            $this->form_validation->set_rules('lname', 'Last name', 'trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_emailcheck');
            $this->form_validation->set_rules('pin', 'Pincode', 'trim');
            $this->form_validation->set_rules('mob', 'Mobile', 'trim|numeric|callback_phonecheck');
            $this->form_validation->set_rules('country', 'Country', 'trim');
            $this->form_validation->set_rules('gender', 'Gender', 'trim');
            $this->form_validation->set_rules('city', 'City', 'trim');
            $this->form_validation->set_rules('state', 'State', 'trim');


            if ($this->form_validation->run()) {

                // Check if an image file has been selected
                $originalFileName = $_FILES['image']['name'];
                $config = array(
                    'file_name' => $originalFileName,
                    'upload_path' => "assets/images",
                    'allowed_types' => "jpg|png|jpeg|pdf",
                    'overwrite' => true,
                    'encrypt_name' => TRUE,
                    'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)

                );
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    log_message('error', 'old image' . $this->input->post('old_image'));

                    $response['status'] = 'success';
                    $img = $this->input->post('old_image');
                    $inn = $this->user->user_profile_update($img);
                    if ($inn) {
                        $response['status'] = 'success';
                        $response['message'] = 'Profile Updated Successfully';
                    } else {
                        // Profile update failed
                        $response['status'] = 'old Image upload failed';
                    }
                } else {
                    $img = $this->upload->data()['file_name'];

                    log_message('error', 'new_image' . $img);
                    $inn = $this->user->user_profile_update($img);
                    if ($inn) {
                        $response['status'] = 'success';
                        $response['message'] = 'Profile Updated Successfully';
                    } else {
                        // Profile update failed
                        $response['status'] = 'Something Went Wrong';
                    }
                }
            } else {
                // Form validation failed
                $response['status'] = 'error';
                $response['message'] = validation_errors();
            }
        }

        // Send JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function reset_password()
    {
        if ($this->session->userdata('reguser')) {
            $this->load->view('user/reset_password');
        }
    }
    public function forget_password()
    {

        $this->load->view('user/forget_password');
    }
    public function register()
    {

        $this->load->view('user/register');
    }

    public function profile()
    {
        if ($this->session->userdata('reguser'))
            $this->load->view('user/profile');
    }

    public function logout()
    {
        if ($this->session->userdata('reguser')) {

            $this->session->set_userdata('reguser', '');
            $this->session->set_userdata('regname', '');
            $this->load->view('user/logout');
        }
    }
}
