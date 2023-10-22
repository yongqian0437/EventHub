<?php

class user_ep_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        return $this->db->get('user_ep');
    }

    function insert($data)
    {
        $this->db->insert('user_ep', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('ep_id', $id);
        if ($this->db->update('user_ep', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('ep_id', $id);
        $this->db->delete('user_ep');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('user_ep')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('user_ep')->result();
    }

    public function last_user_id()
    {
        $row = $this->db->select("*")->limit(1)->order_by('user_id', "DESC")->get("users")->row();
        return $row->user_id; //it will provide latest or last record id.
    }

    public function ep_details($id)
    {
        return $this->db->get_where('user_ep', ['user_id' => $id])->row_array();
    }

    public function ep_profile_details($id)
    {
        $this->db->select('*')
            ->from('user_ep')
            ->join('users', 'users.user_id = user_ep.user_id')
            ->join('organizer', 'organizer.organizer_id = user_ep.organizer_id')
            ->where('user_ep.user_id', $id);
        return $this->db->get()->row_array();
    }

    public function approved_ep()
    {
        $this->db->select('*')
            ->from('users')
            ->join('user_ep', 'user_ep.user_id = users.user_id')
            ->where('user_approval', 1);
        return $this->db->get()->result_array();
    }

    public function full_ep_details()
    {
        $this->db->select('')
            ->from('user_ep') // ep table
            ->join('users', 'users.user_id = user_ep.user_id'); // users table
        return $this->db->get();
    }

    public function get_full_ep_detail()
    {
        $this->db->select('')
            ->from('users') // users table
            ->join('user_ep', 'user_ep.user_id = users.user_id') // ep table
            ->join('organizer', 'organizer.organizer_id = user_ep.organizer_id'); // org table
        return $this->db->get()->row(); // return object array
    }

    public function get_ep_detail($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user_ep')->row();
    }
    public function get_uni_from_ep($user_id)
    {
        $this->db->where('user_id', $user_id);
        $ep_query = $this->db->get('user_ep')->row();

        $this->db->where('organizer_id', $ep_query->organizer_id);
        return $this->db->get('organizer')->row();
    }

    public function get_event_for_uni($organizer_id)
    {
        $this->db->where('organizer_id', $organizer_id);
        return $this->db->get('events')->result();
    }

    public function get_event_detail($event_id)
    {
        $this->db->where('event_id', $event_id);
        return $this->db->get('events')->row();
    }

    public function get_rd_for_ep($ep_id)
    {
        $this->db->where('ep_id', $ep_id);
        return $this->db->get('rd_projects')->result();
    }

    public function get_ep_detail_with_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user_ep')->row();
    }

    public function get_one_rd_detail($rd_id)
    {
        $this->db->where('rd_id', $rd_id);
        return $this->db->get('rd_projects')->row();
    }
}
