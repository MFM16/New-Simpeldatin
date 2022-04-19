<?php
class Job_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get('jobs_table')->result_array();
    }
}
