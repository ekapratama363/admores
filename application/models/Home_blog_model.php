<?php

class Home_blog_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_blog($data) 
    {
        return $this->db->insert('home_blog', $data);
    }

    public function get_home_blog($limit, $offset)
    {
        $query = $this->db->select('*')
                ->from('home_blog')
                ->join('users', 'users.id = home_blog.created_by')
                ->order_by('home_blog.id', 'desc')
                ->limit($limit, $offset)
                ->get();

        return $query->result_object();
    }

    public function get_ajax_list_home_blog($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->select('home_blog.id, home_blog.title, home_blog.image, 
                                    home_blog.description, home_blog.created_by,
                                    users.name')
                ->from('home_blog')
                ->join('users', 'users.id = home_blog.created_by')
                ->where('(home_blog.title LIKE \'%'.$match.'%\' 
                        or home_blog.description LIKE \'%'.$match.'%\')')
                ->order_by('home_blog.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get();

        return $query->result_object();
    }

    public function get_home_blog_by_id($id)
    {
        $query = $this->db->get_where('home_blog', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_blog_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('home_blog', $data);

        return $query;
    }

    public function delete_home_blog_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_blog');
    }

    public function count_data(){
		return $this->db->get('home_blog')->num_rows();
	}

}