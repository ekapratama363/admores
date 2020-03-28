<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // for load helper
        $this->load->helper('url_helper');
        $this->load->helper('email');
        $this->load->helper('form');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('User_model');
    }

    public function login()
    {
        $this->load->view('auth/login');
    }
    
    public function auth_login()
    {
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $result = $this->User_model->auth_login(['email' => $email]);

            if(isset($result)) {
                $password_hash = $result->password;
                $password = password_verify($password, $password_hash);
                if($password){        
                    $data = [
                        'id' => $result->id,
                        'username' => $result->username,
                        'email' => $result->email,
                        'password' => $result->password,
                        'is_login' => true,
                    ];

                    $this->session->set_userdata($data);
                    redirect(base_url("guest/index"));
                } else {
                    $this->session->set_flashdata('error', 'email or password incorrect');
                    $this->load->view('auth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'email or password incorrect');
                $this->load->view('auth/login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(""));
    }
}