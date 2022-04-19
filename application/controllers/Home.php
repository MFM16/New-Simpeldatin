<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model', 'profile');
        $this->load->model('Job_model', 'job');
        $this->load->model('Utility_model', 'utility');
        $this->load->model('User_model', 'user');
        $this->load->model('Question_model', 'question');
        $this->load->model('Data_model', 'data');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if ($this->session->tempdata('role_id')) {
            if ($this->session->tempdata('role_id') == 3) {
                $data['user'] = $this->user->getDataByEmail($this->session->tempdata('email'));
            }
        }
        $data['judul'] = 'SIMPELDATIN';
        $data['profile'] = $this->profile->getData();
        $data['jobs'] = $this->job->getData();
        $data['utilities'] = $this->utility->getData();
        $data['datas'] = $this->data->getNewData();
        $this->load->view('templates/header', $data);
        $this->load->view('home/index');
        $this->load->view('templates/footer', $data);
    }

    public function question()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('phone', 'No . Telepon / HP', 'required|trim|min_length[10]');
        $this->form_validation->set_rules('question', 'Pertanyaan', 'required|max_length[255]');

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('name'));
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $question = $this->input->post('question');

            $data = [
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone,
                'question' => $question,
                'created_at' => date('y-m-d'),
                'deleted_at' => NULL
            ];

            $this->question->add($data);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }
}
