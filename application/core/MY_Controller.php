<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function check_access($access=null){
        if (!$this->session->logged_in) {
            $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Anda perlu login untuk mengakses halaman ini'));
            redirect('auth');
        }
        
    }
}





