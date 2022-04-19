<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/RESTController.php';
require APPPATH . 'libraries/Format.php';

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
        $data = [
            'category_id' => $this->post('category'),
            'data_name' => $this->post('name'),
            'specific_commodity' => $this->post('specific'),
            'data_source' => $this->post('source'),
            'release_period' => $this->post('period'),
            'level' => $this->post('level'),
            'availability' => $this->post('availability'),
            'release_time' => $this->post('release'),
            'access' => $this->post('access'),
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => NULL,
            'deleted_at' => NULL
        ];

        try {
            $this->data->add($data);
            $this->response([
                'status' => true,
                'message' => 'New data has been created',
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
