<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'About_model', 'About_title_model', 'About_team_model',
            'About_content_model', 'About_description_model', 'About_detail_model', 
            'About_detail_description_model'
        ]);
    }

    public function index()
    {
        $data['about_title'] = $this->About_title_model->get_about_title();
        $data['about_description'] = $this->About_description_model->get_about_description();
        $data['about_content'] = $this->About_content_model->get_about_content();
        $data['about_detail'] = $this->About_detail_model->get_about_detail();
        $data['about_detail_description'] = $this->About_detail_description_model->get_about_detail_description();
        $data['about_team'] = $this->About_team_model->get_about_team();

        $data['title'] = 'Admores - About Us';

        $this->load->view('templates/header', $data);
        $this->load->view('about_view/index', $data);
        $this->load->view('templates/footer', $data);
    }
}

