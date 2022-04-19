<?php
class Profile_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get('profile_table')->row_array();
    }
}
