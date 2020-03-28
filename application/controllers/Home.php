<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Home_model', 'Home_title_model', 'Home_client_model', 
            'Home_service_model', 'Home_testimony_model', 'Home_video_model',
            'Home_blog_model', 'Home_expertise_model', 'Home_description_model',
            // 'Home_logo_model'
        ]);
    }

    public function index()
    {
        $data['home_title'] = $this->Home_title_model->get_home_title();
        $data['home_client'] = $this->Home_client_model->get_home_client();
        $data['home_service'] = $this->Home_service_model->get_home_service();
        $data['home_testimony'] = $this->Home_testimony_model->get_home_testimony();
        $data['home_video'] = $this->Home_video_model->get_home_video();
        $data['home_blog'] = $this->Home_blog_model->get_home_blog(3, 0);
        $data['home_expertise'] = $this->Home_expertise_model->get_home_expertise();
        $data['home_description'] = $this->Home_description_model->get_home_description();
        // $data['home_logo'] = $this->Home_logo_model->get_home_logo();

        $data['title'] = 'Admores - Home';

        $this->load->view('templates/header', $data);
        $this->load->view('home_view/index', $data);
        $this->load->view('templates/footer', $data);
    }
}

