<?php
class Question_model extends CI_Model
{
    public function add($data)
    {
        $this->db->insert('questions_table', $data);
        return $this->db->affected_rows();
    }

    public function getAllData()
    {
        return $this->db->get_where('questions_table', ['deleted_at' => NULL])->result_array();
    }

    public function getDataById($question_id)
    {
        $data = $this->db->get_where('questions_table', ['question_id' => $question_id])->row_array();
        return json_encode($data);
    }

    public function delete($question_id, $data)
    {
        $this->db->where('question_id', $question_id);
        $this->db->update('questions_table', $data);
        return $this->db->affected_rows();
    }

    public function countAllData()
    {
        $this->db->where('deleted_at', NULL);
        $this->db->from('questions_table');
        return $this->db->count_all_results();
    }

    public function getDataAllByDate($start_date, $end_date)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('created_at BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->from('questions_table');
        return $this->db->get()->result_array();
    }
}
