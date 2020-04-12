<?php

class Service_map_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_service_map($data) 
    {
        return $this->db->insert('service_map', $data);
    }

    public function get_service_map()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('service_map'); 

        return $query->result_object();
    }

    public function get_ajax_list_service_map($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\' 
                        or image LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('service_map');

        return $query->result_object();
    }

    public function get_service_map_by_id($id)
    {
        $query = $this->db->get_where('service_map', ['id' => $id]);

        return $query->row_object();
    }

    public function update_service_map_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('service_map', $data);

        return $query;
    }

    public function delete_service_map_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('service_map');
    }

}