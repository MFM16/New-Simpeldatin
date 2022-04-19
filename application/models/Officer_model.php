<?php
class Officer_model extends CI_Model
{
    public function getDataByEmail($email)
    {
        $this->db->where('email', $email);
        $this->db->from('officers_table');
        return $this->db->get()->row_array();
    }

    public function getNameById($officer_id)
    {
        $this->db->select('officer_name');
        $this->db->where('officer_id', $officer_id);
        $this->db->from('officers_table');
        return $this->db->get()->row_array();
    }

    public function getAllData()
    {
        $this->db->select('officers_table.*, roles_table.role_name, subs_roles_table.sub_role_name, fields_table.field_name, sub_field_table.sub_field_name');
        $this->db->where('officers_table.deleted_at', NULL);
        $this->db->from('officers_table');
        $this->db->join('roles_table', 'officers_table.role_id = roles_table.role_id', 'left');
        $this->db->join('subs_roles_table', 'officers_table.sub_role_id = subs_roles_table.sub_role_id', 'left');
        $this->db->join('fields_table', 'officers_table.field_id = fields_table.field_id', 'left');
        $this->db->join('sub_field_table', 'officers_table.sub_field_id = sub_field_table.sub_field_id', 'left');
        return $this->db->get()->result_array();
    }

    public function add($data)
    {
        $this->db->insert('officers_table', $data);
        return $this->db->affected_rows();
    }

    public function getEmailByField($field_id)
    {
        $this->db->select('email');
        $this->db->from('officers_table');
        $this->db->where('field_id', $field_id);
        $this->db->where('deleted_at', NULL);
        return $this->db->get()->result_array();
    }

    public function getEmailByFieldEs3($field_id)
    {
        $this->db->select('email');
        $this->db->from('officers_table');
        $this->db->where('field_id', $field_id);
        $this->db->where('sub_role_id', 2);
        $this->db->where('deleted_at', NULL);
        return $this->db->get()->result_array();
    }

    public function getEmailBySubField($sub_field_id)
    {
        $this->db->select('email');
        $this->db->from('officers_table');
        $this->db->where('sub_field_id', $sub_field_id);
        $this->db->where('deleted_at', NULL);
        return $this->db->get()->result_array();
    }

    public function getEmailById($officer_id)
    {
        $this->db->select('email');
        $this->db->from('officers_table');
        $this->db->where('officer_id', $officer_id);
        $this->db->where('deleted_at', NULL);
        return $this->db->get()->result_array();
    }

    public function getEmailAdmin()
    {
        $this->db->select('email');
        $this->db->from('officers_table');
        $this->db->where('deleted_at', NULL);
        $this->db->where('role_id', 1);
        return $this->db->get()->result_array();
    }

    public function editData($id, $data)
    {
        $this->db->where('officer_id', $id);
        $this->db->update('officers_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataById($officer_id)
    {
        $data = $this->db->get_where('officers_table', ['officer_id' => $officer_id])->row_array();
        return json_encode($data);
    }

    public function editDataByEmail($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->update('officers_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataByFieldId($field_id)
    {
        $this->db->where('sub_role_id', 3);
        $this->db->where('deleted_at', NULL);
        $this->db->where('field_id', $field_id);
        $this->db->from('officers_table');
        $data = $this->db->get()->result_array();
        return json_encode($data);
    }

    public function getDataAdmin()
    {
        $this->db->where('role_id', 1);
        $this->db->where('deleted_at', NULL);
        $this->db->from('officers_table');
        return $this->db->get()->result_array();
    }
}
