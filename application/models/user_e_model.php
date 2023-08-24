<?php

class user_e_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function index()
    {
        // select from  users table
        return $this->db->get('user_e');
    }

    function insert($data)
    {
        $this->db->insert('user_e', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('e_id', $id);
        if ($this->db->update('user_e', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('e_id', $id);
        $this->db->delete('user_e');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('user_e')->result();
    }

    function select_condition($condition)
    {
        echo $condition;
        $this->db->where($condition);
        return $this->db->get('user_e')->result();
    }

    public function e_details($id)
    {
        return $this->db->get_where('user_e', ['user_id' => $id])->row_array();
    }

    public function e_profile_details($id)
    {
        $this->db->select('*')
            ->from('user_e')
            ->join('users', 'users.user_id = user_e.user_id')
            ->join('company', 'company.c_id = user_e.c_id')
            ->where('user_e.user_id', $id);
        return $this->db->get()->row_array();
    }

    public function approved_employers()
    {
        $this->db->select('*')
            ->from('users')
            ->join('user_e', 'user_e.user_id = users.user_id')
            ->where('user_approval', 1);
        return $this->db->get()->result_array();
    }
    public function full_e_details()
    {
        $this->db->select('')
        ->from('user_e') // ea table
        ->join('users', 'users.user_id = user_e.user_id');// users table
        return $this->db->get();
    }

    public function get_e_detail($user_id)
    {
       $this->db->where('user_id',$user_id);
       return $this->db->get('user_e')->row();
    } 
}
