<?php

class Home_service_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_service($data) 
    {
        return $this->db->insert('home_service', $data);
    }

    public function get_home_service()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_service'); 

        return $query->result_object();
    }

    public function get_ajax_list_home_service($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\' 
                        or description LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('home_service');

        return $query->result_object();
    }

    public function get_home_service_by_id($id)
    {
        $query = $this->db->get_where('home_service', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_service_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('home_service', $data);

        return $query;
    }

    public function delete_home_service_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_service');
    }

}