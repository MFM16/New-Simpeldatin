<?php
class LBS_model extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('lbs_histories', $data);
        return $this->db->affected_rows();
    }

    public function getDataByDate($email, $district)
    {
        $this->db->where('email', $email);
        $this->db->where('district', $district);
        $this->db->where('created_at', date('Y-m-d'));
        $this->db->where('deleted_at', NULL);
        $this->db->from('lbs_histories');
        return $this->db->get()->result_array();
    }
}
