<?php

class rd_applicants_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert($data)
    {
        $this->db->insert('rd_applicants', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data, $id)
    {
        $this->db->where('rd_applicant_id', $id);
        if ($this->db->update('rd_applicants', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('rd_applicant_id', $id);
        $this->db->delete('rd_applicants');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_all()
    {
        return $this->db->get('rd_applicants')->result();
    }

    function select_condition($condition)
    {
        $this->db->where($condition);
        return $this->db->get('rd_applicants')->result();
    }

    //Check if there is existing ep_collab_id and emp_id in the same row (existing record of student R&DP application)
    function past_application($user_id, $rd_id)
    {
        $this->db->where('user_id ', $user_id);
        $ep_data = $this->db->get('user_ep')->row();
        $condition = "ep_collab_id = '$ep_data->ep_id' AND rd_id = '$rd_id'";
        $this->db->from('rd_applicants')
            ->where($condition)
            ->limit(1);
        $result = $this->db->get()->result_array();
        // $condition = $this->db->get()->result_array();
        if ($result)
            return true;
        else
            return false;
    }

    function all_my_applications($ep_id)
    {
        $this->db->where('ep_collab_id ', $ep_id);
        return $this->db->get('rd_applicants')->result();
    }

    function get_rd_owner_detail($rd_id)
    {
        $this->db->where('rd_id ', $rd_id);
        return $this->db->get('rd_projects')->row();
    }

    function all_project_partners($ep_id)
    {
        $this->db->where('ep_owner_id ', $ep_id);
        return $this->db->get('rd_applicants')->result();
    }

    function get_ep_partner_detail($ep_id)
    {
        $this->db->select('*');
        $this->db->from('user_ep');
        $this->db->where('ep_id ', $ep_id);
        $this->db->join('universities', 'universities.organizer_id = user_ep.organizer_id');
        $this->db->join('users', 'users.user_id = user_ep.user_id');
        $query = $this->db->get()->row();
        return $query;
    }

    function get_one_rd_applicant($rd_applicant_id)
    {
        $this->db->where('rd_applicant_id', $rd_applicant_id);
        return $this->db->get('rd_applicants')->row();
    }

    function sort_select_all()
    {
        $this->db->order_by('rd_app_submitdate', 'DESC');
        return $this->db->get('rd_applicants')->result();
    }

    function delete_rd_applicant_with_rd_id($rd_id)
    {
        $this->db->where('rd_id', $rd_id);
        $this->db->delete('rd_applicants');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
