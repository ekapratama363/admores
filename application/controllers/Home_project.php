<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_project extends CI_Controller {

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

        $this->load->model('Home_project_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Home_project_model->get_home_project();

        $data['page'] = 'home_project/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'home_project/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'home_project/edit';
        
        $data['value'] = $this->Home_project_model->get_home_project_by_id($id);

        // var_dump($data['value']);
        // die();

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('category', 'category', 'required');
        // $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'home_project/create';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $filename = $_FILES['image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/home_project/";
            $target_file = $target_dir . basename($filename);
        
            if (!$filename) {
                
                $message = 'The image filed is required.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_project/create"));

            } elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                
                $message = 'The filetype you are attempting to upload is not allowed.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_project/create"));
            
            } elseif ($_FILES["image"]["size"] > 500000) {
                
                $message = 'Sorry, your file is too large.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_project/create"));

            } else {
        
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                    $data = [
                        'home_category_project_id' => $this->input->post('category'),
                        // 'description' => $this->input->post('description'),
                        'image'     => $_FILES['image']['name'],
                    ];
                    
                    $this->Home_project_model->set_home_project($data);

                    $this->session->set_flashdata('success', 'save data successfully');
    
                    redirect(base_url("home_project/create"));

                } else {

                    $message = 'Upload image failed';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("home_project/create"));

                }
            }
        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('category', 'category', 'required');
        // $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'home_project/edit/'.$id;
            
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $filename = $_FILES['image']['name'];

            if(!$filename) {

                $data = [
                    'home_category_project_id' => $this->input->post('category'),
                    // 'description' => $this->input->post('description'),
                    // 'image'     => $_FILES['image']['name'],
                ];

                $this->Home_project_model->update_home_project_by_id($id, $data);
                $this->session->set_flashdata('success', 'update data successfully');

                redirect(base_url("home_project/index"));

            } else {

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $target_dir = "uploads/home_project/";
                $target_file = $target_dir . basename($filename);
            
                if ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                    
                    $message = 'The filetype you are attempting to upload is not allowed.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("home_project/index"));
                
                } elseif ($_FILES["image"]["size"] > 500000) {
                    
                    $message = 'Sorry, your file is too large.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("home_project/index"));

                } else {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $data = [
                            'home_category_project_id' => $this->input->post('category'),
                            // 'description' => $this->input->post('description'),
                            'image'     => $_FILES['image']['name'],
                        ];
                        
                        $this->Home_project_model->update_home_project_by_id($id, $data);

                        $this->session->set_flashdata('success', 'save data successfully');
        
                        redirect(base_url("home_project/index"));

                    } else {

                        $message = 'Upload image failed';

                        $this->session->set_flashdata('failed', $message);

                        redirect(base_url("home_project/index"));

                    }
                }
            }
        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Home_project_model->delete_home_project_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("home_project/index"));
        
    }

    public function ajax_home_project($q = NULL)
    {
        $q = $this->input->get('q') ? $this->input->get('q') : NULL;
        
        $data = $this->Home_category_project_model->get_home_category_project($q);

        echo json_encode($data);
    }

    public function ajax_list_home_project()
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

        $totalFiltered = count($this->Home_project_model->get_ajax_list_home_project($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Home_project_model->get_ajax_list_home_project($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                $image = "<img src='" . base_url() . "uploads/home_project/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."home_project/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."home_project/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
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