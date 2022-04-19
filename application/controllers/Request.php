<?php
class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model', 'request');
        $this->load->model('History_model', 'history');
        $this->load->model('File_model', 'file');
        $this->load->model('Link_model', 'link');
        $this->load->model('Utility_model', 'utility');
        $this->load->model('Officer_model', 'officer');
        $this->load->model('User_model', 'user');
        $this->load->helper(array('form', 'url', 'download'));
        $this->load->library('email');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function save()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('job', 'Job', 'required|integer|in_list[1,2,3,4,5]');
        if ($this->input->post('job') == 5) {
            $this->form_validation->set_rules('otherJob', 'Other Job', 'required|max_length[255]');
        }
        $this->form_validation->set_rules('company', 'Company', 'required|max_length[255]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[1,2]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('used', 'Used For', 'required|integer|in_list[1,2,3,4,5]');
        if ($this->input->post('used') == 5) {
            $this->form_validation->set_rules('otherUsed', 'Other Used For', 'required|max_length[255]');
        }
        $this->form_validation->set_rules('dataName', 'Data Name', 'required|max_length[255]');

        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($this->form_validation->run() == true) {
            $receipt = substr(str_shuffle($set), 0, 20);
            $name = htmlspecialchars($this->input->post('name'));
            $job = $this->input->post('job');
            $otherJob = $this->input->post('otherJob') != '' ? $this->input->post('otherJob') : NULL;
            $company = htmlspecialchars($this->input->post('company'));
            $gender = $this->input->post('gender');
            $phone = htmlspecialchars($this->input->post('phone'));
            $email = $this->input->post('email');
            $used = $this->input->post('used');
            $otherUsed = $this->input->post('otherUsed') != '' ? $this->input->post('otherUsed') : NULL;
            $dataName = htmlspecialchars($this->input->post('dataName'));
            $utility = $this->utility->getDataById($used);
            $admin = $this->officer->getDataAdmin();

            $utility_name = $used == 5 ? $otherUsed : $utility['utility_name'];

            $request = [
                'receipt_number' => $receipt,
                'request_date' => date('y-m-d'),
                'name' => $name,
                'company' => $company,
                'email' => $email,
                'phone_number' => $phone,
                'field_id' => NULL,
                'sub_field_id' => NULL,
                'officer_id' => NULL,
                'used_for_id' => $used,
                'other_used_for' => $otherUsed,
                'data_name' => $dataName,
                'first_process' => NULL,
                'second_process' => NULL,
                'third_process' => NULL,
                'forth_process' => NULL,
                'final_process' => NULL,
                'process_state' => 0,
                'dateline' => NULL,
                'survey_status' => NULL,
                'is_special' => 0,
                'evidence' => NULL,
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
            ];

            $request_history = [
                'receipt_number' => $receipt,
                'email' => $email,
                'category_data' => NULL,
                'data_name' => $dataName,
                'created_at' => date('y-m-d H:i:s')
            ];

            $user = [
                'phone_number' => $phone,
                'gender' => $gender,
                'job_id' => $job,
                'other_job' => $otherJob,
                'company' => $company,
                'updated_at' => date('y-m-d H:i:s')
            ];

            $this->request->save($request);
            $this->history->save($request_history);
            $this->user->editDataByEmail($email, $user);

            $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
            $this->email->to($email);
            $this->email->subject('Nomor Resi Permohonan Data');
            $this->email->message('
                    Yth. Pemohon Data, <br><br><br>
                    Permintaan Data Anda Tercatat Dengan Resi :<strong> ' . $receipt . '</strong> dan Sedang Diproses<br><br><br>
                    Permintaan akan diproses maksimal selama 5 hari kerja dari jam 08.00 WIB - 15.00 WIB<br><br>
                    Untuk memeriksan status permintaan anda, silahkan klik link berikut ini
                    <a href="https://simpeldatin.setjen.pertanian.go.id">Cek Resi</a><br>
                    atau untuk informasi lebih lanjut, silahkan kunjungi Pusat Bantuan di website kami pada link berikut ini
                    <a href="https://simpeldatin.setjen.pertanian.go.id">Website Simpeldatin<a><br><br><br>
                    Hormat Kami,<br>
                    Pusat Data dan Sistem Informasi Pertanian');
            $this->email->send();

            for ($i = 0; $i < count($admin); $i++) {
                $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                $this->email->to($admin[$i]['email']);
                $this->email->subject('Nomor Resi Permohonan Data');
                $this->email->message('
                    Yth. Admin,<br><br><br>
                Ada permintaan data masuk dengan resi ' . $receipt . ' dan mohon segera di proses<br><br>
                <strong>
                Keteranganan Permintaan Data :<br>
                Nama Data : ' . $dataName . ' <br>
                Keperluan  : ' . $utility_name . '
                </strong>
                <br><br>
                untuk informasi lebih lanjut, silakan kunjungi Website di <a href="https://simpeldatin.setjen.pertanian.go.id/">www.simpeldatin.setjen.pertanian.go.id</a>
                <br><br>
                Terima Kasih');
                $this->email->send();
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function download($file_name)
    {
        $data = $this->file->download($file_name);
        $file = $data['file_name'];
        force_download('./assets/img/files/' . $file, NULL);
    }

    public function searchreceipt($receipt)
    {
        $data = empty($this->request->getDataByReceiptNumber($receipt)) ? NULL : $this->request->getDataByReceiptNumber($receipt);

        if ($data === NULL) {
            echo 'null';
        } else {
            echo $data;
        }
    }

    public function receipt($id, $receipt)
    {
        $data['judul'] = 'Pencarian Resi';
        $data['files'] = $this->file->getDataByRequestId($id);
        $data['data'] = $this->request->getDataByReceipt($receipt);
        $data['expired'] = $this->link->getDataByReceiptNumber($receipt);
        $this->load->view('home/page/receipt', $data);
    }
}
