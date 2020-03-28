<?php

class About_detail_description_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_detail_description($data) 
    {
        return $this->db->insert('about_detail_description', $data);
    }

    public function ajax_about_detail_description()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('about_detail_description'); 

        return $query->row_object();
    }

    public function get_ajax_list_about_detail_description($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('about_detail_description');

        return $query->result_object();
    }

    public function get_about_detail_description_by_id($id)
    {
        $query = $this->db->get_where('about_detail_description', ['id' => $id]);

        return $query->row_object();
    }

    public function update_about_detail_description_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('about_detail_description', $data);

        return $query;
    }

    public function delete_about_detail_description_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('about_detail_description');
    }

    public function ajax_get_about_detail_description($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('about_detail_description');

        return $query->result_object();
    }

    public function get_about_detail_description()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('about_detail_description'); 

        return $query->result_object();
    }

}