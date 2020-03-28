<?php

class Service_description_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_service_description($data) 
    {
        return $this->db->insert('service_description', $data);
    }

    public function get_service_description()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('service_description'); 

        return $query->row_object();
    }

}