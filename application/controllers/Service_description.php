<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_description extends CI_Controller {

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

        $this->load->model('Service_description_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Service_description_model->get_service_description();

        $data['page'] = 'service_description/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('title_description', 'title_description', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        // $this->form_validation->set_rules('image', 'image', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'service_description/index';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $data = [
                'title' => $this->input->post('title'),
                'title_description' => $this->input->post('title_description'),
                'description' => $this->input->post('description'),
            ];
            
            $this->Service_description_model->set_service_description($data);

            $this->session->set_flashdata('success', 'save data successfully');

            redirect(base_url("service_description/index"));
        }
    }

}