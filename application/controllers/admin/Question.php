<?php
class Question extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Question_model', 'question');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function delete($question_id)
    {
        $data = [
            'deleted_at' => date('y-m-d H:i:s')
        ];
        $this->question->delete($question_id, $data);
    }

    public function getdata($question_id)
    {
        $data = $this->question->getDataById($question_id);
        echo $data;
    }
}
