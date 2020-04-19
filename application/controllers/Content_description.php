<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_description extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
		if($this->session->userdata('is_login') != "true"){
			redirect(base_url("auth/login"));
        }
        
        // for load helper
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('Content_description_model');
    }
    
    public function index()
    {
        // $data['value'] = $this->Content_description_model->get_content_description();

        $data['page'] = 'content_description/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'content_description/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'content_description/edit';
        
        $data['value'] = $this->Content_description_model->get_content_description_by_id($id);

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('page', 'page', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'content_description/create';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'page' => strtolower($this->input->post('page'))
                // 'created_by' => 1,
            ];
            
            $this->Content_description_model->set_content_description($data);

            $this->session->set_flashdata('success', 'save data successfully');

            redirect(base_url("content_description/create"));

        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('page', 'page', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'content_description/edit/'.$id;
            
            $this->load->view('admin_panel/app', $data);
        } else {

            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'page' => strtolower($this->input->post('page')),
            ];

            $this->Content_description_model->update_content_description_by_id($id, $data);
            $this->session->set_flashdata('success', 'update data successfully');

            redirect(base_url("content_description/index"));

        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Content_description_model->delete_content_description_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("content_description/index"));
        
    }

    public function ajax_content_description($q = NULL)
    {
        $q = $this->input->get('q') ? $this->input->get('q') : NULL;
        
        $data = $this->Content_description_model->ajax_get_content_description($q);

        echo json_encode($data);
    }

    public function ajax_list_content_description()
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

        $totalFiltered = count($this->Content_description_model->get_ajax_list_content_description($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Content_description_model->get_ajax_list_content_description($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                // $image = "<img src='" . base_url() . "uploads/content_description/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."content_description/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."content_description/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
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