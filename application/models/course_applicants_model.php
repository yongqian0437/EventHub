<?php

class course_applicants_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        return $this->db->get('course_applicants');
    }

    function insert($data)
    {
        $this->db->insert('course_applicants', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('c_applicant_id', $id);
        if ($this->db->update('course_applicants', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('c_applicant_id', $id);
        $this->db->delete('course_applicants');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('course_applicants')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('course_applicants')->result();
    }

    function find_data_with_id($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get('user_student')->row();
    }

    function get_student_courses($user_id)
    {
        $this->db->select('*')
            ->from('users')
            ->join('course_applicants', 'course_applicants.c_applicant_method = users.user_id')
            ->join('courses', 'courses.course_id = course_applicants.course_id')
            ->join('universities', 'universities.uni_id = courses.uni_id')
            ->where('users.user_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function valid_ea($c_applicant_method)
    {
        return $this->db->get_where('course_applicants', ['c_applicant_method'=>$c_applicant_method])->row_array();
    }

    public function get_user_id($user_id)
    {
       $this->db->where('c_applicant_method',$user_id);
       return $this->db->get('course_applicants')->result();
    }

    public function get_cas_id($c_applicant_id)
    {
       $this->db->where('c_applicant_id',$c_applicant_id);
       return $this->db->get('course_applicants')->row();// return one result in object format
    }

    public function get_cas_with_id($c_applicant_id)
    {
        $this->db->select('*')
                ->from('course_applicants')
                ->join('courses', 'courses.course_id = course_applicants.course_id')
                ->join('universities', 'universities.uni_id = courses.uni_id')
                ->where('course_applicants.c_applicant_id', $c_applicant_id);
       return $this->db->get()->row_array();
    }

    public function ca_details($ca_id)
    {
     return $this->db->get_where('course_applicants',['c_applicant_id'=>$ca_id])->row_array();// return one result in array format
    }

    public function full_course_app_details()
    {
        $this->db->select('')
        ->from('course_applicants') // course applicants table
        ->join('courses', 'courses.course_id = course_applicants.course_id') // courses table
        ->join('users', 'users.user_id = course_applicants.c_applicant_method') // users table
        ->join('universities', 'universities.uni_id = courses.uni_id'); // uni table
        return $this->db->get()->result();// return array of object format 
    }

    public function get_total_students($user_id)
    {
       $this->db->where('c_applicant_method',$user_id);
       return $this->db->get('course_applicants')->result_array();
    }

    // For EA: Bar graph of course applicants grouped by their nationality
    public function applicants_per_nationality($user_id)
    {
        $this->db->select('count(course_applicants.c_applicant_id), course_applicants.c_applicant_nationality')
        ->from('course_applicants')
        ->where('course_applicants.c_applicant_method', $user_id)
        ->group_by('course_applicants.c_applicant_nationality')
        ->order_by('count(course_applicants.c_applicant_id)', 'desc')
        ->order_by('course_applicants.c_applicant_nationality', 'asc');
        return $this->db->get()->result_array();
    }

     function get_uni_name()
    {
        $this->db->select('')
            ->from('course_applicants') // course applicants table
            ->join('courses', 'courses.course_id = course_applicants.course_id') // courses table
            ->join('universities', 'universities.uni_id = courses.course_id'); // users table
        return $this->db->get()->result();// return array of array format
    }

    public function applicants_per_uni()
    {
        $this->db->select('count(course_applicants.c_applicant_id), universities.uni_name')
            ->from('course_applicants')
            ->join('courses', 'courses.course_id = course_applicants.course_id')
            ->join('universities', 'universities.uni_id = courses.uni_id')
            ->group_by('universities.uni_id')
            ->order_by('count(course_applicants.c_applicant_id)', 'DESC');
        return $this->db->get()->result_array();
    }

    function enrollment_method($method)
    {
        $this->db->select('')
            ->from('course_applicants')
            ->join('users', 'users.user_id = course_applicants.c_applicant_method') //change to user id
            ->where('users.user_role', $method);
        return $this->db->get()->result_array();
    }
    function past_application($course_id, $user_email)
    {
        $condition = "`course_id`= '$course_id' AND `c_applicant_email`= '$user_email' ";
        $this->db->select('c_applicant_id')
                 ->from('course_applicants')
                 ->where($condition)
                 ->limit(1);
        $result = $this->db->get()->result_array();
        // $condition = $this->db->get()->result_array();
        if ($result)
            return true;
        else
            return false;
    }

        // Get students who applied for the Course(s)
        function get_applicants_from_course($ac_uni_id)
        {
            $this->db->select('')
                     ->from('course_applicants')
                     ->join('courses', 'courses.course_id = course_applicants.course_id')
                     ->join('users', 'users.user_id = course_applicants.c_applicant_method') //change to user id
                     ->join('universities', 'universities.uni_id = courses.uni_id')
                     ->where('universities.uni_id', $ac_uni_id);

            return $this->db->get()->result_array();
        }
    
        // Get the details of ONE applicant (student)
        function course_applicant_details($c_applicant_id)
        {
            $this->db->select('')
                     ->from('course_applicants')
                     ->join('courses', 'courses.course_id = course_applicants.course_id')
                     ->where('course_applicants.c_applicant_id', $c_applicant_id);
            return $this->db->get()->row_array();
        }

        function get_applicants_from_method($ac_uni_id, $method)
        {
            $this->db->select('')
                     ->from('course_applicants')
                     ->join('courses', 'courses.course_id = course_applicants.course_id')
                     ->join('users', 'users.user_id = course_applicants.c_applicant_method') //change to user id
                     ->join('universities', 'universities.uni_id = courses.uni_id')
                     ->where('universities.uni_id', $ac_uni_id)
                     ->where('users.user_role', $method );

            return $this->db->get()->result_array();
        }

// Function for bar graph 
        function course_applicants_per_nationality($uni_id){
            $this->db->select('count(course_applicants.c_applicant_id), course_applicants.c_applicant_nationality')
                     ->from('course_applicants')
                    //  ->join('users', 'users.user_id = course_applicants.c_applicant_method')
                     ->join('courses', 'courses.course_id = course_applicants.course_id')
                     ->join('universities', 'universities.uni_id = courses.uni_id')
                     ->where('universities.uni_id', $uni_id)
                     ->group_by('course_applicants.c_applicant_nationality')
                     ->order_by('count(course_applicants.c_applicant_id)', 'desc')
                     ->order_by('course_applicants.c_applicant_nationality' , 'asc');
            return $this->db->get()->result_array();
        }
}
