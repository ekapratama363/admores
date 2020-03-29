<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_title extends CI_Controller {

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

        $this->load->model('Home_title_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Home_title_model->get_home_title();

        $data['page'] = 'home_title/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // $this->form_validation->set_rules('image', 'image', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'home_title/index';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $filename = $_FILES['image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/home_title/";
            $target_file = $target_dir . basename($filename);
        
            if (!$filename) {
                
                $message = 'The image filed is required.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_title/index"));

            } elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                
                $message = 'The filetype you are attempting to upload is not allowed.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_title/index"));
            
            } elseif ($_FILES["image"]["size"] > 500000) {
                
                $message = 'Sorry, your file is too large.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_title/index"));

            } else {

                // try {
        
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $data = [
                            'title'       => $this->input->post('title'),
                            'description' => $this->input->post('description'),
                            'image'       => $_FILES['image']['name'],
                        ];
                        
                        $this->Home_title_model->set_home_title($data);
    
                        $this->session->set_flashdata('success', 'save data successfully');
        
                        redirect(base_url("home_title/index"));
    
                    } else {

                        $message = 'Upload image failed';
    
                        $this->session->set_flashdata('failed', $message);
    
                        redirect(base_url("home_title/index"));

                    }
        
                // } catch (\Throwable $th) {

                //     // echo $th->getMessage();

                //     $message = $th->getMessage();

                //     $this->session->set_flashdata('failed', $message);

                //     redirect(base_url("home_title/index"));

                // }
            }
        }
    }

}