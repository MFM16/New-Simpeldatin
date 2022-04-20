<?php
class List_data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function insert()
    {
        $this->form_validation->set_rules('data_name', 'Nama Data', 'required');
        $this->form_validation->set_rules('data_specific', 'Nama Spesifik Data', 'required');
        // $this->form_validation->set_rules('data_category', 'Kategori Data', 'required');
        $this->form_validation->set_rules('data_access', 'Link Akses', 'valid_url');

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('data_name'));
            $category = $this->input->post('data_category');
            $source = htmlspecialchars($this->input->post('data_source'));
            $specific = htmlspecialchars($this->input->post('data_specific'));
            $period = htmlspecialchars($this->input->post('data_period'));
            $level = htmlspecialchars($this->input->post('data_level'));
            $availability = htmlspecialchars($this->input->post('data_availability'));
            $release = htmlspecialchars($this->input->post('data_release'));
            $access = $this->input->post('data_access') == '' ? NULL : htmlspecialchars($this->input->post('data_access'));

            $data = [
                'category_id' => $category,
                'data_name' => $name,
                'specific_commodity' => $specific,
                'data_source' => $source,
                'release_period' => $period,
                'level' => $level,
                'availability' => $availability,
                'release_time' => $release,
                'access' => $access,
                'photo' => NULL,
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => NULL,
                'deleted_at' => NULL
            ];

            $this->data->add($data);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('data_name', 'Nama Data', 'required');
        $this->form_validation->set_rules('data_specific', 'Nama Spesifik Data', 'required');
        $this->form_validation->set_rules('data_category', 'Kategori Data', 'required');
        $this->form_validation->set_rules('data_access', 'Link Akses', 'valid_url');

        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id');
            $name = htmlspecialchars($this->input->post('data_name'));
            $category = $this->input->post('data_category');
            $source = htmlspecialchars($this->input->post('data_source'));
            $specific = htmlspecialchars($this->input->post('data_specific'));
            $period = htmlspecialchars($this->input->post('data_period'));
            $level = htmlspecialchars($this->input->post('data_level'));
            $availability = htmlspecialchars($this->input->post('data_availability'));
            $release = htmlspecialchars($this->input->post('data_release'));
            $access = $this->input->post('data_access') == '' ? NULL : htmlspecialchars($this->input->post('data_access'));

            $data = [
                'category_id' => $category,
                'data_name' => $name,
                'specific_commodity' => $specific,
                'data_source' => $source,
                'release_period' => $period,
                'level' => $level,
                'availability' => $availability,
                'release_time' => $release,
                'access' => $access,
                'updated_at' => date('y-m-d H:i:s'),
            ];

            $this->data->update($id, $data);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function get($data_id)
    {
        $data = $this->data->getDataById($data_id);
        echo $data;
    }
}
