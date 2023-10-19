<?php

class event_applicants_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        return $this->db->get('event_applicants');
    }

    function insert($data)
    {
        $this->db->insert('event_applicants', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('e_applicant_id', $id);
        if ($this->db->update('event_applicants', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('e_applicant_id', $id);
        $this->db->delete('event_applicants');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('event_applicants')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('event_applicants')->result();
    }

    function find_data_with_id($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get('user_student')->row();
    }

    function get_student_events($user_id)
    {
        $this->db->select('*')
            ->from('users')
            ->join('event_applicants', 'event_applicants.e_applicant_method = users.user_id')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->join('universities', 'universities.organizer_id = events.organizer_id')
            ->where('users.user_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function valid_ea($e_applicant_method)
    {
        return $this->db->get_where('event_applicants', ['e_applicant_method' => $e_applicant_method])->row_array();
    }

    public function get_user_id($user_id)
    {
        $this->db->where('e_applicant_method', $user_id);
        return $this->db->get('event_applicants')->result();
    }

    public function get_cas_id($e_applicant_id)
    {
        $this->db->where('e_applicant_id', $e_applicant_id);
        return $this->db->get('event_applicants')->row(); // return one result in object format
    }

    public function get_cas_with_id($e_applicant_id)
    {
        $this->db->select('*')
            ->from('event_applicants')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->join('universities', 'universities.organizer_id = events.organizer_id')
            ->where('event_applicants.e_applicant_id', $e_applicant_id);
        return $this->db->get()->row_array();
    }

    public function ca_details($ca_id)
    {
        return $this->db->get_where('event_applicants', ['e_applicant_id' => $ca_id])->row_array(); // return one result in array format
    }

    public function full_event_app_details()
    {
        $this->db->select('')
            ->from('event_applicants') // event applicants table
            ->join('events', 'events.event_id = event_applicants.event_id') // events table
            ->join('users', 'users.user_id = event_applicants.e_applicant_method') // users table
            ->join('universities', 'universities.organizer_id = events.organizer_id'); // uni table
        return $this->db->get()->result(); // return array of object format 
    }

    public function get_total_students($user_id)
    {
        $this->db->where('e_applicant_method', $user_id);
        return $this->db->get('event_applicants')->result_array();
    }

    // For EA: Bar graph of event applicants grouped by their nationality
    public function applicants_per_nationality($user_id)
    {
        $this->db->select('count(event_applicants.e_applicant_id), event_applicants.e_applicant_nationality')
            ->from('event_applicants')
            ->where('event_applicants.e_applicant_method', $user_id)
            ->group_by('event_applicants.e_applicant_nationality')
            ->order_by('count(event_applicants.e_applicant_id)', 'desc')
            ->order_by('event_applicants.e_applicant_nationality', 'asc');
        return $this->db->get()->result_array();
    }

    function get_organizer_name()
    {
        $this->db->select('')
            ->from('event_applicants') // event applicants table
            ->join('events', 'events.event_id = event_applicants.event_id') // events table
            ->join('universities', 'universities.organizer_id = events.event_id'); // users table
        return $this->db->get()->result(); // return array of array format
    }

    public function applicants_per_uni()
    {
        $this->db->select('count(event_applicants.e_applicant_id), universities.organizer_name')
            ->from('event_applicants')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->join('universities', 'universities.organizer_id = events.organizer_id')
            ->group_by('universities.organizer_id')
            ->order_by('count(event_applicants.e_applicant_id)', 'DESC');
        return $this->db->get()->result_array();
    }

    function enrollment_method($method)
    {
        $this->db->select('')
            ->from('event_applicants')
            ->join('users', 'users.user_id = event_applicants.e_applicant_method') //change to user id
            ->where('users.user_role', $method);
        return $this->db->get()->result_array();
    }
    function past_application($event_id, $user_email)
    {
        $condition = "`event_id`= '$event_id' AND `e_applicant_email`= '$user_email' ";
        $this->db->select('e_applicant_id')
            ->from('event_applicants')
            ->where($condition)
            ->limit(1);
        $result = $this->db->get()->result_array();
        // $condition = $this->db->get()->result_array();
        if ($result)
            return true;
        else
            return false;
    }

    // Get students who applied for the event(s)
    function get_applicants_from_event($ac_organizer_id)
    {
        $this->db->select('')
            ->from('event_applicants')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->join('users', 'users.user_id = event_applicants.e_applicant_method') //change to user id
            ->join('universities', 'universities.organizer_id = events.organizer_id')
            ->where('universities.organizer_id', $ac_organizer_id);

        return $this->db->get()->result_array();
    }

    // Get the details of ONE applicant (student)
    function event_applicant_details($e_applicant_id)
    {
        $this->db->select('')
            ->from('event_applicants')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->where('event_applicants.e_applicant_id', $e_applicant_id);
        return $this->db->get()->row_array();
    }

    function get_applicants_from_method($ac_organizer_id, $method)
    {
        $this->db->select('')
            ->from('event_applicants')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->join('users', 'users.user_id = event_applicants.e_applicant_method') //change to user id
            ->join('universities', 'universities.organizer_id = events.organizer_id')
            ->where('universities.organizer_id', $ac_organizer_id)
            ->where('users.user_role', $method);

        return $this->db->get()->result_array();
    }

    // Function for bar graph 
    function event_applicants_per_nationality($organizer_id)
    {
        $this->db->select('count(event_applicants.e_applicant_id), event_applicants.e_applicant_nationality')
            ->from('event_applicants')
            //  ->join('users', 'users.user_id = event_applicants.e_applicant_method')
            ->join('events', 'events.event_id = event_applicants.event_id')
            ->join('universities', 'universities.organizer_id = events.organizer_id')
            ->where('universities.organizer_id', $organizer_id)
            ->group_by('event_applicants.e_applicant_nationality')
            ->order_by('count(event_applicants.e_applicant_id)', 'desc')
            ->order_by('event_applicants.e_applicant_nationality', 'asc');
        return $this->db->get()->result_array();
    }
}
