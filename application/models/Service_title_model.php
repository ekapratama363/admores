<?php

class Service_title_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_service_title($data) 
    {
        return $this->db->insert('service_title', $data);
    }

    public function get_service_title()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('service_title'); 

        return $query->row_object();
    }

}