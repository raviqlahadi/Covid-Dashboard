<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->check_access();
        $this->load->library('Breadcrumbs');
        $this->load->model('m_patients');
    }
    
    public function index()
    {
        $data['page_content'] = 'page/dashboard/index';
       
        

        //initialize breadcrumbs 
        $this->breadcrumbs->push('Dashboard', '/dashboard');
        $this->breadcrumbs->unshift('Home', '/');            
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $patient_by_date = $this->m_patients->get_patient_by('date');
        $patient_by_age = $this->m_patients->get_patient_by('age');
        $patient_by_status = $this->m_patients->get_patient_by('status');

        $data['date_string'] = $this->json_for_chart($patient_by_date, 'date');
        $data['patient_string'] = $this->json_for_chart($patient_by_date, 'count');
        $data['total_patient_string'] = $this->accumulation_patient($patient_by_date, 'date');

        $data['cluster_by_age'] = $this->string_cluster_by_age($patient_by_age);
        $data['cluster_by_status'] = $this->string_cluster_by_status($patient_by_status);
       
        $this->load->view('index', $data);
    }

    private function json_for_chart($patient_by_date, $arr_key){
        $arr = array();
        foreach ($patient_by_date as $key => $value) {
            array_push($arr, $value->{$arr_key});
        }
        return json_encode($arr);
    }

    private function accumulation_patient($patient_by_date)
    {
        $arr = array();
        $accumulation = 0;
        foreach ($patient_by_date as $key => $value) {
            $accumulation = $accumulation + $value->count;
            array_push($arr, $accumulation);
        }
        return json_encode($arr);
    }

    private function string_cluster_by_age($data){
        $child = 0;
        $teen = 0;
        $old = 0;
        foreach ($data as $key => $value) {
            if($value->age < 17){
                $child = $child + $value->count;
            }elseif($value->age >= 17 && $value->age < 40){
                $teen = $teen + $value->count;
            }else{
                $old = $old + $value->count;
            }
        }
        return json_encode(array($child,$teen,$old));
    }

    private function string_cluster_by_status($data)
    {
        $cured = 0;
        $incare = 0;
        $dead = 0;
        foreach ($data as $key => $value) {
            if ($value->status == 'Sembuh' ) {
                $cured = $cured + $value->count;
            } elseif ($value->status == 'Dirawat') {
                $incare = $incare + $value->count;
            } else {
                $dead = $dead + $value->count;
            }
        }
        return json_encode(array($cured, $incare, $dead));
    }

}
    
    /* End of file Home.php */
