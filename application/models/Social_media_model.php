<?php

class Social_media_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_social_media($data) 
    {
        return $this->db->insert('social_media', $data);
    }

    public function get_social_media()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('social_media'); 

        return $query->result_object();
    }

    public function get_ajax_list_social_media($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->select('*')
                ->from('social_media')
                ->join('about_team', 'about_team.id = social_media.about_team_id')
                ->select('social_media.id, social_media.type, social_media.link,
                        about_team.name')
                ->where('(about_team.name LIKE \'%'.$match.'%\')')
                ->order_by('social_media.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get();

        return $query->result_object();
    }

    public function get_social_media_by_id($id)
    { 
        $query = $this->db
                ->select('social_media.id, social_media.type, social_media.link, social_media.about_team_id,
                        about_team.name')
                ->from('social_media')
                ->join('about_team', 'about_team.id = social_media.about_team_id')
                ->where('social_media.id', $id)
                ->get();

        return $query->row_object();
    }

    public function update_social_media_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('social_media', $data);

        return $query;
    }

    public function delete_social_media_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('social_media');
    }

}