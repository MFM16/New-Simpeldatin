<?php
class Role_model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get_where('roles_table', ['role_id =' => 1])->result_array();
    }
}
