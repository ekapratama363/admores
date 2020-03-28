<?php

class Home_project_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_project($data) 
    {
        return $this->db->insert('home_project', $data);
    }

    public function get_home_project()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_project'); 

        return $query->row_object();
    }

    public function get_ajax_list_home_project($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->select('*')
                ->from('home_project')
                ->join('home_category_project', 'home_category_project.id = home_project.home_category_project_id')
                ->select('home_project.id, home_project.image, home_category_project.category')
                ->where('(home_category_project.category LIKE \'%'.$match.'%\')')
                ->order_by('home_project.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get();

        return $query->result_object();
    }

    public function get_home_project_by_id($id)
    {
        
        $query = $this->db->select('*')
                ->from('home_project')
                ->join('home_category_project', 'home_category_project.id = home_project.home_category_project_id', 'left')
                ->select('home_project.id, home_project.image, home_project.home_category_project_id, 
                            home_category_project.category')
                ->where('home_project.id', $id)
                ->get();

        // $query = $this->db->get_where('home_project', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_project_by_id($id, $data)
    {
        
        $query = $this->db->where('id', $id)->update('home_project', $data);

        return $query;
    }

    public function delete_home_project_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_project');
    }

}