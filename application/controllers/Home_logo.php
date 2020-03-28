<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_logo extends CI_Controller {

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

        $this->load->model('Home_logo_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Home_logo_model->get_home_logo();

        $data['page'] = 'home_logo/index';

        // var_dump($data);
        // die();

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {

        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $target_dir = "uploads/home_logo/";
        $target_file = $target_dir . basename($filename);
    
        if (!$filename) {
            
            $message = 'The image filed is required.';

            $this->session->set_flashdata('failed', $message);

            redirect(base_url("home_logo/index"));

        } elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
            
            $message = 'The filetype you are attempting to upload is not allowed.';

            $this->session->set_flashdata('failed', $message);

            redirect(base_url("home_logo/index"));
        
        } elseif ($_FILES["image"]["size"] > 500000) {
            
            $message = 'Sorry, your file is too large.';

            $this->session->set_flashdata('failed', $message);

            redirect(base_url("home_logo/index"));

        } else {
    
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                $data = [
                    'image'       => $_FILES['image']['name'],
                ];
                
                $this->Home_logo_model->set_home_logo($data);

                $this->session->set_flashdata('success', 'save data successfully');

                redirect(base_url("home_logo/index"));

            } else {

                $message = 'Upload image failed';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("home_logo/index"));

            }
        }
    }

}