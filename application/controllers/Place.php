<?php
class Place extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Place_model', 'place');
        $this->load->library('form_validation');
    }

    public function insert()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
        $this->form_validation->set_rules('city', 'Kota', 'required');
        $this->form_validation->set_rules('district', 'Kecamatan', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('link', 'Google Maps Link', 'required|valid_url');

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'city' => $this->input->post('city'),
                'district' => $this->input->post('district'),
                'address' => $this->input->post('address'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'gmaps_link' => $this->input->post('link'),
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ];

            if ($this->place->insert($data)) {
                $arr = [
                    'status' => true,
                    'message' => 'New data has been created successfully',
                ];

                $response = json_encode($arr);
                echo $response;
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            $arr = [
                'status' => false,
                'message' => $err_msg,
            ];

            $response = json_encode($arr);
            echo $response;
        }
    }

    public function show($id)
    {
        $data = $this->place->getDataById($id);

        if ($data) {
            $arr = [
                'status' => true,
                'message' => 'Get data has been successfully',
                'data' => $data
            ];

            $response = json_encode($arr);
            echo $response;
        } else {
            $arr = [
                'status' => false,
                'message' => 'Data not found',
            ];

            $response = json_encode($arr);
            echo $response;
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
        $this->form_validation->set_rules('city', 'Kota', 'required');
        $this->form_validation->set_rules('district', 'Kecamatan', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('link', 'Google Maps Link', 'required|valid_url');

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name')),
                'city' => htmlspecialchars($this->input->post('city')),
                'district' => htmlspecialchars($this->input->post('district')),
                'address' => htmlspecialchars($this->input->post('address')),
                'latitude' => htmlspecialchars($this->input->post('latitude')),
                'longitude' => htmlspecialchars($this->input->post('longitude')),
                'gmaps_link' => htmlspecialchars($this->input->post('link')),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->place->update($this->input->post('id'), $data)) {
                $arr = [
                    'status' => true,
                    'message' => 'Data has been updated successfully',
                ];

                $response = json_encode($arr);
                echo $response;
            } else {
                $arr = [
                    'status' => false,
                    'message' => 'Failed to update data',
                ];

                $response = json_encode($arr);
                echo $response;
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            $arr = [
                'status' => false,
                'message' => $err_msg,
            ];

            $response = json_encode($arr);
            echo $response;
        }
    }

    public function delete($id)
    {
        if ($this->place->update($id, ['deleted_at' => date('Y-m-d H:i:s')])) {
            $arr = [
                'status' => true,
                'message' => 'Data has been deleted.',
            ];

            $response = json_encode($arr);
            echo $response;
        } else {
            $arr = [
                'status' => false,
                'message' => 'Failed to delete data.',
            ];

            $response = json_encode($arr);
            echo $response;
        }
    }
}
