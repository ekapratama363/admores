<?php

class About_title_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_title($data) 
    {
        return $this->db->insert('about_title', $data);
    }

    public function get_about_title()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('about_title'); 

        return $query->row_object();
    }

}