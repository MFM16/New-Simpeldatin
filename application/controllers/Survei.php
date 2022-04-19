<?php
class Survei extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Survei_model', 'survei');
        $this->load->model('Request_model', 'request');
    }

    public function form($id, $receipt_number, $sub_field)
    {
        $data['judul'] = 'Halaman Survei';
        $data['id'] = $id;
        $data['receipt_number'] = $receipt_number;
        $data['sub_field'] = $sub_field;
        $this->load->view('home/page/survei', $data);
    }

    public function add()
    {
        $data = [
            'request_id' => $this->input->post('id'),
            'sub_field_id' => $this->input->post('sub_field'),
            'first_a' => $this->input->post('1a'),
            'first_b' => $this->input->post('1b'),
            'first_c' => htmlspecialchars($this->input->post('1c')),
            'second_a' => $this->input->post('2a'),
            'second_b' => $this->input->post('2b'),
            'second_c' => htmlspecialchars($this->input->post('2c')),
            'third_a' => $this->input->post('3a'),
            'third_b' => $this->input->post('3b'),
            'third_c' => htmlspecialchars($this->input->post('3c')),
            'forth_a' => $this->input->post('4a'),
            'forth_b' => $this->input->post('4b'),
            'forth_c' => htmlspecialchars($this->input->post('4c')),
            'fifth_a' => $this->input->post('5a'),
            'fifth_b' => $this->input->post('5b'),
            'fifth_c' => htmlspecialchars($this->input->post('5c')),
            'sixth_a' => $this->input->post('6a'),
            'sixth_b' => $this->input->post('6b'),
            'sixth_c' => htmlspecialchars($this->input->post('6c')),
            'seventh_a' => $this->input->post('7a'),
            'seventh_b' => $this->input->post('7b'),
            'seventh_c' => htmlspecialchars($this->input->post('7c')),
            'eigth_a' => $this->input->post('8a'),
            'eigth_b' => $this->input->post('8b'),
            'eigth_c' => htmlspecialchars($this->input->post('8c')),
            'ninth_a' => $this->input->post('9a'),
            'ninth_b' => $this->input->post('9b'),
            'ninth_c' => htmlspecialchars($this->input->post('9c')),
            'created_at' => date('y-m-d'),
            'deleted_at' => NULL
        ];

        $request = [
            'survey_status' => 1,
            'updated_at' => date('y-m-d H:i:s')
        ];

        if ($this->survei->add($data) && $this->request->update($this->input->post('id'), $request)) {
            $user = $this->request->getEmailById($this->input->post('id'));
            $email = $user['email'];
            $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
            $this->email->to($email);
            $this->email->subject('Penilaian Layanan SIMPELDATIN');
            $this->email->message('
                    Terima Kasih, <br>
                    Telah melakuakan permohonan data melalui website SIMPELDATIN
                    <br><br><br>

                    Untuk meningkatkan kualitas pelayanan. <br>
                    Dimohon kesediaannya untuk memberika peilaian melalui link di bawah ini <br>
                    Penilaian dari anda membuat pelayanan kami menjadi lebih baik <br><br>
                    <a href="' . base_url('rating/ratepage/') . $this->input->post('id') . '" style="border: none; border-radius:20px; background-color:aqua; padding-top: 3px; padding-bottom:3px; padding-left:5px; padding-right:5px">Rate Us</a><br><br><br>

                    Hormat Kami,<br>
                    Pusat Data dan Sistem Informasi Pertanian');
            $this->email->send();
            echo 'sukses';
        } else {
            echo 'gagal';
        }
    }

    public function getsurvei($id)
    {
        $data = $this->survei->getDataByRequestId($id);
        echo $data;
    }
}
