<?php
class Utility_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get('utilities_table')->result_array();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('utilities_table', ['utility_id' => $id])->row_array();
    }
}
