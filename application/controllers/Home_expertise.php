<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_expertise extends CI_Controller {

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

        $this->load->model('Home_expertise_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Home_expertise_model->get_home_expertise();

        $data['page'] = 'home_expertise/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'home_expertise/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'home_expertise/edit';
        
        $data['value'] = $this->Home_expertise_model->get_home_expertise_by_id($id);

        // var_dump($data['value']);
        // die();

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('skill', 'skill', 'required');
        $this->form_validation->set_rules('level', 'level', 'required|numeric');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'home_expertise/create';
            $this->load->view('admin_panel/app', $data);
        } else {

            $data = [
                'skill' => $this->input->post('skill'),
                'level' => $this->input->post('level'),
            ];
            
            $this->Home_expertise_model->set_home_expertise($data);

            $this->session->set_flashdata('success', 'save data successfully');

            redirect(base_url("home_expertise/create"));

        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('skill', 'skill', 'required');
        $this->form_validation->set_rules('level', 'level', 'required|numeric');

        if ($this->form_validation->run() == FALSE){
            // var_dump(1);
            // die();
            $data['page'] = "home_expertise/edit/{$id}";
            
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $data = [
                'skill' => $this->input->post('skill'),
                'level' => $this->input->post('level'),
            ];

            $this->Home_expertise_model->update_home_expertise_by_id($id, $data);
            $this->session->set_flashdata('success', 'update data successfully');

            redirect(base_url("home_expertise/index"));

        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Home_expertise_model->delete_home_expertise_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("home_expertise/index"));
        
    }

    public function ajax_home_expertise($q = NULL)
    {
        $q = $this->input->get('q') ? $this->input->get('q') : NULL;
        
        $data = $this->Home_category_project_model->get_home_category_project($q);

        echo json_encode($data);
    }

    public function ajax_list_home_expertise()
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

        $totalFiltered = count($this->Home_expertise_model->get_ajax_list_home_expertise($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Home_expertise_model->get_ajax_list_home_expertise($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                // $image = "<img src='" . base_url() . "uploads/home_expertise/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."home_expertise/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."home_expertise/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
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