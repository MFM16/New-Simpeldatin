<?php
class Category_model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get_where('categories_table', ['deleted_at' => NULL])->result_array();
    }
}
