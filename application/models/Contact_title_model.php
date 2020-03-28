<?php

class Contact_title_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_contact_title($data) 
    {
        return $this->db->insert('contact_title', $data);
    }

    public function get_contact_title()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('contact_title'); 

        return $query->row_object();
    }

}