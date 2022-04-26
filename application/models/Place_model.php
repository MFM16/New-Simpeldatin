<?php

class Place_model extends CI_Model
{
    public function getDataByDistrict($district)
    {
        $this->db->like('district', $district, 'both');
        $this->db->from('lbs_table');
        return $this->db->get()->result_array();
    }

    public function getData()
    {
        return $this->db->get_where('lbs_table', ['deleted_at' => NULL])->result_array();
    }

    public function insert($data)
    {
        $this->db->insert('lbs_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataById($id)
    {
        $this->db->where('place_id', $id);
        $this->db->where('deleted_at', NULL);
        $this->db->from('lbs_table');
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function update($id, $data)
    {
        $this->db->where('place_id', $id);
        $this->db->update('lbs_table', $data);
        return $this->db->affected_rows();
    }
}
