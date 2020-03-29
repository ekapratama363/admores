<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function auth_login($data)
    {
        $query = $this->db->get_where('users', $data);

        return $query->row_object();
    }
}