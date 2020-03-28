<?php

class About_content_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_content($data) 
    {
        return $this->db->insert('about_content', $data);
    }

    public function get_about_content()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('about_content'); 

        return $query->result_object();
    }

    public function get_ajax_list_about_content($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('about_content');

        return $query->result_object();
    }

    public function get_about_content_by_id($id)
    {
        $query = $this->db->get_where('about_content', ['id' => $id]);

        return $query->row_object();
    }

    public function update_about_content_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('about_content', $data);

        return $query;
    }

    public function delete_about_content_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('about_content');
    }

}