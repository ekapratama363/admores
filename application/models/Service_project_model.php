<?php

class Service_project_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_service_project($data) 
    {
        return $this->db->insert('service_project', $data);
    }

    public function get_service_project()
    {
        $query = $this->db->select('*')
                ->from('service_project')
                ->join('service_category_project', 'service_category_project.id = service_project.service_category_project_id')
                ->select('service_project.id, service_project.image, service_category_project.category')
                ->get();

        return $query->result_object();
    }

    public function get_ajax_list_service_project($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->select('*')
                ->from('service_project')
                ->join('service_category_project', 'service_category_project.id = service_project.service_category_project_id')
                ->select('service_project.id, service_project.image, service_category_project.category')
                ->where('(service_category_project.category LIKE \'%'.$match.'%\')')
                ->order_by('service_project.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get();

        return $query->result_object();
    }

    public function get_service_project_by_id($id)
    {
        
        $query = $this->db->select('*')
                ->from('service_project')
                ->join('service_category_project', 'service_category_project.id = service_project.service_category_project_id', 'left')
                ->select('service_project.id, service_project.image, service_project.service_category_project_id, 
                            service_category_project.category')
                ->where('service_project.id', $id)
                ->get();

        // $query = $this->db->get_where('service_project', ['id' => $id]);

        return $query->row_object();
    }

    public function update_service_project_by_id($id, $data)
    {
        
        $query = $this->db->where('id', $id)->update('service_project', $data);

        return $query;
    }

    public function delete_service_project_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('service_project');
    }

}