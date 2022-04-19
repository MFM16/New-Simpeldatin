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
        $date = date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d'))));
        $user = $this->user->getEmailByDate($date);

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
                Silahkan klik link di bawah ini untuk melihat data - data tersebut<br>
                <a href='https://satudata.pertanian.go.id/'>Katalog Data</a><br>
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
                    Silahkan klik link di bawah ini untuk melihat data - data tersebut<br>
                    <a href='https://satudata.pertanian.go.id/'>Katalog Data</a><br>
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
