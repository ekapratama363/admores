<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
		if($this->session->userdata('is_login') != "true"){
			redirect(base_url("auth/login"));
        }
        
        // for load helper
        $this->load->helper('url_helper');
        // $this->load->helper('form');
        // $this->load->library('form_validation');
        $this->load->library('session');

        // $this->load->model('');
    }
    
    public function index()
    {
        $data['page'] = 'overview/index';
        $this->load->view('admin_panel/app', $data);
    }

}