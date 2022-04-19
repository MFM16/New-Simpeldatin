<?php
class Rating_model extends CI_Model
{
    public function getData()
    {
        $this->db->select('rating_table.*, users_table.name, users_table.photo');
        $this->db->where('rating_table.deleted_at', NULL);
        $this->db->from('rating_table');
        $this->db->join('users_table', 'rating_table.user_id = users_table.user_id', 'left');
        $this->db->order_by('rating_id', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }

    public function getRating()
    {
        return $this->db->query("SELECT sum(rating) AS total_rating from rating_table");
    }

    public function count()
    {
        $this->db->where('deleted_at', NULL);
        $this->db->from('rating_table');
        return $this->db->count_all_results();
    }

    public function insert($data)
    {
        $this->db->insert('rating_table', $data);
        return $this->db->affected_rows();
    }
}
