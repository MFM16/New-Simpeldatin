<?php
class Survei_question_model extends CI_Model
{
    public function get()
    {
        return $this->db->get('question_survei_table')->result_array();
    }
}
