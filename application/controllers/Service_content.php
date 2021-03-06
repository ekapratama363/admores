<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_content extends CI_Controller {

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

        $this->load->model('Service_content_model');
    }
    
    public function index()
    {
        // $data['value'] = $this->Service_content_model->get_service_content();

        $data['page'] = 'service_content/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'service_content/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'service_content/edit';
        
        $data['value'] = $this->Service_content_model->get_service_content_by_id($id);

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'service_content/create';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $filename = $_FILES['image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/service_content/";
            $target_file = $target_dir . basename($filename);
        
            if (!$filename) {
                
                $message = 'The image filed is required.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("service_content/create"));

            } elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                
                $message = 'The filetype you are attempting to upload is not allowed.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("service_content/create"));
            
            } elseif ($_FILES["image"]["size"] > 500000) {
                
                $message = 'Sorry, your file is too large.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("service_content/create"));

            } else {
        
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                    $data = [
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'image' => $_FILES['image']['name'],
                    ];
                    
                    $this->Service_content_model->set_service_content($data);

                    $this->session->set_flashdata('success', 'save data successfully');
    
                    redirect(base_url("service_content/create"));

                } else {

                    $message = 'Upload image failed';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("service_content/create"));

                }
            }
        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'service_content/edit/'.$id;
            
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $filename = $_FILES['image']['name'];

            if(!$filename) {

                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    // 'image' => $_FILES['image']['name'],
                ];

                $this->Service_content_model->update_service_content_by_id($id, $data);
                $this->session->set_flashdata('success', 'update data successfully');

                redirect(base_url("service_content/index"));

            } else {

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $target_dir = "uploads/service_content/";
                $target_file = $target_dir . basename($filename);
            
                if ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                    
                    $message = 'The filetype you are attempting to upload is not allowed.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("service_content/index"));
                
                } elseif ($_FILES["image"]["size"] > 500000) {
                    
                    $message = 'Sorry, your file is too large.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("service_content/index"));

                } else {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        
                        $data = [
                            'title' => $this->input->post('title'),
                            'description' => $this->input->post('description'),
                            'image' => $_FILES['image']['name'],
                        ];
                        
                        $this->Service_content_model->update_service_content_by_id($id, $data);

                        $this->session->set_flashdata('success', 'save data successfully');
        
                        redirect(base_url("service_content/index"));

                    } else {

                        $message = 'Upload image failed';

                        $this->session->set_flashdata('failed', $message);

                        redirect(base_url("service_content/index"));

                    }
                }
            }
        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Service_content_model->delete_service_content_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("service_content/index"));
        
    }

    public function ajax_list_service_content()
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

        $totalFiltered = count($this->Service_content_model->get_ajax_list_service_content($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Service_content_model->get_ajax_list_service_content($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                $image = "<img src='" . base_url() . "uploads/service_content/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."service_content/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."service_content/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
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