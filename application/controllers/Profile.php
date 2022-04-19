<?php
class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Officer_model', 'officer');
        $this->load->model('Job_model', 'job');
        $this->load->model('History_model', 'history');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));

        if (!$this->session->tempdata('is_login')) {
            redirect('home');
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['histories'] = $this->history->getDataByEmail($this->session->tempdata('email'));
        $data['user'] = $this->user->getDataByEmail($this->session->tempdata('email'));
        $data['judul'] = 'User Area';
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('home/page/profile/index', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function profile()
    {
        $data['jobs'] = $this->job->getData();
        $data['user'] = $this->user->getDataByEmail($this->session->tempdata('email'));
        $data['sidebar'] = 'profile';
        $data['judul'] = 'Profil User';
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('home/page/profile/profile', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function changePassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confPassword]');
        $this->form_validation->set_rules('confPassword', 'Confirm Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == true) {
            $email = htmlspecialchars($this->input->post('email', true));
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 10]);

            $data = ['password' => $password];
            if ($this->input->post('roleId') == 1 || $this->input->post('roleId') == 2) {
                $this->officer->editDataByEmail($email, $data);
            } else {
                $this->user->editDataByEmail($email, $data);
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function changeProfile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->input->post('role_id') == 3) {
            $this->form_validation->set_rules('job_id', 'Job', 'required|integer|in_list[1,2,3,4,5]');
            if ($this->input->post('job_id') == 5) {
                $this->form_validation->set_rules('other_job', 'Other Job', 'required|max_length[255]');
            }
            $this->form_validation->set_rules('company', 'Company', 'required|max_length[255]');
        }

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('name'));
            $phone = htmlspecialchars($this->input->post('phone'));
            $email = $this->input->post('email');

            if ($this->input->post('role_id') == 3) {
                $job = $this->input->post('job_id');
                $otherJob = $this->input->post('other_job') != '' ? $this->input->post('other_job') : NULL;
                $company = htmlspecialchars($this->input->post('company'));
            }

            if (isset($_FILES['photo'])) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/user/';
                $photoName = str_replace('', '_', $_FILES['photo']['name']);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('photo')) {
                    $photo = $photoName;
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $photo = $this->session->tempdata('photo');
            }

            if ($this->input->post('role_id') == 3) {
                $data = [
                    'name' => $name,
                    'phone_number' => $phone,
                    'job_id' => $job,
                    'other_job' => $otherJob,
                    'company' => $company,
                    'photo' => $photo,
                    'updated_at' => date('y-m-d H:i:s')
                ];

                $this->user->editDataByEmail($email, $data);

                $this->session->set_tempdata('name', $name, 3600);
                $this->session->set_tempdata('photo', $photo, 3600);
                $this->session->set_tempdata('phone', $phone, 3600);
                $this->session->set_tempdata('company', $company, 3600);
                $this->session->set_tempdata('job_id', $job, 3600);
                $this->session->set_tempdata('other_job', $otherJob, 3600);
            } else {
                $data = [
                    'officer_name' => $name,
                    'phone_number' => $phone,
                    'photo' => $photo,
                    'updated_at' => date('y-m-d H:i:s')
                ];

                $this->officer->editDataByEmail($email, $data);

                $this->session->set_tempdata('name', $name, 3600);
                $this->session->set_tempdata('photo', $photo, 3600);
                $this->session->set_tempdata('phone', $phone, 3600);
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }
}
