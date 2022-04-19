<?php
class Catalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
        $this->load->model('Category_model', 'category');
    }

    public function index()
    {
        $data['judul'] = 'Catalog Data';
        $data['datas'] = $this->data->getAllData();
        $data['categories'] = $this->category->getAllData();
        $this->load->view('home/page/catalog', $data);
    }
}
