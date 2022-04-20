<?php
class Data_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->order_by('data_id', 'DESC');
        return $this->db->get_where('list_data_table', ['deleted_at' => NULL])->result_array();
    }

    public function getAllDataJson()
    {
        $this->db->order_by('data_id', 'DESC');
        $data =  $this->db->get_where('list_data_table', ['deleted_at' => NULL])->result_array();
        return json_encode($data);
    }

    public function getDataByDate($date)
    {
        $this->db->select('specific_commodity');
        $this->db->from('list_data_table');
        $this->db->where('created_at', $date);
        $this->db->where('deleted_at', NULL);
        return $this->db->get()->result_array();
    }

    public function getAllDataByDate($date)
    {
        $this->db->where('created_at', $date);
        $this->db->where('deleted_at', NULL);
        $this->db->from('list_data_table');
        return $this->db->get()->result_array();
    }

    public function getDataByCategoryId($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->where('deleted_at', NULL);
        $this->db->from('list_data_table');
        $data = $this->db->get()->result_array();
        return json_encode($data);
    }

    public function add($data)
    {
        $this->db->insert('list_data_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataById($data_id)
    {
        $data = $this->db->get_where('list_data_table', ['data_id' => $data_id])->row_array();
        return json_encode($data);
    }

    public function update($id, $data)
    {
        $this->db->where('data_id', $id);
        $this->db->update('list_data_table', $data);
        return $this->db->affected_rows();
    }

    public function getNewData()
    {
        $this->db->order_by('data_id', 'ASV');
        return $this->db->get('list_data_table', 5, 1)->result_array();
    }
}
