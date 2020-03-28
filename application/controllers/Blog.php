<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model([
            'Blog_model', 'Blog_title_model', 'Home_blog_model'
        ]);
        
        $this->load->helper('url_helper');
        $this->load->library('pagination');

    }

    public function index($page = NULL)
    {
        $data['blog_title'] = $this->Blog_title_model->get_blog_title();
     
        
        $config['base_url'] = base_url().'blog/'; //site url
        $config['total_rows'] = $this->Home_blog_model->count_data(); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        $data['blog_post'] = $this->Home_blog_model->get_home_blog($config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Admores - Blog';

        $this->load->view('templates/header', $data);
        $this->load->view('blog_view/index', $data);
        $this->load->view('templates/footer', $data);
    }
}

