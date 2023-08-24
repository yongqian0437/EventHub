<?php

class rd_projects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('rd_projects', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('rd_id ', $id);
        if ($this->db->update('rd_projects', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('rd_id ', $id);
        $this->db->delete('rd_projects');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('rd_projects')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('rd_projects')->result();
    }

    function rd_by_approval($condition)
    {
        $this->db->where('rd_approval', $condition);
        return $this->db->get('rd_projects')->result();
    }
    
    function approved_rdps()
    {
        $this->db->select('')
                 ->from('rd_projects')
                 ->join('user_ep', 'user_ep.ep_id = rd_projects.ep_id', 'user_ep.uni_id = rd_projects.rd_organisation' )
                 ->join('universities', 'universities.uni_id = user_ep.uni_id')
                 ->where('rd_approval', '1');
        return $this->db->get()->result_array();
    }

    function get_rd_details($rd_id) {
        $this->db->where('rd_id ', $rd_id);
        return $this->db->get('rd_projects')->row();

    }

    function select_all_join()
    {
        $this->db->select('*');
        $this->db->from('rd_projects');
        $this->db->join('user_ep', 'user_ep.ep_id = rd_projects.ep_id');
        $this->db->join('universities', 'universities.uni_id = user_ep.uni_id');
        $query = $this->db->get()->result();
        return $query;
    }

    function select_pending_join()
    {
        $this->db->select('*');
        $this->db->from('rd_projects');
        $this->db->join('user_ep', 'user_ep.ep_id = rd_projects.ep_id');
        $this->db->join('universities', 'universities.uni_id = user_ep.uni_id');
        $this->db->where('rd_projects.rd_approval ', 0);
        $query = $this->db->get()->result();
        return $query;
    }

    function select_one_rd_join($rd_id)
    {
        $this->db->select('*');
        $this->db->from('rd_projects');
        $this->db->join('user_ep', 'user_ep.ep_id = rd_projects.ep_id');
        $this->db->join('universities', 'universities.uni_id = user_ep.uni_id');
        $this->db->join('users', 'users.user_id = user_ep.user_id');
        $this->db->where('rd_projects.rd_id ', $rd_id);
        $query = $this->db->get()->row();
        return $query;
    }

    function edit_one_approval($rd_id)
    {
        $this->db->where('rd_id ', $rd_id);
        $query = $this->db->get('rd_projects')->row();

        if($query->rd_approval == 0)
        {
            $data = array(
                'rd_approval' => 1
            );

            $this->db->where('rd_id ', $rd_id);
            $this->db->update('rd_projects', $data);
        }
    }

}
