<?php

class Contact_info_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_contact_info($data) 
    {
        return $this->db->insert('contact_info', $data);
    }

    public function get_contact_info()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('contact_info'); 

        return $query->row_object();
    }
}