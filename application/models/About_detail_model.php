<?php

class About_detail_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_detail($data) 
    {
        return $this->db->insert('about_detail', $data);
    }

    public function get_about_detail()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('about_detail'); 

        return $query->row_object();
    }

}