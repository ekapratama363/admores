<?php

class Contact_message_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_contact_message($data) 
    {
        return $this->db->insert('contact_message', $data);
    }

    public function get_contact_message()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('contact_message'); 

        return $query->row_object();
    }

    public function get_ajax_list_contact_message($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(contact_message.first_name LIKE \'%'.$match.'%\' 
                        or contact_message.message LIKE \'%'.$match.'%\')')
                ->order_by('contact_message.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('contact_message');

        return $query->result_object();
    }

    public function get_contact_message_by_id($id)
    {
        $query = $this->db->get_where('contact_message', ['id' => $id]);

        return $query->row_object();
    }

    public function update_contact_message_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('contact_message', $data);

        return $query;
    }

    public function delete_contact_message_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('contact_message');
    }

}