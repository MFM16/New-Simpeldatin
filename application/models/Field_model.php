<?php
class Field_model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('fields_table')->result_array();
    }

    public function getDataById($field_id)
    {
        $this->db->select('field_name');
        $this->db->where('field_id', $field_id);
        $this->db->from('fields_table');
        return $this->db->get()->row_array();
    }
}
