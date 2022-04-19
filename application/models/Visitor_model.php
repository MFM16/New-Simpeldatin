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
}
