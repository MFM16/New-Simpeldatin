<?php
class Officer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Officer_model', 'officer');
        $this->load->library('form_validation');
        if ($this->session->tempdata('role_id')) {
            if ($this->session->tempdata('role_id')  == 3) {
                redirect('home');
            }
        } else {
            redirect('home');
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('phone', 'No. Telepon / HP', 'required|min_length[10]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[officers_table.email]|is_unique[users_table.email]', [
            'is_unique' => 'E-mail has been registered'
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->input->post('role') == 1) {
            $this->form_validation->set_rules('subField', 'Sub Bidang', 'required');
        } else if ($this->input->post('role') == 2 || $this->input->post('role') == 3) {
            $this->form_validation->set_rules('field', 'Bidang', 'required');
        }

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('name'));
            $password = password_hash(12345678, PASSWORD_DEFAULT, ['cost' => 10]);
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $role = $this->input->post('role') == 'Admin' ? 1 : 2;
            $sub_role = $this->input->post('role') == 'Admin' ? NULL : $this->input->post('role');
            $field = $this->input->post('field') == '' ? NULL : $this->input->post('field');
            $subField = $this->input->post('subField') == '' ? NULL : $this->input->post('subField');

            $data = [
                'officer_name' => $name,
                'email' => $email,
                'password' => $password,
                'phone_number' => $phone,
                'photo' => 'is_default.png',
                'role_id' => $role,
                'sub_role_id' => $sub_role,
                'field_id' => $field,
                'sub_field_id' => $subField,
                'is_active' => 1,
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
            ];

            $this->officer->add($data);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('phone', 'No. Telepon / HP', 'required|min_length[10]|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->input->post('role') == 1) {
            $this->form_validation->set_rules('subField', 'Sub Bidang', 'required');
        } else if ($this->input->post('role') == 2 || $this->input->post('role') == 3) {
            $this->form_validation->set_rules('field', 'Bidang', 'required');
        }

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('name'));
            $phone = $this->input->post('phone');
            $role = $this->input->post('role') == 'Admin' ? 1 : 2;
            $sub_role = $this->input->post('role') == 'Admin' ? NULL : $this->input->post('role');
            $field = $this->input->post('field') == '' ? NULL : $this->input->post('field');
            $subField = $this->input->post('subField') == '' ? NULL : $this->input->post('subField');
            $id = $this->input->post('id');

            $data = [
                'officer_name' => $name,
                'phone_number' => $phone,
                'role_id' => $role,
                'sub_role_id' => $sub_role,
                'field_id' => $field,
                'sub_field_id' => $subField,
                'updated_at' => date('y-m-d H:i:s'),
                'updated_by' => $this->session->tempdata('name'),
                'deleted_at' => NULL,
            ];

            $this->officer->editData($id, $data);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function delete($officer_id)
    {
        $data = [
            'is_active' => 0,
            'deleted_at' => date('y-m-d H:i:s')
        ];

        $this->officer->editData($officer_id, $data);
    }

    public function getdata($officer_id)
    {
        $data = $this->officer->getDataById($officer_id);
        echo $data;
    }
}
