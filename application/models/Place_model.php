<?php
class Place_model extends CI_Model
{
    public function getDataByCity($city)
    {
        return $this->db->get_where('lbs_table', ['city' => $city])->row_array();
    }
}
