<?php

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['judul'] = 'Registration Page';
        $this->load->view('auth/registration', $data);
    }

    public function register()
    {
        $this->form_validation->set_rules('myEmail', 'Email', 'required|valid_email|trim|is_unique[users_table.email]|is_unique[officers_table.email]', [
            'is_unique' => 'E-mail has been registered'
        ]);
        $this->form_validation->set_rules('myPassword', 'Password', 'required|trim|min_length[8]|matches[confirmPassword]');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|trim|matches[myPassword]');

        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($this->form_validation->run() == true) {
            $code = substr(str_shuffle($set), 0, 20);
            $email = htmlspecialchars($this->input->post('myEmail', true));
            $password = password_hash($this->input->post('myPassword'), PASSWORD_DEFAULT, ['cost' => 10]);
            $str = explode('@', $email);
            $name = $str[0];

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role_id' => 3,
                'job' => '',
                'last_category_requested' => '',
                'last_login' => NULL,
                'photo' => 'is_default.png',
                'is_active' => 0,
                'confirmation_code' => $code,
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => NULL,
                'deleted_at' => NULL
            ];

            $this->user->save($data);

            $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
            $this->email->to($email);
            $this->email->subject('Aktifasi Akun');
            $this->email->message('
                <h2>Aktifkan Akunmu</h2>
                <h4>Kenapa memerlukan sebuah akun?</h4>
                <p>Akun SIMPELDATIN digunakan untuk mendapatkan layanan permohonan data</p>
                <p>Untuk mengaktifkan akun, kamu bisa menekan tombol di bawah ini </p>
                <a href="http://localhost/newsimpeldatin/auth/confirmation/activation/' . $code . '">Aktifkan</a>
            ');
            $this->email->send();
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }
}
