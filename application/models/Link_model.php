<?php
class Link_model extends CI_Model
{
    public function add($data)
    {
        $this->db->insert('links_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataByReceiptNumber($receipt)
    {
        return $this->db->get_where('links_table', ['receipt_number' => $receipt])->row_array();
    }
}
