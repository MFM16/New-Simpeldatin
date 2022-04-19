<?php
class Process_history_model extends CI_Model
{
    public function getSentData()
    {
        $this->db->where('is_success', 1);
        $this->db->where('deleted_at', NULL);
        $this->db->from('history_table');
        return $this->db->get()->result_array();
    }

    public function getRejectData()
    {
        $this->db->where('is_success', 0);
        $this->db->where('deleted_at', NULL);
        $this->db->from('history_table');
        return $this->db->get()->result_array();
    }

    public function add($data)
    {
        $this->db->insert('history_table', $data);
        return $this->db->affected_rows();
    }
}
