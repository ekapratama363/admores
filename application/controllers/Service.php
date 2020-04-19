<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'Service_model', 'Service_title_model', 'Service_description_model',
            'Service_content_model', 'Service_project_model', 'Service_category_project_model',
            'Content_description_model'
        ]);
    }

    public function index()
    {
        $data['service_title'] = $this->Service_title_model->get_service_title();
        $data['service_description'] = $this->Service_description_model->get_service_description();
        $data['service_content'] = $this->Service_content_model->get_service_content();
        $data['service_project'] = $this->Service_project_model->get_service_project();
        $data['service_category_project'] = $this->Service_category_project_model->get_service_category_project();
        $data['content_description_projects_we_have_completed'] = $this->Content_description_model->get_content_description('Projects we have completed');
        
        // var_dump($data['service_category_project']);
        // die();
        // $data['service_content'] = $this->Service_content_model->get_service_content();
        // $data['service_detail'] = $this->Service_detail_model->get_service_detail();
        // $data['service_detail_description'] = $this->Service_detail_description_model->get_service_detail_description();
        // $data['service_team'] = $this->Service_team_model->get_service_team();

        $data['title'] = 'Admores - Service';

        $this->load->view('templates/header', $data);
        $this->load->view('service_view/index', $data);
        $this->load->view('templates/footer', $data);
    }
}

