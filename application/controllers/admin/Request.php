<?php
class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model', 'request');
        $this->load->model('History_model', 'history');
        $this->load->model('Field_model', 'field');
        $this->load->model('File_model', 'file');
        $this->load->model('User_model', 'user');
        $this->load->model('Link_model', 'link');
        $this->load->model('Process_history_model', 'process');
        $this->load->model('Officer_model', 'officer');
        $this->load->model('Sub_field_model', 'sub_field');
        $this->load->helper(array('form', 'url'));
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

    public function process($request_id)
    {
        $data['judul'] = 'Admin Area';
        $data['sidebar'] = 'permohonan';
        $data['fields'] = $this->field->getAllData();
        $data['user'] = $this->request->getDataByRequestId($request_id);
        $data['files'] = $this->file->getDataByRequestId($request_id);
        $data['admins'] = $this->officer->getDataAdmin();
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/permohonan/process', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function updategeneral()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
        $this->form_validation->set_rules('phone', 'No. Telepon / HP', 'required|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('used', 'Keperluan', 'required|integer|in_list[1,2,3,4,5]');
        if ($this->input->post('used') == 5) {
            $this->form_validation->set_rules('otherUsed', 'Keperluan Lain For', 'required|max_length[255]');
        }
        $this->form_validation->set_rules('dataName', 'Data Name', 'required|max_length[255]');
        $this->form_validation->set_rules('dateline', 'Batas Waktu', 'required|integer');
        $this->form_validation->set_rules('field', 'Bidang', 'integer');

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('name'));
            $phone = htmlspecialchars($this->input->post('phone'));
            $email = $this->input->post('email');
            $used = $this->input->post('used');
            $otherUsed = $this->input->post('otherUsed') != '' ? $this->input->post('otherUsed') : NULL;
            $dataName = htmlspecialchars($this->input->post('dataName'));
            $dateline = $this->input->post('dateline');
            $field = $this->input->post('field') == '' ? NULL : $this->input->post('field');
            $id = $this->input->post('id');

            $request = [
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone,
                'field_id' => $field,
                'used_for_id' => $used,
                'other_used_for' => $otherUsed,
                'data_name' => $dataName,
                'dateline' => date('Y-m-d', strtotime('+' . $dateline . ' days', strtotime(date('Y-m-d')))),
                'updated_at' => date('y-m-d H:i:s'),
                'updated_by' => $this->session->tempdata('name'),
            ];

            $user = [
                'phone_number' => $phone,
                'name' => $name,
                'updated_at' => date('y-m-d H:i:s')
            ];

            $this->request->update($id, $request);
            $this->user->editDataByEmail($email, $user);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function savespecial()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
        $this->form_validation->set_rules('company', 'Instansi', 'required|max_length[255]');
        $this->form_validation->set_rules('phone', 'No. Telepon / HP', 'trim|max_length[20]|min_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('used', 'Keperluan', 'required|integer|in_list[1,2,3,4,5]');
        if ($this->input->post('used') == 5) {
            $this->form_validation->set_rules('otherUsed', 'Keperluan Lain For', 'required|max_length[255]');
        }
        $this->form_validation->set_rules('dataName', 'Data Name', 'required|max_length[255]');
        $this->form_validation->set_rules('field', 'Bidang', 'required|integer');

        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($this->form_validation->run() == true) {
            $receipt = substr(str_shuffle($set), 0, 20);
            $name = htmlspecialchars($this->input->post('name'));
            $company = htmlspecialchars($this->input->post('company'));
            $phone = htmlspecialchars($this->input->post('phone'));
            $email = $this->input->post('email') != '' ? $this->input->post('email') : NULL;
            $used = $this->input->post('used');
            $otherUsed = $this->input->post('otherUsed') != '' ? $this->input->post('otherUsed') : NULL;
            $dataName = htmlspecialchars($this->input->post('dataName'));
            $field = $this->input->post('field');

            if (isset($_FILES['evidence'])) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/evidence/';
                $evidenceName = str_replace('', '_', $_FILES['evidence']['name']);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('evidence')) {
                    $evidence = $evidenceName;
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $evidence = NULL;
            }

            $request = [
                'receipt_number' => $receipt,
                'request_date' => date('y-m-d'),
                'name' => $name,
                'company' => $company,
                'email' => $email,
                'phone_number' => $phone,
                'field_id' => $field,
                'sub_field_id' => NULL,
                'officer_id' => NULL,
                'used_for_id' => $used,
                'other_used_for' => $otherUsed,
                'data_name' => $dataName,
                'first_process' => date('y-m-d H:i:s'),
                'second_process' => NULL,
                'third_process' => NULL,
                'forth_process' => NULL,
                'final_process' => NULL,
                'process_state' => 1,
                'dateline' => NULL,
                'survey_status' => NULL,
                'is_special' => 1,
                'evidence' => $evidence,
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

            $this->request->save($request);
            $this->history->save($request_history);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function updatespecial()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
        $this->form_validation->set_rules('company', 'Instansi', 'required|max_length[255]');
        $this->form_validation->set_rules('phone', 'No. Telepon / HP', 'trim|max_length[20]|min_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('used', 'Keperluan', 'required|integer|in_list[1,2,3,4,5]');
        if ($this->input->post('used') == 5) {
            $this->form_validation->set_rules('otherUsed', 'Keperluan Lain For', 'required|max_length[255]');
        }
        $this->form_validation->set_rules('dataName', 'Data Name', 'required|max_length[255]');
        $this->form_validation->set_rules('field', 'Bidang', 'required|integer');

        if ($this->form_validation->run() == true) {
            $name = htmlspecialchars($this->input->post('name'));
            $company = htmlspecialchars($this->input->post('company'));
            $phone = htmlspecialchars($this->input->post('phone'));
            $email = $this->input->post('email') != '' ? $this->input->post('email') : NULL;
            $used = $this->input->post('used');
            $otherUsed = $this->input->post('otherUsed') != '' ? $this->input->post('otherUsed') : NULL;
            $dataName = htmlspecialchars($this->input->post('dataName'));
            $field = $this->input->post('field');
            $id = $this->input->post('id');

            if (isset($_FILES['evidence'])) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/evidence/';
                $evidenceName = str_replace('', '_', $_FILES['evidence']['name']);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('evidence')) {
                    $evidence = $evidenceName;
                } else {
                    echo $this->upload->display_errors();
                }

                $request = [
                    'name' => $name,
                    'email' => $email,
                    'company' => $company,
                    'phone_number' => $phone,
                    'field_id' => $field,
                    'used_for_id' => $used,
                    'other_used_for' => $otherUsed,
                    'data_name' => $dataName,
                    'evidence' => $evidence,
                    'updated_at' => date('y-m-d H:i:s'),
                    'updated_by' => $this->session->tempdata('name'),
                ];
            } else {
                $request = [
                    'name' => $name,
                    'email' => $email,
                    'company' => $company,
                    'phone_number' => $phone,
                    'field_id' => $field,
                    'used_for_id' => $used,
                    'other_used_for' => $otherUsed,
                    'data_name' => $dataName,
                    'updated_at' => date('y-m-d H:i:s'),
                    'updated_by' => $this->session->tempdata('name'),
                ];
            }

            $this->request->update($id, $request);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function delete($request_id)
    {
        $data = [
            'deleted_at' => date('y-m-d H:i:s')
        ];

        $this->request->update($request_id, $data);
    }

    public function getdata($request_id)
    {
        $data = $this->request->getDataById($request_id);
        echo $data;
    }

    public function upload()
    {
        $file = str_replace([',', ' ', '/', '@'], '_', $_FILES['file']['name']);
        $filename = 'Files_' . $this->input->post('id') . '_' . $file;
        $config['allowed_types'] = 'jpg|png|jpeg|pdf|xls|xlsx|docx';
        $config['max_size']      = '2048';
        $config['upload_path'] = './assets/img/files/';
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $data = [
                'request_id' => $this->input->post('id'),
                'file_name' => $filename,
                'created_at' => date('y-m-d H:i:s')
            ];

            $this->file->add($data);
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function reject()
    {
        $this->form_validation->set_rules('reason', 'Alasan', 'required|max_length[255]');
        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id');
            $reason = htmlspecialchars($this->input->post('reason'));
            $receipt = $this->input->post('receipt_number');
            $name = $this->input->post('name');

            $data = [
                'process_state' => -1,
                'updated_at' => date('y-m-d H:i:s'),
                'updated_by' => $this->session->tempdata('name')
            ];

            $reject = [
                'history_description' => 'Data permohonan dengan resi <strong>' . $receipt . '</strong> atas nama <strong> ' . $name . '</strong> telah ditolak oleh <strong>' . $this->session->tempdata('name') . '</strong> dengan alasan <strong>' . $reason . '</strong>',
                'is_success' => 0,
                'created_at' => date('y-m-d H:i:s'),
                'deleted_at' => NULL
            ];

            $this->request->update($id, $data);
            $this->process->add($reject);
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function sent()
    {
        $id = $this->input->post('id');
        $receipt_number = $this->input->post('receipt_number');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $data = [
            'process_state' => 5,
            'final_process' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s'),
            'updated_by' => $this->session->tempdata('name')
        ];

        $link = [
            'receipt_number' => $receipt_number,
            'expired_date' => date('Y-m-d', strtotime('+30 days', strtotime(date('Y-m-d')))),
            'created_at' => date('y-m-d H:i:s')
        ];

        $sent = [
            'history_description' => 'Data permohonan dengan resi <strong>' . $receipt_number . '</strong> atas nama <strong> ' . $name . '</strong> telah dikirimkan oleh <strong>' . $this->session->tempdata('name') . ' </strong> kepada pemohon data ',
            'is_success' => 1,
            'created_at' => date('y-m-d H:i:s'),
            'deleted_at' => NULL
        ];


        if ($this->request->update($id, $data) && $this->link->add($link) && $this->process->add($sent)) {

            $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
            $this->email->to($email);
            $this->email->subject('Permohonan Selesai Diproses');
            $this->email->message('
                Yth. Pemohon Data, <br><br><br>

                Permohonan anda dengan resi <strong>' . $receipt_number . '</strong> telah selesai diproses.<br>
                Silahkan unduh file tersebut pada link dibawah ini<br>
                <a href="https://simpeldatin.setjen.pertanian.go.id/request/receipt/' . $id . '/' . $receipt_number . '">Download Data</a><br><br>

                <p style="color: red;">*File dapat diunduh dalam jangka waktu 30 hari, setelah 30 hari file tidak dapat diunduh kembali</p><br><br>

                                    
                Hormat Kami,<br>
                Pusat Data dan Sistem Informasi Pertanian);
            ');
            $this->email->send();
        }
    }

    public function forward()
    {
        if ($this->input->post('field') != '') {
            $this->form_validation->set_rules('field', 'Bidang', 'required');
        }
        if ($this->input->post('subField') != '') {
            $this->form_validation->set_rules('subField', 'Sub Bidang', 'required');
        }
        if ($this->input->post('officer') != '') {
            $this->form_validation->set_rules('officer', 'Pelaksana Tugas', 'required');
        }
        if ($this->input->post('admin') != '') {
            $this->form_validation->set_rules('admin', 'Admin', 'required');
        }

        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id');
            $receipt = $this->input->post('receipt');
            $dataName = $this->input->post('dataName');
            $utility = $this->input->post('utility');
            $emailUser = $this->input->post('email');
            if ($this->input->post('field') != 0) {
                $email = $this->officer->getEmailByFieldEs3($this->input->post('field'));
                $state = 'Verifikasi';
                $field = $this->field->getDataById($this->input->post('field'));
                $subject = 'Permohonan Data Baru';
                $message = 'Yth. Kepala ' . $field['field_name'] . ',<br><br><br>
				Ada Permohonan data masuk dengan resi <strong>' . $receipt . '</strong> dan mohon segera di proses<br><br>
				<strong>
				Keteranganan Permohonan Data :<br>
				Nama Data : ' . $dataName . ' <br>
				Keperluan : ' . $utility . '
				</strong>
				<br><br>
				untuk informasi lebih lanjut, silakan kunjungi Website di <a href="#">www.simpeldatin.setjen.pertanian.go.id</a>
				<br><br>
				Terima Kasih';
                $data = [
                    'field_id' => $this->input->post('field'),
                    'process_state' => 1,
                    'first_process' => date('y-m-d H:i:s'),
                    'updated_at' => date('y-m-d H:i:s'),
                    'updated_by' => $this->session->tempdata('name')
                ];
            }
            if ($this->input->post('subField') != 0) {
                $email = $this->officer->getEmailBySubField($this->input->post('subField'));
                $state = 'Proses';
                $sub_field = $this->sub_field->getDataById($this->input->post('subField'));
                $subject = 'Permohonan Data Baru';
                $message = '
					Yth. Kepala ' . $sub_field['sub_field_name'] . ',<br><br><br>
					Ada Permohonan Data masuk dengan resi <strong>' . $receipt . '</strong> dan mohon segera di proses<br><br>
					<strong>
					Keteranganan Permohonan Data :<br>
					Nama Data : ' . $dataName . ' <br>
					Keperluan : ' . $utility . '
					</strong>
					<br><br>
					untuk informasi lebih lanjut, silakan kunjungi Website di <a href="#">www.simpeldatin.setjen.pertanian.go.id</a>
					<br><br>
					Terima Kasih';
                $data = [
                    'sub_field_id' => $this->input->post('subField'),
                    'process_state' => 2,
                    'second_process' => date('y-m-d H:i:s'),
                    'updated_at' => date('y-m-d H:i:s'),
                    'updated_by' => $this->session->tempdata('name')
                ];
            }
            if ($this->input->post('officer') != 0) {
                $email = $this->officer->getEmailById($this->input->post('officer'));
                $state = 'Pengunggahan Berkas';
                $name = $this->officer->getNameById($this->input->post('officer'));
                $subject = 'Permohonan Data Baru';
                $message = '
					Yth. ' . $name['officer_name'] . ',<br><br><br>
					Ada Permohonan Data masuk dengan resi <strong>' . $receipt . '</strong> dan mohon segera di proses<br><br>
					<strong>
					Keteranganan Permohonan Data :<br>
					Nama Data : ' . $dataName . ' <br>
					Keperluan : ' . $utility . '
					</strong>
					<br><br>
					untuk informasi lebih lanjut, silakan kunjungi Website di <a href="#">www.simpeldatin.setjen.pertanian.go.id</a>
					<br><br>
					Terima Kasih';
                $data = [
                    'officer_id' => $this->input->post('officer'),
                    'process_state' => 3,
                    'third_process' => date('y-m-d H:i:s'),
                    'updated_at' => date('y-m-d H:i:s'),
                    'updated_by' => $this->session->tempdata('name')
                ];
            }
            if ($this->input->post('admin') != 0) {
                $email = $this->officer->getEmailAdmin();
                $state = 'Siap Dikirim <br> Silahkan tunggu beberapa saat lagi, permohonan akan segera dikirimkan ke email Anda';
                $subject = 'Data Siap Dikirim';
                $message = '
					Yth. Admin SIMPELDATIN,<br><br><br>
					Data dengan resi <strong>' . $receipt . '</strong> mohon segera dikirim ke yang bersangkutan<br><br>
					<strong>
					Keteranganan Permohonanan Data :<br>
					Nama Data : ' . $dataName . ' <br>
					Keperluan : ' . $utility . '
					</strong>
					<br><br>
					untuk informasi lebih lanjut, silakan kunjungi Website di <a href="#">www.simpeldatin.setjen.pertanian.go.id</a>
					<br><br>
					Terima Kasih';
                $data = [
                    'process_state' => 4,
                    'forth_process' => date('y-m-d H:i:s'),
                    'updated_at' => date('y-m-d H:i:s'),
                    'updated_by' => $this->session->tempdata('name')
                ];
            }

            if (!empty($data)) {
                $this->request->update($id, $data);

                for ($i = 0; $i < count($email); $i++) {
                    $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                    $this->email->to($email[$i]['email']);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();
                }

                $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                $this->email->to($emailUser);
                $this->email->subject('Proses');
                $this->email->message('
                    Yth. Bapak/Ibu <br><br><br>
                    Permintaan data Anda tercatat dengan no resi : <strong>' . $receipt . '</strong> sampai pada tahap <strong>' . $state . '</strong>.
                    <br><br>
                    Permintaan akan diproses maksimal selama 5 hari kerja dari jam 08.00 WIB - 15.00 WIB<br><br>
                    Untuk memeriksan status permintaan anda, silahkan klik link berikut ini
                    <a href="https://simpeldatin.setjen.pertanian.go.id/">Cek Resi</a><br>
                    atau untuk informasi lebih lanjut, silahkan kunjungi Pusat Bantuan di website kami pada link berikut ini
                    <a href="https://simpeldatin.setjen.pertanian.go.id">Website Simpeldatin<a><br><br><br>
                    Hormat Kami,<br>
                    Pusat Data dan Sistem Informasi Pertanian
                ');
                $this->email->send();
            } else {
                echo 'gagal';
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }

    public function getsentdata($request_id)
    {
        $data = $this->request->getDataByRequestIdJson($request_id);
        echo $data;
    }
    public function getfilesdata($request_id)
    {
        $files = $this->file->getDataByRequestIdJson($request_id);
        echo $files;
    }

    public function officer($field_id)
    {
        $data = $this->officer->getDataByFieldId($field_id);
        echo $data;
    }

    public function subfield($field_id)
    {
        $data = $this->sub_field->getDataByFieldId($field_id);
        echo $data;
    }

    public function destroy($id)
    {
        if ($this->file->delete($id)) {
            $arr = [
                'status' => true,
                'message' => 'File deleted successfully',
            ];

            echo json_encode($arr);
        } else {
            $arr = [
                'status' => false,
                'message' => 'File deleted failed',
            ];

            echo json_encode($arr);
        }
    }
}
