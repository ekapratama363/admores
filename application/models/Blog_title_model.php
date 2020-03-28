<?php

class Blog_title_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_blog_title($data) 
    {
        return $this->db->insert('blog_title', $data);
    }

    public function get_blog_title()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('blog_title'); 

        return $query->row_object();
    }

}