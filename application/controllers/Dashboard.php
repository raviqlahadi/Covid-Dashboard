<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->check_access();
        $this->load->library('Breadcrumbs');
    }
    
    public function index()
    {
        $data['page_content'] = 'page/dashboard/index';

        //initialize breadcrumbs 
        $this->breadcrumbs->push('Dashboard', '/dashboard');
        $this->breadcrumbs->unshift('Home', '/');            
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $this->load->view('index', $data);
    }

    public function page()
    {
        $data['page_content'] = 'page/dashboard/index';

        //initialize breadcrumbs 
        $this->breadcrumbs->push('Dashboard', '/dashboard');
        $this->breadcrumbs->push('Page', '/page');
        $this->breadcrumbs->unshift('Admin', '/');
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $this->load->view('index', $data);
    }

}
    
    /* End of file Home.php */
