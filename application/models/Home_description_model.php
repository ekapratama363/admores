<?php

class Home_description_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_description($data) 
    {
        return $this->db->insert('home_description', $data);
    }

    public function get_home_description()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_description'); 

        return $query->row_object();
    }

}