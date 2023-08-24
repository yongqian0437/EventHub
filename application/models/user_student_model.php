<?php

class user_student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function index()
    {
        // select from  users table
        return $this->db->get('user_student');
    }

    function insert($data)
    {
        $this->db->insert('user_student', $data);
        if ($this->db->affected_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('student_id', $id);
        if ($this->db->update('user_student', $data)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('student_id', $id);
        $this->db->delete('user_student');
        if ($this->db->affected_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('user_student')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('user_student')->result();
    }

    public function last_user_id()
    {
     $row = $this->db->select("*")->limit(1)->order_by('user_id',"DESC")->get("users")->row();
     return $row->user_id; //it will provide latest or last record id.
    }
 
    public function student_details($id)
    {
     return $this->db->get_where('user_student',['user_id'=>$id])->row_array();
    }

    public function full_students_details()
    {
        $this->db->select('')
        ->from('user_student') // student table
        ->join('users', 'users.user_id = user_student.user_id');// users table
        return $this->db->get();
    }

    public function get_student_detail($user_id)
    {
       $this->db->where('user_id',$user_id);
       return $this->db->get('user_student')->row();
    }  
    
}
?>
