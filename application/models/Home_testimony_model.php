<?php

class Home_testimony_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_testimony($data) 
    {
        return $this->db->insert('home_testimony', $data);
    }

    public function get_home_testimony()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_testimony'); 

        return $query->result_object();
    }

    public function get_ajax_list_home_testimony($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(name LIKE \'%'.$match.'%\' 
                        or testimony LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('home_testimony');

        return $query->result_object();
    }

    public function get_home_testimony_by_id($id)
    {
        $query = $this->db->get_where('home_testimony', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_testimony_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('home_testimony', $data);

        return $query;
    }

    public function delete_testimony_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_testimony');
    }

}