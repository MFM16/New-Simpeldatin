<?php
class Sub_role_model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('subs_roles_table')->result_array();
    }
}
