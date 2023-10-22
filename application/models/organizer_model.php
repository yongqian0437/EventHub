<?php

class organizer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('organizer', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('organizer_id', $id);
        if ($this->db->update('organizer', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('organizer_id', $id);
        $this->db->delete('organizer');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('organizer')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('organizer')->result();
    }

    public function valid_email($organizer_email)
    {
        return $this->db->get_where('organizer', ['organizer_email' => $organizer_email])->row_array();
    }

    // public function last_organizer_id()
    // {
    //  $row = $this->db->select("*")->limit(1)->order_by('organizer_id',"DESC")->get("organizer")->row();
    //  return $row->organizer_id; //it will provide latest or last record id.
    // }

    function select_all_approved_only() //new function 
    {
        $this->db->where('organizer_approval', 1);
        return $this->db->get('organizer')->result();
    }

    public function org_details($organizer_id)
    {
        return $this->db->get_where('organizer', ['organizer_id' => $organizer_id])->row_array();
    }

    function get_org_with_id($id)  //new function
    {
        $this->db->where('organizer_id', $id);
        return $this->db->get('organizer')->result();
    }

    function select_all_sort_list()
    {
        $this->db->where('organizer_approval', 1);
        $this->db->order_by('organizer_country', 'ASC');
        $this->db->order_by('organizer_name', 'ASC');
        return $this->db->get('organizer')->result();
    }

    public function uni_max_5()
    {
        $this->db->where('organizer_approval', 1);
        $this->db->order_by('organizer_submitdate', 'DESC');
        $this->db->limit(5);
        return $this->db->get('organizer')->result_array();
    }

    function org_by_approval($condition)
    {
        $this->db->where('organizer_approval', $condition);
        return $this->db->get('organizer')->result();
    }
    public function get_org_detail($organizer_id)
    {
        $this->db->where('organizer_id', $organizer_id);
        return $this->db->get('organizer')->row();
    }

    function fetch_organizer_id($organizer_name)  //new function
    {
        $this->db->where('organizer_name', $organizer_name);
        $query = $this->db->get('organizer');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $output = $row->organizer_id;
            }
        } else {
            $output = '<option value="" selected disabled>No organizer available</option>';
        }

        return $output;
    }

    function sorted_uni_dropdown()
    {
        $this->db->where('organizer_approval', 1);
        $this->db->order_by('organizer_name', 'ASC');
        return $this->db->get('organizer')->result();
    }

    //select all organizers order by submitted date
    function all_uni_by_date()
    {
        $this->db->order_by('organizer_submitdate', 'DESC');
        return $this->db->get('organizer')->result();
    }

    //select all organizers order by submitted date
    function all_pending_uni_by_date()
    {
        $this->db->where('organizer_approval', 0);
        $this->db->order_by('organizer_submitdate', 'DESC');
        return $this->db->get('organizer')->result();
    }

    function edit_one_approval($organizer_id)
    {
        $this->db->where('organizer_id ', $organizer_id);
        $query = $this->db->get('organizer')->row();

        if ($query->organizer_approval == 0) {
            $data = array(
                'organizer_approval' => 1
            );

            $this->db->where('organizer_id ', $organizer_id);
            $this->db->update('organizer', $data);
        }
    }
}
