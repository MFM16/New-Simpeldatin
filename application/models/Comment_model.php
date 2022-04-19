<?php
class Comment_model extends CI_Model
{
    public function getComments()
    {
        return $this->db->get_where('comment_table', ['deleted_at' => NULL])->result_array();
    }
}
