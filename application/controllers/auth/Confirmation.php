<?php
class Confirmation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['judul'] = 'Confirmation Email';
        $this->load->view('auth/confirmation_email', $data);
    }

    public function activation()
    {
        $data['judul'] = 'Activation Email';
        $this->load->view('auth/activate', $data);
    }

    public function activate()
    {
        $confirmation_code = $this->input->post('confirmation_code');
        if ($this->user->activation($confirmation_code)) {
            $this->user->resetConfirmCode($confirmation_code);
            echo 'success';
        } else {
            echo 'failed';
        }
    }
}
