<?php
class Visitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Visitor_model', 'visitor');
        $this->load->model('Place_model', 'place');
    }

    public function insert()
    {
        $data = [
            'ip_address' => $this->input->post('ip'),
            'city' => $this->input->post('city'),
            'created_at' => date('Y-m-d H:i:s'),
            'deleted_at' => NULL,
        ];

        if ($this->visitor->add($data)) {
            $arr = [
                'status' => true,
                'message' => 'New data has been created',
                'data' => $data
            ];

            $response = json_encode($arr);
            echo $response;
        }
    }

    public function email()
    {
        $city = $this->input->post('city');
        if ($this->session->tempdata('email')) {
            $data = $this->place->getDataByCity($city);
            if ($data) {
                $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                $this->email->to($this->session->tempdata('email'));
                $this->email->subject('Terdapat Data baru');
                $this->email->message("
                    Selamat Pagi, <br>
                    Yth, Bapak/ibu
                    <br><br><br><br>

                    Terdapat data pertanian baru yang mungkin sesuai dengan data yang pernah Bapak/Ibu inginkan.<br>
                    Silahkan klik link di bawah ini untuk melihat data - data tersebut<br>
                    <a href='https://satudata.pertanian.go.id/'>Katalog Data</a><br>
                    <a href='" . base_url('auth/login') . "'>Login Simpeldatin</a><br>
                    <a href='#'>Guide Book</a><br>
                    <br><br><br>

                    Hormat Kami,<br>
                    Pusat Data dan Sistem Informasi Pertanian");

                if ($this->email->send()) {
                    $arr = [
                        'status' => 'success',
                        'message' => 'email has been sent successfully'
                    ];

                    echo json_encode($arr);
                } else {
                    $arr = [
                        'status' => 'failed',
                        'message' => 'failed to send email'
                    ];

                    echo json_encode($arr);
                }
            } else {
                $arr = [
                    'status' => 'success',
                    'message' => 'Data not found',
                ];

                echo json_encode($arr);
            }
        } else {
            $arr = [
                'status' => 'success',
                'message' => 'no email detected',
            ];

            echo json_encode($arr);
        }
    }
}
