<?php

class Home_client_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_client($data) 
    {
        return $this->db->insert('home_client', $data);
    }

    public function get_home_client()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_client'); 

        return $query->result_object();
    }

    public function get_ajax_list_home_client($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('home_client');

        return $query->result_object();
    }

    public function get_home_client_by_id($id)
    {
        $query = $this->db->get_where('home_client', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_client_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('home_client', $data);

        return $query;
    }

    public function delete_home_client_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_client');
    }

}