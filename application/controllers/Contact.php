<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('email');
        $this->load->library('session');

        $this->load->model([
            'Contact_model', 'Contact_title_model', 'Contact_info_model',
            'Contact_message_model'
        ]);
    }

    public function index()
    {
        $data['contact_title'] = $this->Contact_title_model->get_contact_title();
        $data['contact_info'] = $this->Contact_info_model->get_contact_info();

        $data['title'] = 'Admores - Contact Us';

        $this->load->view('templates/header', $data);
        $this->load->view('contact_view/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['contact_title'] = $this->Contact_title_model->get_contact_title();
            $data['contact_info'] = $this->Contact_info_model->get_contact_info();
    
            $data['title'] = 'Admores - Contact Us';
    
            $this->load->view('templates/header', $data);
            $this->load->view('contact_view/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
 
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'message' => $this->input->post('message'),
            ];
            
            $this->Contact_message_model->set_contact_message($data);

            $this->session->set_flashdata('success', 'send message successfully');

            redirect(base_url("contact"));
        }
    }
}

