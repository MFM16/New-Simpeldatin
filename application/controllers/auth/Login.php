<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Officer_model', 'officer');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['judul'] = 'Login Page';
        $this->load->view('auth/login', $data);
    }

    public function signIn()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == true) {
            $checkTableUser = $this->user->getDataByEmail($this->input->post('email'));
            $checkTableOfficer = $this->officer->getDataByEmail($this->input->post('email'));

            if ($checkTableUser > 0) {
                $user = $checkTableUser;
            } else if ($checkTableOfficer > 0) {
                $user = $checkTableOfficer;
            } else {
                $user = NULL;
            }

            if ($user) {
                if ($user['is_active'] == 1) {
                    if (password_verify($this->input->post('password'), $user['password'])) {

                        $this->session->set_tempdata('role_id', $user['role_id'], 3600);
                        $this->session->set_tempdata('email', $user['email'], 3600);
                        $this->session->set_tempdata('phone', $user['phone_number'], 3600);
                        $this->session->set_tempdata('photo', $user['photo'], 3600);
                        $this->session->set_tempdata('is_login', 1, 3600);
                        if ($user['role_id'] == 3) {
                            $this->user->updateLastLogin($user['email']);
                            $this->session->set_tempdata('name', $user['name'], 3600);
                            $this->session->set_tempdata('company', $user['company'], 3600);
                            $this->session->set_tempdata('job_id', $user['job_id'], 3600);
                            $this->session->set_tempdata('other_job', $user['other_job'], 3600);
                            echo 'home';
                        } else if ($user['role_id'] == 1 || $user['role_id'] == 2) {
                            if ($user['role_id'] == 2) {
                                $this->session->set_tempdata('sub_role', $user['sub_role_id'], 3600);
                                $this->session->set_tempdata('field', $user['field_id'], 3600);
                                $this->session->set_tempdata('sub_field', $user['sub_field_id'], 3600);
                                $this->session->set_tempdata('officer', $user['officer_id'], 3600);
                            }
                            $this->session->set_tempdata('name', $user['officer_name'], 3600);
                            echo 'admin';
                        }
                    } else {
                        echo 'Password Salah';
                    }
                } else {
                    echo 'E-mail has not been activated';
                }
            } else {
                echo 'E-mail not registered';
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function logout()
    {
        $this->session->unset_tempdata('name');
        $this->session->unset_tempdata('role_id');
        $this->session->unset_tempdata('email');
        $this->session->unset_tempdata('is_login');
        $this->session->unset_tempdata('phone');
        $this->session->unset_tempdata('photo');
        $this->session->unset_tempdata('company');
        $this->session->unset_tempdata('job_id');
        $this->session->unset_tempdata('other_job');
        $this->session->unset_tempdata('sub_role');
        $this->session->unset_tempdata('field');
        $this->session->unset_tempdata('sub_field');
        $this->session->unset_tempdata('officer');

        redirect('home');
    }
}
