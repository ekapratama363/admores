<?php

class Home_title_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_title($data) 
    {
        return $this->db->insert('home_title', $data);
    }

    public function get_home_title()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_title'); 

        return $query->row_object();
    }

}