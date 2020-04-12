<?php

class About_team_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_team($data) 
    {
        return $this->db->insert('about_team', $data);
    }

    public function get_about_team()
    {
        $about_team = $this->db->get('about_team')->result_array();

        $social_media = $this->db->get('social_media')->result_array();

        $array_about_team = [];
        foreach($about_team as $value) {
            $array_about_team[$value['id']] = $value;
        }

        $array_social_media = [];
        foreach($social_media as $value) {
            $array_social_media[$value['about_team_id']][] = $value;
        }

        foreach($array_about_team as $key => $value) {
            $array_about_team[$key]['social_media'] = isset($array_social_media[$key]) ? $array_social_media[$key] : NULL;
        }
        
        return $array_about_team;
    }

    public function get_ajax_list_about_team($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->select('*')
                ->where('(name LIKE \'%'.$match.'%\' 
                        or position LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('about_team');

        return $query->result_object();
    }

    public function get_about_team_by_id($id)
    {
        $query = $this->db->get_where('about_team', ['id' => $id]);

        return $query->row_object();
    }

    public function update_about_team_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('about_team', $data);

        return $query;
    }

    public function delete_about_team_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('about_team');
    }

    public function ajax_get_about_team($q = NULL)
    {
        if($q) {
            $this->db->like('name', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('about_team');

        return $query->result_object();
    }

}