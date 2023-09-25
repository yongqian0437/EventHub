<?php

class courses_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('courses', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('course_id', $id);
        if ($this->db->update('courses', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('course_id', $id);
        $this->db->delete('courses');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('courses')->result();
    }

    function select_all_approved()
    {
        $this->db->select('*')
            ->from('courses')
            ->join('universities', 'universities.uni_id = courses.uni_id')
            ->where('universities.uni_approval', 1);
        return $this->db->get()->result();
    }

    function select_condition($id)
    {
        $this->db->where('course_id', $id);
        return $this->db->get('courses')->result();
    }

    public function valid_course_name($course_name)
    {
        return $this->db->get_where('courses', ['course_name' => $course_name])->row_array();
    }

    // public function last_course_id()
    // {
    //  $row = $this->db->select("*")->limit(1)->order_by('course_id',"DESC")->get("courses")->row();
    //  return $row->course_id; //it will provide latest or last record id.
    // }
    function get_course_with_id($id)  //new function
    {
        $this->db->where('course_id', $id);
        return $this->db->get('courses')->result();
    }

    function fetch_courses($uni_id, $course_level)  //new function
    {
        $this->db->where('uni_id', $uni_id);
        $this->db->where('course_level', $course_level);
        $this->db->order_by('course_name', 'ASC');
        $query = $this->db->get('courses');

        if ($query->num_rows() > 0) {
            $output = '<option value="" selected disabled>Please select a course</option>';
            foreach ($query->result() as $row) {
                $output .= '<option value="' . $row->course_id . '">' . $row->course_name . '</option>';
            }
        } else {
            $output = '<option value="" selected disabled>No courses available</option>';
        }

        return $output;
    }

    function fetch_courses_id($uni_id)  //new function
    {
        $this->db->where('uni_id', $uni_id);
        $query = $this->db->get('courses');

        if ($query->num_rows() > 0) {
            $output = '<option value="" selected disabled>Please select a course</option>';
            foreach ($query->result() as $row) {
                $output .= '<option value="' . $row->course_id . '">' . $row->course_name . '</option>';
            }
        } else {
            $output = '<option value="" selected disabled>No courses available</option>';
        }

        return $output;
    }

    function course_field_dropdown($uni_id)
    {
        $this->db->where('uni_id', $uni_id);
        $this->db->order_by('event_type');
        $this->db->group_by('event_type');
        return $this->db->get('courses')->result();
    }

    function get_course_with_event_type($event_type, $uni_id)
    {
        if ($event_type == 'all') {
            $this->db->where('uni_id', $uni_id);
            $this->db->order_by('event_type');
            $this->db->order_by("course_level", "asc");
            return $this->db->get('courses')->result();
        } else {
            $this->db->where('uni_id', $uni_id);
            $this->db->where('event_type', $event_type);
            $this->db->order_by('event_type');
            $this->db->order_by("course_level", "asc");
            return $this->db->get('courses')->result();
        }
    }

    function filter_dropdown($attribute)
    {
        $this->db->group_by($attribute);

        return $this->db->get('courses')->result();
    }

    function filter_course($event_type, $course_level, $course_intake, $course_country, $course_fee)
    {


        if ($event_type != "") {
            $this->db->where('event_type', $event_type);
        }
        if ($course_level != "") {
            $this->db->where('course_level', $course_level);
        }
        if ($course_intake != "") {
            $this->db->like('course_intake', $course_intake);
        }
        if ($course_country != "") {
            $this->db->where('course_country', $course_country);
        }
        if ($course_fee != "") {
            if ($course_fee == "a") {
                $this->db->order_by('course_fee', 'ASC');
            } else {
                $this->db->order_by('course_fee', 'DESC');
            }
        }

        $this->db->select('*')
            ->from('courses')
            ->join('universities', 'universities.uni_id = courses.uni_id')
            ->where('universities.uni_approval', 1);

        $query = $this->db->get()->result();

        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function get_totalcourse_for_uni($uni_id)
    {
        $this->db->where('uni_id', $uni_id);
        $query = $this->db->get('courses')->result();
        return count($query);
    }

    public function get_uni_id($course_id)
    {
        $this->db->where('course_id', $course_id);
        return $this->db->get('courses')->result();
    }
    function course_join_uni()
    {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->join('universities', 'universities.uni_id = courses.uni_id');
        $this->db->order_by('courses.uni_id');
        $this->db->order_by('courses.course_level');
        $query = $this->db->get()->result();
        return $query;
    }

    function one_course_join_uni($course_id)
    {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('course_id', $course_id);
        $this->db->join('universities', 'universities.uni_id = courses.uni_id');
        $query = $this->db->get()->row();
        return $query;
    }

    // Function for bar graph in ep
    function course_field_bar_chart($uni_id)
    {
        $this->db->select('count(courses.course_id), courses.event_type')
            ->from('courses')
            ->join('universities', 'universities.uni_id = courses.uni_id')
            ->where('universities.uni_id', $uni_id)
            ->group_by('courses.event_type')
            ->order_by('count(courses.course_id)', 'desc')
            ->order_by('courses.event_type', 'asc');
        return $this->db->get()->result_array();
    }
}
