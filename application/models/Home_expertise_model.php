<?php

class Home_expertise_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_expertise($data) 
    {
        return $this->db->insert('home_expertise', $data);
    }

    public function get_home_expertise()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_expertise'); 

        return $query->result_object();
    }

    public function get_ajax_list_home_expertise($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(skill LIKE \'%'.$match.'%\')')
                ->order_by('home_expertise.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('home_expertise');

        return $query->result_object();
    }

    public function get_home_expertise_by_id($id)
    {
        $query = $this->db->get_where('home_expertise', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_expertise_by_id($id, $data)
    {
        
        $query = $this->db->where('id', $id)->update('home_expertise', $data);

        return $query;
    }

    public function delete_home_expertise_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_expertise');
    }

}