<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require './application/libraries/RestController.php';
require './application/libraries/Format.php';

class Data extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
    }

    public function index_get()
    {
        $data = $this->data->getAllData();

        if ($data) {
            $this->response([
                'status' => true,
                'message' => 'Get data successfully',
                'data' => $data,
            ], RESTController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed get data'
            ], RESTController::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $data = $this->post()['form-data'];
        $arr = json_decode($data);

        $exe = explode('.', $_FILES['photo']['name']);
        $filename = $exe[0] . rand(1, 10000) . '.' . strtolower($exe[1]);
        $config['allowed_types'] = 'jpg|png|jpeg|';
        $config['max_size']      = '2048';
        $config['upload_path'] = './assets/img/data/';
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            $data = [
                'category_id' => NULL,
                'data_name' => $arr->name,
                'specific_commodity' => $arr->specific,
                'data_source' => NULL,
                'release_period' => NULL,
                'level' => NULL,
                'availability' => NULL,
                'release_time' => NULL,
                'access' => $arr->access,
                'photo' => $filename,
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => NULL,
                'deleted_at' => NULL
            ];

            if ($this->data->add($data)) {
                $this->response([
                    'status' => true,
                    'message' => 'New data has been created',
                    'data' => $data
                ], RESTController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to create new data'
                ], 400);
            }
        } else {
            echo $this->upload->display_errors();
        }
    }
}
