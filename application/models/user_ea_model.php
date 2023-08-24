<?php

class user_ea_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function index()
    {
        // select from  users table
        return $this->db->get('user_ea');
    }

    function insert($data)
    {
        $this->db->insert('user_ea', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('ea_id', $id);
        if ($this->db->update('user_ea', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('ea_id', $id);
        $this->db->delete('user_ea');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('user_ea')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('user_ea')->result();
    }

    public function ea_details($id)
    {
        return $this->db->get_where('user_ea', ['user_id' => $id])->row_array();
    }

    public function approved_ea()
    {
        $this->db->select('*')
            ->from('users')
            ->join('user_ea', 'user_ea.user_id = users.user_id')
            ->where('user_approval', 1);
        return $this->db->get()->result_array();
    }

    public function full_ea_details()
    {
        $this->db->select('')
        ->from('user_ea') // ea table
        ->join('users', 'users.user_id = user_ea.user_id');// users table
        return $this->db->get();
    }

    public function get_ea_detail($user_id)
    {
       $this->db->where('user_id',$user_id);
       return $this->db->get('user_ea')->row();
    }  
}
