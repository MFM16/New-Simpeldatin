<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Request_model', 'request');
        $this->load->model('Officer_model', 'officer');
        $this->load->model('Sub_role_model', 'sub_role');
        $this->load->model('Role_model', 'role');
        $this->load->model('Sub_field_model', 'sub_field');
        $this->load->model('Field_model', 'field');
        $this->load->model('Rating_model', 'rating');
        $this->load->model('Question_model', 'question');
        $this->load->model('Process_history_model', 'process');
        $this->load->model('Utility_model', 'utility');
        $this->load->model('Data_model', 'data');
        $this->load->model('Category_model', 'category');
        $this->load->model('Survei_question_model', 'survei');
        if ($this->session->tempdata('role_id')) {
            if ($this->session->tempdata('role_id')  == 3) {
                redirect('home');
            }
        } else {
            redirect('home');
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        for ($i = 1; $i < 13; $i++) {
            $data['umum' . $i . ''] = $this->request->countDataByFieldPerMonth(1, $i);
            $data['komo' . $i . ''] = $this->request->countDataByFieldPerMonth(2, $i);
            $data['nonkomo' . $i . ''] = $this->request->countDataByFieldPerMonth(3, $i);
            $data['si' . $i . ''] = $this->request->countDataByFieldPerMonth(4, $i);

            $data['umum2' . $i . ''] = $this->request->countDataByFieldPerMonthSent(1, $i);
            $data['komo2' . $i . ''] = $this->request->countDataByFieldPerMonthSent(2, $i);
            $data['nonkomo2' . $i . ''] = $this->request->countDataByFieldPerMonthSent(3, $i);
            $data['si2' . $i . ''] = $this->request->countDataByFieldPerMonthSent(4, $i);
        }
        if ($this->session->tempdata('role_id') == 2) {
            if ($this->session->tempdata('sub_role') == 2) {
                $data['request'] = $this->request->countAllDataByField($this->session->tempdata('field'));
                $data['send'] = $this->request->countAllDataByFieldSent($this->session->tempdata('field'));
                $data['reject'] = $this->request->countAllDataByFieldReject($this->session->tempdata('field'));
            } elseif ($this->session->tempdata('sub_role') == 1) {
                $data['request'] = $this->request->countAllDataBySubField($this->session->tempdata('sub_field'));
                $data['send'] = $this->request->countAllDataBySubFieldSent($this->session->tempdata('sub_field'));
                $data['reject'] = $this->request->countAllDataBySubFieldReject($this->session->tempdata('sub_field'));
            } elseif ($this->session->tempdata('sub_role') == 3) {
                $data['request'] = $this->request->countAllDataByOfficer($this->session->tempdata('officer'));
                $data['send'] = $this->request->countAllDataByOfficerSent($this->session->tempdata('officer'));
                $data['reject'] = $this->request->countAllDataByOfficerReject($this->session->tempdata('officer'));
            }
        }

        $data['ratings'] = $this->rating->getData();
        $total_rating = $this->rating->getRating()->result();
        $data['total_data'] = $this->rating->count();

        $data['rate'] = round($total_rating[0]->total_rating / $data['total_data']);

        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'home';
        $data['count'] = $this->request->countAllData();
        $data['question'] = $this->question->countAllData();
        $data['sent'] = $this->request->countSentData();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function permohonan()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'permohonan';
        if ($this->session->tempdata('role_id') == 1) {
            $data['generals'] = $this->request->getDataGeneral();
            $data['specials'] = $this->request->getDataSpecial();
        } elseif ($this->session->tempdata('role_id') == 2) {
            if ($this->session->tempdata('sub_role') == 1) {
                $data['generals'] = $this->request->getDataGeneralBySubField($this->session->tempdata('sub_field'));
                $data['specials'] = $this->request->getDataSpecialBySubField($this->session->tempdata('sub_field'));
            } elseif ($this->session->tempdata('sub_role') == 2) {
                $data['generals'] = $this->request->getDataGeneralByField($this->session->tempdata('field'));
                $data['specials'] = $this->request->getDataSpecialByField($this->session->tempdata('field'));
            } elseif ($this->session->tempdata('sub_role') == 3) {
                $data['generals'] = $this->request->getDataGeneralByOfficer($this->session->tempdata('officer'));
                $data['specials'] = $this->request->getDataSpecialByOfficer($this->session->tempdata('officer'));
            }
        }
        $data['utilities'] = $this->utility->getData();
        $data['fields'] = $this->field->getAllData();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/permohonan/index', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function pegawai()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'pegawai';
        $data['officers'] = $this->officer->getAllData();
        $data['Admins'] = $this->officer->GetDataAdmin();
        $data['roles'] = $this->role->getAllData();
        $data['fields'] = $this->field->getAllData();
        $data['sub_fields'] = $this->sub_field->getAllData();
        $data['sub_roles'] = $this->sub_role->getAllData();

        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/officer', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function bantuan()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'bantuan';
        $data['questions'] = $this->question->getAllData();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/bantuan', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function survei()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'survei';
        $data['survei'] = $this->request->dataSurvei();
        $data['question'] = $this->survei->get();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/survei', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function list()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'list';
        $data['datas'] = $this->data->getAllData();
        $data['categories'] = $this->category->getAllData();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/list_data', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function kirim()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'file';
        $data['datas'] = $this->request->getDataReadyToSent();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/kirim', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function pengiriman()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'pengiriman';
        $data['histories'] = $this->process->getSentData();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/history', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function penolakan()
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'penolakan';
        $data['histories'] = $this->process->getRejectData();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/history', $data);
        $this->load->view('admin/includes/footer', $data);
    }
}
