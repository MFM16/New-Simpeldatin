<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './application/libraries/RestController.php';
require './application/libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Request extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model', 'req');
    }

    public function index_get()
    {
        $data = $this->req->getAllData();

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
}
