<?php
class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getdatabycategoryid($category_id)
    {
        $data = $this->data->getDataByCategoryId($category_id);
        echo $data;
    }

    public function get()
    {
        $data = $this->data->getAllDataJson();
        echo $data;
    }
}
