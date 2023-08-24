<?php

class company_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('company', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('c_id', $id);
        if ($this->db->update('company', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('c_id', $id);
        $this->db->delete('company');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('company')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('company')->result();
    }

    public function valid_email($c_email)
    {
        return $this->db->get_where('company', ['c_email'=>$c_email])->row_array();
    }

    // public function last_c_id()
    // {
    //  $row = $this->db->select("*")->limit(1)->order_by('c_id',"DESC")->get("company")->row();
    //  return $row->c_id; //it will provide latest or last record id.
    // }

    public function c_details($c_id)
    {
        return $this->db->get_where('company', ['c_id'=>$c_id])->row_array();
    }

    public function get_c_detail($c_id)
    {
       $this->db->where('c_id',$c_id);
       return $this->db->get('company')->row();
    } 
   
}
