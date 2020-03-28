<?php

class Service_category_project_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_service_category_project($data) 
    {
        return $this->db->insert('service_category_project', $data);
    }

    public function ajax_()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('service_category_project'); 

        return $query->row_object();
    }

    public function get_ajax_list_service_category_project($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(category LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('service_category_project');

        return $query->result_object();
    }

    public function get_service_category_project_by_id($id)
    {
        $query = $this->db->get_where('service_category_project', ['id' => $id]);

        return $query->row_object();
    }

    public function update_service_category_project_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('service_category_project', $data);

        return $query;
    }

    public function delete_service_category_project_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('service_category_project');
    }

    public function ajax_get_service_category_project($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('service_category_project');

        return $query->result_object();
    }

    public function get_service_category_project()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('service_category_project'); 

        return $query->result_object();
    }

}