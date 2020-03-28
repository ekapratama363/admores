<?php

class About_description_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_description($data) 
    {
        return $this->db->insert('about_description', $data);
    }

    public function get_about_description()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('about_description'); 

        return $query->row_object();
    }

}