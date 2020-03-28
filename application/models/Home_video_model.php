<?php

class Home_video_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_video($data) 
    {
        return $this->db->insert('home_video', $data);
    }

    public function get_home_video()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_video'); 

        return $query->row_object();
    }

    public function get_ajax_list_home_video($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db
                ->where('(home_video.title LIKE \'%'.$match.'%\' 
                        or home_video.description LIKE \'%'.$match.'%\')')
                ->order_by('home_video.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('home_video');

        return $query->result_object();
    }

    public function get_home_video_by_id($id)
    {
        $query = $this->db->get_where('home_video', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_video_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('home_video', $data);

        return $query;
    }

    public function delete_home_video_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_video');
    }

}