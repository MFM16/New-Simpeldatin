<?php
class Visitor_model extends CI_Model
{
    public function add($data)
    {
        $this->db->insert('visitors_table', $data);
        return $this->db->affected_rows();
    }

    public function getAllData()
    {
        return $this->db->get_where('visitors_table', ['deleted_at' => NULL])->result_array();
    }

    public function getDataByDate($ip, $date)
    {
        $this->db->where('ip_address', $ip);
        $this->db->where('created_at', $date);
        $this->db->where('deleted_at', NULL);
        $this->db->from('visitors_table');
        return $this->db->get()->result_array();
    }
}
