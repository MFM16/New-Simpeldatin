<?php
class FIle_model extends CI_Model
{
    public function download($nama_file)
    {
        return $this->db->get_where('files_table', ['file_name' => $nama_file])->row_array();
    }

    public function getDataByRequestId($request_id)
    {
        $this->db->where('request_id', $request_id);
        $this->db->where('deleted_at', NULL);
        $this->db->from('files_table');
        return $this->db->get()->result_array();
    }

    public function getDataByRequestIdJson($request_id)
    {
        $data = $this->db->get_where('files_table', ['request_id' => $request_id])->result_array();
        return json_encode($data);
    }

    public function add($data)
    {
        $this->db->insert('files_table', $data);
        return $this->db->affected_rows();
    }
}
