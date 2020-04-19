<?php

class Content_description_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_content_description($data) 
    {
        return $this->db->insert('content_description', $data);
    }

    public function ajax_content_description()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('content_description'); 

        return $query->row_object();
    }

    public function get_ajax_list_content_description($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('content_description');

        return $query->result_object();
    }

    public function get_content_description_by_id($id)
    {
        $query = $this->db->get_where('content_description', ['id' => $id]);

        return $query->row_object();
    }

    public function update_content_description_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('content_description', $data);

        return $query;
    }

    public function delete_content_description_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('content_description');
    }

    public function ajax_get_content_description($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('content_description');

        return $query->result_object();
    }

    public function get_content_description($home)
    {
        $query = $this->db->order_by('id', 'desc')
                ->where('page', $home)
                ->get('content_description'); 

        return $query->row_object();
    }

}