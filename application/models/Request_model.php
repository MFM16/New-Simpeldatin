<?php
class Request_model extends CI_Model
{
    public function getDataGeneral()
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name, process_table.process_name');
        $this->db->where('request_table.is_special', 0);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        $this->db->join('process_table', 'request_table.process_state = process_table.process_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataGeneralByField($field_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name, process_table.process_name');
        $this->db->where('request_table.is_special', 0);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.field_id', $field_id);
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        $this->db->join('process_table', 'request_table.process_state = process_table.process_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataGeneralBySubField($sub_field_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name, process_table.process_name');
        $this->db->where('request_table.is_special', 0);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->where('request_table.sub_field_id', $sub_field_id);
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        $this->db->join('process_table', 'request_table.process_state = process_table.process_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataGeneralByOfficer($officer_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name, process_table.process_name');
        $this->db->where('request_table.is_special', 0);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->where('request_table.officer_id', $officer_id);
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        $this->db->join('process_table', 'request_table.process_state = process_table.process_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataSpecial()
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', 1);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }
    public function getDataSpecialByField($field_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', 1);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.field_id', $field_id);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }
    public function getDataSpecialBySubField($sub_field_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', 1);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.sub_field_id', $sub_field_id);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }
    public function getDataSpecialByOfficer($officer_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', 1);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.officer_id', $officer_id);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataReadyToSent()
    {
        $this->db->select('request_table.*, fields_table.field_name, utilities_table.utility_name');
        $this->db->where('request_table.process_state', 4);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->order_by('request_table.request_id', 'DESC');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }

    public function save($data)
    {
        $this->db->insert('request_table', $data);
        return $this->db->affected_rows();
    }

    public function update($request_id, $data)
    {
        $this->db->where('request_id', $request_id);
        $this->db->update('request_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataById($request_id)
    {
        $data = $this->db->get_where('request_table', ['request_id' => $request_id])->row_array();
        return json_encode($data);
    }

    public function getDataByRequest_id($request_id)
    {
        return $this->db->get_where('request_table', ['request_id' => $request_id])->row_array();
    }

    public function getDataByRequestId($request_id)
    {
        $this->db->select('request_table.*, utilities_table.utility_name, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name');
        $this->db->where('request_table.request_id', $request_id);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->row_array();
    }

    public function getDataByRequestIdJson($request_id)
    {
        $this->db->select('request_table.*, utilities_table.utility_name');
        $this->db->where('request_table.request_id', $request_id);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->from('request_table');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        $data =  $this->db->get()->row_array();
        return json_encode($data);
    }

    public function getDataByProcessState($request_id, $process_state)
    {
        $this->db->where('request_id', $request_id);
        $this->db->where('process_state', $process_state);
        $this->db->where('deleted_at', NULL);
        $this->db->from('request_table');
        $this->db->get()->row_array();
    }

    public function countAllData()
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countSentData()
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('process_state', 5);
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function getDataByReceipt($receipt_number)
    {
        return $this->db->get_where('request_table', ['receipt_number' => $receipt_number])->row_array();
    }

    public function getEmailById($request_id)
    {
        return $this->db->get_where('request_table', ['request_id' => $request_id])->row_array();
    }

    public function getDataByReceiptNumber($receipt_number)
    {
        $data = $this->db->get_where('request_table', ['receipt_number' => $receipt_number])->row_array();
        return json_encode($data);
    }

    public function dataSurvei()
    {
        $this->db->where('survey_status', 1);
        $this->db->where('deleted_at', NULL);
        $this->db->from('request_table');
        return $this->db->get()->result_array();
    }

    public function getDataAllByDate($start_date, $end_date, $special)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', $special);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.request_date BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataFieldByDate($start_date, $end_date, $special, $field_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', $special);
        $this->db->where('request_table.field_id', $field_id);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.request_date BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataSubFieldByDate($start_date, $end_date, $special, $sub_field_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', $special);
        $this->db->where('request_table.sub_field_id', $sub_field_id);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.request_date BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getDataOfficerByDate($start_date, $end_date, $special, $officer_id)
    {
        $this->db->select('request_table.*, fields_table.field_name, sub_field_table.sub_field_name, officers_table.officer_name, utilities_table.utility_name');
        $this->db->where('request_table.is_special', $special);
        $this->db->where('request_table.officer_id', $officer_id);
        $this->db->where('request_table.deleted_at', NULL);
        $this->db->where('request_table.request_date BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->from('request_table');
        $this->db->join('fields_table', 'request_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'request_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        $this->db->join('officers_table', 'request_table.officer_id = officers_table.officer_id', 'left');
        $this->db->join('utilities_table', 'request_table.used_for_id = utilities_table.utility_id', 'left');
        return $this->db->get()->result_array();
    }

    public function countAllDataByField($field_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('field_id', $field_id);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataByFieldSent($field_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('field_id', $field_id);
        $this->db->where('process_state', 5);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataByFieldReject($field_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('field_id', $field_id);
        $this->db->where('process_state', -1);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataBySubField($sub_field_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('sub_field_id', $sub_field_id);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataBySubFieldSent($sub_field_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('sub_field_id', $sub_field_id);
        $this->db->where('process_state', 5);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataBySubFieldReject($sub_field_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('sub_field_id', $sub_field_id);
        $this->db->where('process_state', -1);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataByOfficer($officer_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('officer_id', $officer_id);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataByOfficerSent($officer_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('officer_id', $officer_id);
        $this->db->where('process_state', 5);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countAllDataByOfficerReject($officer_id)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('officer_id', $officer_id);
        $this->db->where('process_state', -1);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countDataByFieldPerMonth($field_id, $month)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('field_id', $field_id);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->where('MONTH(request_date)', $month);
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function countDataByFieldPerMonthSent($field_id, $month)
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('process_state', 5);
        $this->db->where('field_id', $field_id);
        $this->db->where('YEAR(request_date)', date('Y'));
        $this->db->where('MONTH(request_date)', $month);
        $this->db->from('request_table');
        return $this->db->count_all_results();
    }

    public function getAllData()
    {
        return $this->db->get_where('request_table', ['deleted_at' => NULL])->result_array();
    }
}
