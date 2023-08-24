<?php

class emp_applicants_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('emp_applicants', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('emp_applicant_id', $id);
        if ($this->db->update('emp_applicants', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('emp_applicant_id', $id);
        $this->db->delete('emp_applicants');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('emp_applicants')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('emp_applicants')->result();
    }

    //Check if there is existing student_id and emp_id in the same row (existing record of student EMP application)
    function past_application($emp_id, $student_id)
    {
        $condition = "`emp_id`= '$emp_id' AND `student_id` = '$student_id'";
        $this->db->select('emp_applicant_id')
            ->from('emp_applicants')
            ->where($condition)
            ->limit(1);
        $result = $this->db->get()->result_array();
        if ($result)
            return true;
        else
            return false;
    }

    function get_user_emp($user_id) //get employer projects that a student applied for (used in level 1 user profile page)
    {
        $this->db->select('*')
            ->from('users')
            ->join('user_student', 'user_student.user_id = users.user_id')
            ->join('emp_applicants', 'emp_applicants.student_id = user_student.student_id')
            ->join('employer_projects', 'employer_projects.emp_id = emp_applicants.emp_id')
            ->join('user_e', 'user_e.e_id = employer_projects.e_id')
            ->join('company', 'company.c_id = user_e.c_id')
            ->where('users.user_id', $user_id);
            return $this->db->get()->result_array();
    }
    
    // Get students who applied for the Employer Project(s) that a specific Employer has posted
    function get_applicants_from_emps($e_id)
    {
        $this->db->select('')
                 ->from('emp_applicants')
                 ->join('employer_projects', 'employer_projects.emp_id = emp_applicants.emp_id')
                 ->join('user_student', 'user_student.student_id = emp_applicants.student_id')
                 ->join('users', 'users.user_id = user_student.user_id')
                 ->where('employer_projects.e_id', $e_id);
        return $this->db->get()->result_array();
    }

    // Get the details of ONE applicant (student)
    function emp_applicant_details($emp_applicant_id)
    {
        $this->db->select('')
                 ->from('emp_applicants')
                 ->join('employer_projects', 'employer_projects.emp_id = emp_applicants.emp_id')
                 ->join('user_e', 'user_e.e_id = employer_projects.e_id')
                 ->join('company', 'company.c_id = user_e.c_id')
                 ->join('user_student', 'user_student.student_id = emp_applicants.student_id')
                 ->join('users', 'users.user_id = user_student.user_id')
                 ->where('emp_applicants.emp_applicant_id', $emp_applicant_id);
        return $this->db->get()->row_array();
    }

    // For Admin: View details of ALL recorded EMP Applicants in the system
    function full_emp_apps_details()
    {
        $this->db->select('')
                 ->from('emp_applicants')
                 ->join('employer_projects', 'employer_projects.emp_id = emp_applicants.emp_id')
                 ->join('user_e', 'user_e.e_id = employer_projects.e_id')
                 ->join('company', 'company.c_id = user_e.c_id')
                 ->join('user_student', 'user_student.student_id = emp_applicants.student_id')
                 ->join('users', 'users.user_id = user_student.user_id');
        return $this->db->get()->result_array();
    }

    // For Employer: Bar graph of EMP Applicants grouped by their nationality
    function applicants_per_nationality($e_id){
        $this->db->select('count(emp_applicants.emp_applicant_id), user_student.student_nationality')
                 ->from('emp_applicants')
                 ->join('employer_projects', 'employer_projects.emp_id = emp_applicants.emp_id')
                 ->join('user_student', 'user_student.student_id = emp_applicants.student_id')
                 ->where('employer_projects.e_id', $e_id)
                 ->group_by('user_student.student_nationality')
                 ->order_by('count(emp_applicants.emp_applicant_id)', 'desc')
                 ->order_by('user_student.student_nationality', 'asc');
        return $this->db->get()->result_array();
    }
}
