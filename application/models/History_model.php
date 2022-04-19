<?php
class History_model extends CI_Model
{
    public function save($data)
    {
        $this->db->insert('request_history', $data);
        return $this->db->affected_rows();
    }

    public function getDataByEmail($email)
    {
        return $this->db->get_where('request_history', ['email' => $email])->result_array();
    }

    public function getEmailByDataName($data_name)
    {
        $this->db->select('email');
        $this->db->from('request_history');
        $this->db->like('data_name', $data_name);
        return $this->db->get()->result_array();
    }
}
