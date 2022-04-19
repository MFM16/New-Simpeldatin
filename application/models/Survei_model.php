<?php
class Survei_model extends CI_Model
{
    public function add($data)
    {
        $this->db->insert('survey', $data);
        return $this->db->affected_rows();
    }

    public function getDataByRequestId($id)
    {
        $data = $this->db->get_where('survey', ['request_id' => $id])->row_array();
        return json_encode($data);
    }

    public function getDataAllByDate($start_date, $end_date)
    {
        $this->db->select('request_table.name, request_table.company, request_table.email, request_table.phone_number, sub_field_table.sub_field_name, survey.*');
        $this->db->where('survey.deleted_at', NULL);
        $this->db->where('survey.created_at BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->from('survey');
        $this->db->join('request_table', 'survey.request_id = request_table.request_id', 'left');
        $this->db->join('sub_field_table', 'survey.sub_field_id = sub_field_table.sub_field_id', 'left');
        return $this->db->get()->result_array();
    }
}
