<?php
class Sub_field_model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('sub_field_table')->result_array();
    }

    public function getDataById($sub_field_id)
    {
        $this->db->select('sub_field_name');
        $this->db->where('sub_field_id', $sub_field_id);
        $this->db->from('sub_field_table');
        return $this->db->get()->row_array();
    }

    public function getDataByFieldId($field_id)
    {
        $sub_field = $this->db->get_where('sub_field_table', ['field_id' => $field_id])->result_array();
        return json_encode($sub_field);
    }
}
