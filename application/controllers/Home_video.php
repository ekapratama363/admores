<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_video extends CI_Controller {

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

        $this->load->model('Home_video_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Home_video_model->get_home_video();

        $data['page'] = 'home_video/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function create()
    {
        $data['page'] = 'home_video/create';

        $this->load->view('admin_panel/app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'home_video/edit';
        
        $data['value'] = $this->Home_video_model->get_home_video_by_id($id);

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        // $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            
            $data['page'] = 'home_video/index';
            $this->load->view('admin_panel/app', $data);
        
        } else {
            
            $filename = $_FILES['video']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/home_video/";
            $target_file = $target_dir . basename($filename);
        
            if (!$filename) {
                
                $message = 'The video filed is required.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_video/index"));

            } elseif ($ext != "mp4" && $ext != "mkv" && $ext != "rpm") {
                
                $message = 'The filetype you are attempting to upload is not allowed.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_video/index"));
            
            } elseif ($_FILES["video"]["size"] > 1000000) {
                
                $message = 'Sorry, your file is too large.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_video/index"));

            } else {
        
                if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {

                    $data = [
                        'title' => $this->input->post('title'),
                        'video' => $_FILES['video']['name'],
                        // 'created_by' => 1,
                    ];
                    
                    $this->Home_video_model->set_home_video($data);

                    $this->session->set_flashdata('success', 'save data successfully');
    
                    redirect(base_url("home_video/index"));

                } else {

                    $message = 'Upload video failed';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("home_video/index"));

                }
            }
        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'home_video/edit/'.$id;
            
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $filename = isset($_FILES['video']['name']) ? $_FILES['video']['name'] : NULL;

            if($filename === NULL) {

                $data = [
                    'title' => $this->input->post('title'),
                ];

                $this->Home_video_model->update_home_video_by_id($id, $data);
                $this->session->set_flashdata('success', 'update data successfully');

                redirect(base_url("home_video/index"));

            } else {

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $target_dir = "uploads/home_video/";
                $target_file = $target_dir . basename($filename);
            
                if ($ext != "mkv" && $ext != "mp4") {
                    
                    $message = 'The filetype you are attempting to upload is not allowed.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("home_video/index"));
                
                } elseif ($_FILES["video"]["size"] > 500000) {
                    
                    $message = 'Sorry, your file is too large.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("home_video/index"));

                } else {

                    if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {

                        $data = [
                            'title' => $this->input->post('title'),
                            'video' => $_FILES['video']['name'],
                        ];
                        
                        $this->Home_video_model->update_home_video_by_id($id, $data);

                        $this->session->set_flashdata('success', 'save data successfully');
        
                        redirect(base_url("home_video/index"));

                    } else {

                        $message = 'Upload video failed';

                        $this->session->set_flashdata('failed', $message);

                        redirect(base_url("home_video/index"));

                    }
                }
            }
        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Home_video_model->delete_home_video_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("home_video/index"));
        
    }

    public function ajax_list_home_video()
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

        $totalFiltered = count($this->Home_video_model->get_ajax_list_home_video($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Home_video_model->get_ajax_list_home_video($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                $video = "<img src='" . base_url() . "uploads/home_video/" . $value->video . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."home_video/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."home_video/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
                        <i class='fa fa-trash'></i>
                    </a>
                ";

                $posts[$key]->no = $no;
                $posts[$key]->video = $video;
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