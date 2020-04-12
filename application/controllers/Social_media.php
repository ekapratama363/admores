<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media extends CI_Controller {

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

        $this->load->model('Social_media_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Social_media_model->get_social_media();

        $data['page'] = 'social_media/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'social_media/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'social_media/edit';
        
        $data['value'] = $this->Social_media_model->get_social_media_by_id($id);

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('link', 'link', 'required');
        $this->form_validation->set_rules('team', 'team', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'social_media/create';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $data = [
                'type' => $this->input->post('type'),
                'link' => $this->input->post('link'),
                'about_team_id' => $this->input->post('team'),
            ];
            
            $this->Social_media_model->set_social_media($data);

            $this->session->set_flashdata('success', 'save data successfully');

            redirect(base_url("social_media/create"));
        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('link', 'link', 'required');
        $this->form_validation->set_rules('team', 'team', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'social_media/edit/'.$id;
            
            $this->load->view('admin_panel/app', $data);
        } else {
        
            $data = [
                'type' => $this->input->post('type'),
                'link' => $this->input->post('link'),
                'about_team_id' => $this->input->post('team'),
            ];

            $this->Social_media_model->update_social_media_by_id($id, $data);
            $this->session->set_flashdata('success', 'update data successfully');

            redirect(base_url("social_media/index"));
            
        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Social_media_model->delete_social_media_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("social_media/index"));
        
    }

    public function ajax_list_social_media()
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

        $totalFiltered = count($this->Social_media_model->get_ajax_list_social_media($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Social_media_model->get_ajax_list_social_media($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                $image = "<img src='" . base_url() . "uploads/social_media/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."social_media/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."social_media/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
                        <i class='fa fa-trash'></i>
                    </a>
                ";

                $posts[$key]->no = $no;
                $posts[$key]->image = $image;
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