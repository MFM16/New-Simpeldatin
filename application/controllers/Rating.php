<?php
class Rating extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rating_model', 'rating');
        $this->load->model('Comment_model', 'comment');
        $this->load->model('Request_model', 'request');
        $this->load->model('User_model', 'user');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function ratepage($email)
    {
        $data['judul'] = 'Rating Page';
        $data['comments'] = $this->comment->getComments();
        $this->load->view('home/page/rating', $data);
    }

    public function add()
    {
        if ($this->input->post('description') == '') {
            $this->form_validation->set_rules('comments', 'Komentar', 'required', [
                'required' => 'Silahkan pilih salah satu, mengisi lewat checkbox atau menulis di field yang telah disediakan'
            ]);
        }
        if ($this->input->post('comments') == '') {
            $this->form_validation->set_rules('description', 'Deskripsi', 'required', [
                'required' => 'Silahkan pilih salah satu, mengisi lewat checkbox atau menulis di field yang telah disediakan'
            ]);
        }
        $this->form_validation->set_rules('id', 'ID', 'required');

        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id');
            $request = $this->request->getDataByRequest_id($id);
            if ($request) {
                if ($request['is_special'] == 1) {
                    if ($request['email'] == NULL) {
                        echo 'success';
                        return;
                    } else {
                        $user = $this->user->getDataByEmail($request['email']);
                        if ($user) {
                            $user_id = $user['user_id'];
                        } {
                            echo 'success';
                            return;
                        }
                    }
                } else {
                    $user = $this->user->getDataByEmail($request['email']);
                    $user_id = $user['user_id'];
                }
            } else {
                echo 'Data Permohonan Tidak Ditemukan';
                return;
            }

            $rating = $this->input->post('rating');
            if ($this->input->post('description') == '') {
                $comments = $this->input->post('comments');
            } else if ($this->input->post('comments') == '') {
                $comments = $this->input->post('description');
            } else if ($this->input->post('comments') != '' && $this->input->post('description') != '') {
                $comments = $this->input->post('comments') . ',' . $this->input->post('description');
            }

            $data = [
                'user_id' => $user_id,
                'rating' => $rating,
                'comment' => $comments,
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ];

            if ($this->rating->insert($data)) {
                echo 'success';
            }
        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];

            echo $err_msg;
        }
    }
}
