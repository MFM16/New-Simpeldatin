<?php
class Cronjob extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Data_model', 'data');
        $this->load->model('History_model', 'history');
        $this->load->config('email');
        $this->load->library('email');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function notiflogin()
    {
        // $date = date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))));
        $date = date('Y-m-d');
        $user = $this->user->getEmailByDate($date);
        $data = $this->data->getAllDataByDate(date('Y-m-d'));
        $list = '';
        if ($data) {
            foreach ($data as $key) {
                $newData = '
                <li style="margin-bottom: 10px">
                    <div style="display: flex; align-items: center;">
                        <div>
                            <p style="margin-right:20px"><strong>' . $key['data_name'] . '</strong></p>
                            <a href="' . $key['access'] . '" style="margin-top: -15px">Link</a>
                        </div>
                        <div>
                            <img src="' . base_url('assets/img/data/') . '' . $key['photo'] . '" width="50" height="70">
                        </div>
                    </div>
                </li>
                ';
                $list .= $newData;
            };
        }

        if ($user) {
            $length = count($user);

            for ($i = 0; $i < $length; $i++) {
                $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                $this->email->to($user[$i]['email']);
                $this->email->subject('Email Notifikasi');
                $this->email->message("
                Selamat Pagi, <br>
                Yth, Bapak/ibu " . $user[$i]['name'] . "
                <br><br><br><br>

                Sudah 3 hari, dari hari terakhir bapak / ibu meminta data di Website SIMPELDATIN.<br>
                Terdapat beberapa data baru yang sesuai dengan data yang terakhir kali diminta.<br>
                Silahkan klik link di bawah ini untuk melihat data - data tersebut<br><br>

                <ul>" . $list . "</ul><br><br>

                <a href='https://satudata.pertanian.go.id/'>Portal Satudata</a><br>
                <a href='" . base_url('auth/login') . "'>Login Simpeldatin</a><br>
                <a href='#'>Guide Book</a><br>
                <br><br><br>

                Hormat Kami,<br>
                Pusat Data dan Sistem Informasi Pertanian");
                $this->email->send();
            }
        }
        die;
    }

    public function notifnewdata()
    {
        $date = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))));
        $data = $this->data->getDataByDate($date);
        $arr = [];
        $new = $this->data->getAllDataByDate(date('Y-m-d'));
        $list = '';
        if ($new) {
            foreach ($new as $key) {
                $newData = '
                <li>
                    <div style="display: flex; align-items: center;">
                        <div>
                            <p style="margin-right:20px"><strong>' . $key['data_name'] . '</strong></p>
                            <a href="' . $key['access'] . '" style="margin-top: -15px">Link</a>
                        </div>
                        <div>
                            <img src="' . base_url('assets/img/data/') . '' . $key['photo'] . '" width="50" height="70">
                        </div>
                    </div>
                </li>
                ';

                $list .= $newData;
            };
        }

        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $array = array_merge_recursive($arr, $data[$i]);
                $arr = $array;
            }

            $email = [];
            for ($i = 0; $i < count($arr['specific_commodity']); $i++) {
                $search_email = $this->history->getEmailByDataName($arr['specific_commodity'][$i]);
                $SumEmail = array_merge_recursive($email, $search_email);
                $email = $SumEmail;
            }

            $fixEmail = [];
            for ($i = 0; $i < count($email); $i++) {
                $array = array_merge_recursive($fixEmail, $email[$i]);
                $fixEmail = $array;
            }

            $tempEmail = [];
            for ($i = 0; $i < count($fixEmail['email']); $i++) {
                if (!in_array($fixEmail['email'][$i], $tempEmail)) {

                    $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
                    $this->email->to($fixEmail['email'][$i]);
                    $this->email->subject('Terdapat Data baru');
                    $this->email->message("
                    Selamat Pagi, <br>
                    Yth, Bapak/ibu
                    <br><br><br><br>

                    Terdapat data pertanian baru yang mungkin sesuai dengan data yang pernah Bapak/Ibu inginkan.<br>
                    Silahkan klik link di bawah ini untuk melihat data - data tersebut<br><br>

                    <ul>" . $list . "</ul><br><br>

                    <a href='https://satudata.pertanian.go.id/'>Portal Satudata</a><br>
                    <a href='" . base_url('auth/login') . "'>Login Simpeldatin</a><br>
                    <a href='#'>Guide Book</a><br>
                    <br><br><br>

                    Hormat Kami,<br>
                    Pusat Data dan Sistem Informasi Pertanian");
                    $this->email->send();

                    $email = array_push($tempEmail, $fixEmail['email'][$i]);
                }
            }
        }
    }
}
