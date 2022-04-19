<?php
class User_model extends CI_Model
{
    public function save($data)
    {
        $this->db->insert('users_table', $data);
        return $this->db->affected_rows();
    }

    public function getDataByConfirmationCode($confirmation_code)
    {
        $this->db->where('confirmation_code', $confirmation_code);
        $this->db->where('deleted_at', NULL);
        $this->db->from('users_table');
        return $this->db->get()->row_array();
    }

    public function activation($confirmation_code)
    {
        $this->db->where('confirmation_code', $confirmation_code);
        $this->db->update('users_table', [
            'is_active' => 1
        ]);
        return $this->db->affected_rows();
    }

    public function resetConfirmCode($confirmation_code)
    {
        $this->db->where('confirmation_code', $confirmation_code);
        $this->db->update('users_table', [
            'confirmation_code' => NULL
        ]);
        return $this->db->affected_rows();
    }

    public function getDataByEmail($email)
    {
        $this->db->where('email', $email);
        $this->db->from('users_table');
        return $this->db->get()->row_array();
    }

    public function editDataByEmail($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->update('users_table', $data);
        return $this->db->affected_rows();
    }

    public function updateLastLogin($email)
    {
        $this->db->where('email', $email);
        $this->db->update('users_table', ['last_login' => date('y-m-d')]);
        return $this->db->affected_rows();
    }

    public function getEmailByDate($date)
    {
        $this->db->select('email, name, last_category_requested');
        $this->db->from('users_table');
        $this->db->where('last_login', $date);
        return $this->db->get()->result_array();
    }
}
