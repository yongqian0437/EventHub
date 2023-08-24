<?php

class chat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function send_message($data)
    {
        $res = $this->db->insert('chat', $data);
        if ($res == 1)
            return true;
        else
            return false;
    }

    public function receiver_chat_history($receiver_id)
    {

        $sender_id = $this->session->userdata['user_id'];

        // SELECT * FROM `chat` WHERE `sender_id`= 100 AND `receiver_id` = 300 OR `sender_id`= 300 AND `receiver_id` = 100
        $condition = "`sender_id`= '$sender_id' AND `receiver_id` = '$receiver_id' OR `sender_id`= '$receiver_id' AND `receiver_id` = '$sender_id'";

        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query) 
            return $query->result_array();
        else 
            return false;
    }

    public function receiver_message_list($receiver_id)
    {
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where('receiver_id', $receiver_id);
        $query = $this->db->get();
        if ($query)
            return $query->result_array();
        else
            return false;
    }

    public function clear_chat_by_id ($receiver_id)
    {
        $res = $this->db->delete('chat', ['receiver_id' => $receiver_id]);
        if ($res == 1)
            return true;
        else
            return false;
    }

}
