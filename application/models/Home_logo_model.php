<?php

class Home_logo_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_logo($data) 
    {
        return $this->db->insert('home_logo', $data);
    }

    public function get_home_logo()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_logo'); 

        return $query->row_object();
    }

}