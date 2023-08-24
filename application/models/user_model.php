<?php

class user_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function index()
    {
        // select from  users table
        return $this->db->get('users');
    }

    function insert($data)
    {
        $this->db->insert('users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function deletedata($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('user_id', $id);
        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function activated_acc($condition)
    {
        $this->db->where('user_approval', $condition);
        return $this->db->get('users')->result_array();
    }

    public function inactivate_acc($condition)
    {
        $this->db->where('user_approval', $condition);
        return $this->db->get('users')->result_array();
    }

    public function getuserid()
    {
        return $this->db->get('users')->result_array();
    }

    public function search_email()
    {
        return $this->db->get_where('users', ['user_email' => $this->session->userdata('user_email')])->row_array();
    }

    public function all_users_details()
    {
        $this->db->where('user_role !=', 'Admin');
        return $this->db->get('users')->result();
    }

    function student_submitdate() // join 'users' table + 'user_e' table to get info from both tables
    {
        $this->db->select('')
            ->from('users')
            ->join('user_student', 'user_student.user_id = users.user_id');
        return $this->db->get()->result();
    }

    function full_active_users_details()
    {
        $this->db->where('user_approval', 1)
                 ->where('user_role !=', 'Admin');
        return $this->db->get('users')->result();
    }

    public function valid_email($user_email)
    {
        return $this->db->get_where('users', ['user_email' => $user_email])->row_array();
    }

    public function reg_id()
    {
        return $this->db->get('users')->row;
    }

    public function checkemail($user_email)
    {
        return $this->db->get_where('users', ['user_email' => $user_email, 'user_approval' => 1])->row_array();
    }

    public function updatepassword($tokan, $user_email)
    {
        return $this->db->query("update users set user_password='" . $tokan . "'where user_email='" . $user_email . "'");
    }

    public function changepassword($data)
    {
        $this->db->query("update users set user_password='" . $data['user_password'] . "'where user_password='" . $_SESSION['tokan'] . "'");
    }

    function employers_list() // join 'users' table + 'user_e' table to get info from both tables
    {
        $this->db->select('users.user_id, user_fname, user_lname, c_name, c_logo, c_country, e_jobtitle')
                 ->from('users')
                 ->join('user_e', 'user_e.user_id = users.user_id')
                 ->join('company', 'company.c_id = user_e.c_id')
                 ->where('users.user_role', 'Employer')
                 ->where('users.user_approval', '1');
        return $this->db->get()->result_array();
    }

    function students_list()
    {
        $this->db->select('users.user_id, user_email, user_fname, user_lname, student_nationality, student_interest, student_currentlevel')
                 ->from('users')
                 ->join('user_student', 'user_student.user_id = users.user_id')
                 ->where('users.user_role', 'Student');
        return $this->db->get()->result_array();
    }

    function counsellors_list() // join users table + user_ac table to get info from both tables
    {
        $this->db->select('users.user_id, user_email, user_fname, user_lname, ac_university, uni_logo, uni_country') // uni_logo
                 ->from('users')
                 ->join('user_ac', 'user_ac.user_id = users.user_id')
                 ->join('universities', 'universities.uni_name = user_ac.ac_university')
                 ->where('user_role', 'Academic Counsellor')
                 ->where('users.user_approval', '1');
        return $this->db->get()->result_array();
    }

    function get_user_data()
    {
        $this->db->select('user_id, user_email, user_fname, user_lname, user_role, user_password')
            ->where('user_id', $this->session->userdata['user_id']);
        $this->db->limit(1);
        return $this->db->get('users')->row_array(); // row() || result () won't work.. why? array of objects. row_array returns a single result row. an object!! check with var_dump
    }

    function get_name($id)
    {
        $this->db->select('user_id,user_fname')
                 ->from('users')
                 ->where("user_id", $id)
                 ->limit(1);
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['user_fname'];
    }

    public function get_monthly_user($date1, $date2, $table, $attribute)
    {
        $this->db->select('*');
        $this->db->join('users', 'users.user_id = ' . $table . '.user_id');
        $this->db->where('users.user_approval', 1);
        $this->db->where($table . "." . $attribute . " BETWEEN '" . $date1 . " 00:00:00' AND '" . $date2 . " 23:59:59' ");
        return $this->db->count_all_results($table);
    }

    public function inactivate_user($row)
    {
        return $this->db->query("update users set user_approval= 0 where user_id=$row LIMIT 1");
    }

    public function activate_user($row)
    {
        return $this->db->query("update users set user_approval= 1 where user_id=$row LIMIT 1");
    }
    
    function full_inactive_users_details()
    {
        return $this->db->get_where('users', ['user_approval'=>0])->result();
    }

    public function get_user_id($user_id)
    {
       $this->db->where('user_id',$user_id);
       return $this->db->get('users')->row();
    }  

    public function search_id($id)
    {
        $this->db->where('user_id',$id);
        return $this->db->get('users')->row();
    }

    public function get_user_details($user_id)
    {
       $this->db->where('user_id',$user_id);
       return $this->db->get('users')->row_array();
    } 
}
