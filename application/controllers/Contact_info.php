<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_info extends CI_Controller {

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
        
        $this->load->helper('email');

        $this->load->model('Contact_info_model');
    }
    
    public function index()
    {
        $data['value'] = $this->Contact_info_model->get_contact_info();

        $data['page'] = 'contact_info/index';

        $this->load->view('admin_panel/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('image', 'image', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'contact_info/index';
            $this->load->view('admin_panel/app', $data);
        } else {
            
            $data = [
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
            ];
            
            $this->Contact_info_model->set_contact_info($data);

            $this->session->set_flashdata('success', 'save data successfully');

            redirect(base_url("contact_info/index"));
        }
    }

}