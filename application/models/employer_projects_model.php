<?php

class employer_projects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('employer_projects', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('emp_id', $id);
        if ($this->db->update('employer_projects', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('emp_id', $id);
        $this->db->delete('employer_projects');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('employer_projects')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('employer_projects')->result();
    }

    function approved_eps()
    {
        $this->db->select('')
            ->from('employer_projects')
            ->join('user_e', 'user_e.e_id = employer_projects.e_id')
            ->join('company', 'company.c_id = user_e.c_id')
            ->where('emp_approval', '1');
        return $this->db->get()->result_array();
    }

    function emp_by_approval($condition)
    {
        $this->db->where('emp_approval', $condition);
        return $this->db->get('employer_projects')->result();
    }
    function get_emps_from_employer($e_id)
    {
        $this->db->where('e_id', $e_id);
        return $this->db->get('employer_projects')->result();
    }
    

    //  View details of 1 EMP being posted 
    function emp_details($emp_id)
    {
        $this->db->select('')
        ->from('employer_projects')
        ->join('user_e', 'user_e.e_id = employer_projects.e_id')
        ->join('company', 'company.c_id = user_e.c_id')
        ->join('users', 'users.user_id = user_e.user_id')
        ->where('emp_id', $emp_id);
        return $this->db->get()->result();
    }

    // For Admin: View details of ALL the EMPs posted
    function full_emps_details()
    {
        $this->db->select('')
        ->from('employer_projects')
        ->join('user_e', 'user_e.e_id = employer_projects.e_id')
        ->join('company', 'company.c_id = user_e.c_id')
        ->join('users', 'users.user_id = user_e.user_id');
        return $this->db->get()->result();
    }

    // For Admin: View details of ALL Pending EMPs
    function full_pending_emps_details()
    {
        $this->db->select('')
        ->from('employer_projects')
        ->join('user_e', 'user_e.e_id = employer_projects.e_id')
        ->join('company', 'company.c_id = user_e.c_id')
        ->join('users', 'users.user_id = user_e.user_id')
        ->where('emp_approval', '0');
        return $this->db->get()->result();
    }

}
