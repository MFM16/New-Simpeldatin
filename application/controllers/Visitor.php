<?php
class Visitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Visitor_model', 'visitor');
        $this->load->model('Place_model', 'place');
        $this->load->model('LBS_model', 'lbs');
    }

    public function insert()
    {
        $data = $this->visitor->getDataByDate($this->input->post('ip'), date('Y-m-d'));
        if ($data) {
            $arr = [
                'status' => true,
                'message' => 'Data exist',
            ];

            $response = json_encode($arr);
            echo $response;
        } else {
            $data = [
                'ip_address' => $this->input->post('ip'),
                'city' => $this->input->post('city'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'created_at' => date('Y-m-d'),
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
            } else {
                $arr = [
                    'status' => true,
                    'message' => 'Failed',
                ];

                $response = json_encode($arr);
                echo $response;
            }
        }
    }

    public function email()
    {
        $district = $this->input->post('locality');

        if ($this->session->tempdata('email')) {
            if ($this->session->tempdata('role_id') == 3) {
                $data = $this->lbs->getDataByDate($this->session->tempdata('email'), $district);
                if ($data) {
                    $arr = [
                        'status' => true,
                        'message' => 'Data exist',
                    ];

                    $response = json_encode($arr);
                    echo $response;
                } else {
                    $data = $this->place->getDataByDistrict($district);
                    $list = '';
                    foreach ($data as $key) {
                        $newData = '
                        <a style="margin-bottom: 30px">
                            <p style="margin-right:20px"><strong>' . $key['name'] . '</strong></p>
                            <a href="' . $key['gmaps_link'] . '" style="margin-top: -30px">Link</a>
                        </a>
                        <br><br>
                        ';

                        $list .= $newData;
                    };

                    if ($data) {
                        $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                        $this->email->to($this->session->tempdata('email'));
                        $this->email->subject('Terdapat Data baru');
                        $this->email->message("
                        Selamat Pagi, <br>
                        Selamat Datang Bapak/ibu " . $this->session->tempdata('name') . " <br>
                        Yang telah terdaftar di SIMPELDATIN
                        <br><br><br><br>
    
                        Anda saat ini sedang berada di daerah " . $this->input->post('city') . " <br>
                        Berikut adalah daerah-derah yang bisa anda kunjungi dalam bentuk titik koordinat. <br><br>
                        " . $list . " <br><br>
                        <br><br><br>
    
                        Selamat jalan dan hati-hati<br>");

                        if ($this->email->send()) {
                            $data = [
                                'email' => $this->session->tempdata('email'),
                                'district' => $district,
                                'created_at' => date('y-m-d'),
                                'deleted_at' => NULL,
                            ];

                            $this->lbs->insert($data);

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

                            $response = json_encode($arr);
                            echo $response;
                        }
                    } else {
                        $arr = [
                            'status' => 'success',
                            'message' => 'Data not found',
                        ];

                        $response = json_encode($arr);
                        echo $response;
                    }
                }
            } else {
                $arr = [
                    'status' => 'success',
                    'message' => 'admin/officer',
                ];

                $response = json_encode($arr);
                echo $response;
            }
        } else {
            $arr = [
                'status' => 'success',
                'message' => 'no email detected',
            ];

            $response = json_encode($arr);
            echo $response;
        }
    }

    public function getPlace()
    {
        $data = $this->visitor->getAllData();
        if ($data) {
            $arr = [
                'status' => true,
                'message' => 'Get data successfully',
                'data' => $data
            ];

            echo json_encode($arr);
        }
    }
}
