<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_message extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
		// if($this->session->userdata('is_login') != "true"){
		// 	redirect(base_url("/"));
        // }
        
        // for load helper
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('Contact_message_model');
    }
    
    public function index()
    {
        // $data['value'] = $this->Contact_message_model->get_contact_message();

        $data['page'] = 'contact_message/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'contact_message/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'contact_message/edit';
        
        $data['value'] = $this->Contact_message_model->get_contact_message_by_id($id);

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'contact_message/create';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                // 'created_by' => 1,
            ];
            
            $this->Contact_message_model->set_contact_message($data);

            $this->session->set_flashdata('success', 'save data successfully');

            redirect(base_url("contact_message/create"));

        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'contact_message/edit/'.$id;
            
            $this->load->view('admin_panel/app', $data);
        } else {

            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
            ];

            $this->Contact_message_model->update_contact_message_by_id($id, $data);
            $this->session->set_flashdata('success', 'update data successfully');

            redirect(base_url("contact_message/index"));

        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Contact_message_model->delete_contact_message_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("contact_message/index"));
        
    }

    public function ajax_contact_message($q = NULL)
    {
        $q = $this->input->get('q') ? $this->input->get('q') : NULL;
        
        $data = $this->Contact_message_model->ajax_get_contact_message($q);

        echo json_encode($data);
    }

    public function ajax_list_contact_message()
    {
        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length');

        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';
        
        $array = [];
        if($searchTerms) {
            foreach($searchTerms as $searchTerm){
                $array['search'] = $searchTerm;
            }
        }

        if ($dir === 'asc') {
            $array['order'] = 'desc';
        }

        $totalFiltered = count($this->Contact_message_model->get_ajax_list_contact_message($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Contact_message_model->get_ajax_list_contact_message($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                // $image = "<img src='" . base_url() . "uploads/contact_message/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."contact_message/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
                        <i class='fa fa-trash'></i>
                    </a>
                ";

                $posts[$key]->no = $no;
                // $posts[$key]->image = $image;
                $posts[$key]->action = $action;
            }
        }

        $json_data = [
            "draw"            => $draw,
            "recordsTotal"    => $totalFiltered,
            "recordsFiltered" => $totalFiltered,
            "data"            => $posts
        ];

        echo json_encode($json_data);
    }

}