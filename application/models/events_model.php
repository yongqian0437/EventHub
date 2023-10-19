<?php

class events_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('events', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('event_id', $id);
        if ($this->db->update('events', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('event_id', $id);
        $this->db->delete('events');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('events')->result();
    }

    function select_all_approved()
    {
        $this->db->select('*')
            ->from('events')
            ->join('organizer', 'organizer.organizer_id = events.organizer_id')
            ->where('organizer.organizer_approval', 1);
        return $this->db->get()->result();
    }

    function select_condition($id)
    {
        $this->db->where('event_id', $id);
        return $this->db->get('events')->result();
    }

    public function valid_event_name($event_name)
    {
        return $this->db->get_where('events', ['event_name' => $event_name])->row_array();
    }

    // public function last_event_id()
    // {
    //  $row = $this->db->select("*")->limit(1)->order_by('event_id',"DESC")->get("events")->row();
    //  return $row->event_id; //it will provide latest or last record id.
    // }
    function get_event_with_id($id)  //new function
    {
        $this->db->where('event_id', $id);
        return $this->db->get('events')->result();
    }

    function fetch_events($organizer_id, $event_level)  //new function
    {
        $this->db->where('organizer_id', $organizer_id);
        $this->db->where('event_level', $event_level);
        $this->db->order_by('event_name', 'ASC');
        $query = $this->db->get('events');

        if ($query->num_rows() > 0) {
            $output = '<option value="" selected disabled>Please select a event</option>';
            foreach ($query->result() as $row) {
                $output .= '<option value="' . $row->event_id . '">' . $row->event_name . '</option>';
            }
        } else {
            $output = '<option value="" selected disabled>No events available</option>';
        }

        return $output;
    }

    function fetch_events_id($organizer_id)  //new function
    {
        $this->db->where('organizer_id', $organizer_id);
        $query = $this->db->get('events');

        if ($query->num_rows() > 0) {
            $output = '<option value="" selected disabled>Please select a event</option>';
            foreach ($query->result() as $row) {
                $output .= '<option value="' . $row->event_id . '">' . $row->event_name . '</option>';
            }
        } else {
            $output = '<option value="" selected disabled>No events available</option>';
        }

        return $output;
    }

    function event_field_dropdown($organizer_id)
    {
        $this->db->where('organizer_id', $organizer_id);
        $this->db->order_by('event_type');
        $this->db->group_by('event_type');
        return $this->db->get('events')->result();
    }

    function get_event_with_event_type($event_type, $organizer_id)
    {
        if ($event_type == 'all') {
            $this->db->where('organizer_id', $organizer_id);
            $this->db->order_by('event_type');
            $this->db->order_by("event_level", "asc");
            return $this->db->get('events')->result();
        } else {
            $this->db->where('organizer_id', $organizer_id);
            $this->db->where('event_type', $event_type);
            $this->db->order_by('event_type');
            $this->db->order_by("event_level", "asc");
            return $this->db->get('events')->result();
        }
    }

    function filter_dropdown($attribute)
    {
        $this->db->group_by($attribute);

        return $this->db->get('events')->result();
    }

    function filter_event($event_type, $event_level, $event_intake, $event_country, $event_fee)
    {


        if ($event_type != "") {
            $this->db->where('event_type', $event_type);
        }
        if ($event_level != "") {
            $this->db->where('event_level', $event_level);
        }
        if ($event_intake != "") {
            $this->db->like('event_intake', $event_intake);
        }
        if ($event_country != "") {
            $this->db->where('event_country', $event_country);
        }
        if ($event_fee != "") {
            if ($event_fee == "a") {
                $this->db->order_by('event_fee', 'ASC');
            } else {
                $this->db->order_by('event_fee', 'DESC');
            }
        }

        $this->db->select('*')
            ->from('events')
            ->join('organizer', 'organizer.organizer_id = events.organizer_id')
            ->where('organizer.organizer_approval', 1);

        $query = $this->db->get()->result();

        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function get_totalevent_for_uni($organizer_id)
    {
        $this->db->where('organizer_id', $organizer_id);
        $query = $this->db->get('events')->result();
        return count($query);
    }

    public function get_organizer_id($event_id)
    {
        $this->db->where('event_id', $event_id);
        return $this->db->get('events')->result();
    }
    function event_join_uni()
    {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->join('organizer', 'organizer.organizer_id = events.organizer_id');
        $this->db->order_by('events.organizer_id');
        $this->db->order_by('events.event_level');
        $query = $this->db->get()->result();
        return $query;
    }

    function one_event_join_uni($event_id)
    {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->where('event_id', $event_id);
        $this->db->join('organizer', 'organizer.organizer_id = events.organizer_id');
        $query = $this->db->get()->row();
        return $query;
    }

    // Function for bar graph in ep
    function event_field_bar_chart($organizer_id)
    {
        $this->db->select('count(events.event_id), events.event_type')
            ->from('events')
            ->join('organizer', 'organizer.organizer_id = events.organizer_id')
            ->where('organizer.organizer_id', $organizer_id)
            ->group_by('events.event_type')
            ->order_by('count(events.event_id)', 'desc')
            ->order_by('events.event_type', 'asc');
        return $this->db->get()->result_array();
    }
}
