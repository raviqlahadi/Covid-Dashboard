<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends MY_Controller
{
    private $url = 'patient';
    private $status = [
        ["id" => "Dirawat", "name" => "Dirawat"],
        ["id" => "Sembuh", "name" => "Sembuh"],
        ["id" => "Meninggal", "name" => "Meninggal"],
    ];
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->check_access();

        $this->load->library('form_template');
        $this->load->library('table_template');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('breadcrumbs');
        
        $this->load->model('m_patients');
        
        
    }
    
    public function index()
    {


        //page config
        $limit = $this->input->get('limit');
        $limit_per_page = ($limit != null && $limit != '') ? $limit : 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $start_record = $page * $limit_per_page;        
        
        // table props, change this base on table props
        $data['table_head'] = array(
            'date' => 'Tanggal',
            'patient_number' => 'Nomor Pasien',
            'age' => 'Usia',
            'status' => 'Status'
        );

        
        if($this->input->get('status')!=null){
            $status =  $this->input->get('status');
            $data['form_value']['status'] = $status;
        }else{
            $status = false;
        }

        if ($this->input->get('age') != null) {
            $age =  $this->input->get('age');
            if($age<=0){
                $data['form_error']['age'] = 'Umur Pasien Tidak Boleh Kosong Atau Dibawah Angka 0';
                $age = false;
            }else{
                $data['form_value']['age'] = $age;
            }
        } else {
            $age = false;
        }

        if ($this->input->get('date_start') != null) {
            $date_start =  $this->input->get('date_start');
            $data['form_value']['date_start'] = $date_start;
        } else {
            $date_start = false;
        }

        if ($this->input->get('date_end') != null) {
            $date_end =  $this->input->get('date_end');
            $data['form_value']['date_end'] = $date_end;
        } else {
            $date_end = false;
        }

        if($date_start!=false && $date_end!=false){
            $date1 = strtotime($date_start);
            $date2 = strtotime($date_end);
            $diff = round(($date2 - $date1) / (60 * 60 * 24), 0);
            if($diff<0){
                $date_start = false;
                $date_end = false;
                $data['form_error']['date'] = 'Tanggal Akhir lebih kecil dari tanggal mulai';
            }
        }
    
       
        $fetch['select'] = array('id','date', 'patient_number','status','age');
        $fetch['start'] = $start_record;
        $fetch['limit'] = $limit_per_page;
        if ($date_start != false && $date_end != false) {
            $fetch['where'] = array("date >= '" . $date_start . "' AND date <='" . $date_end . "'");
        }elseif($date_start != false && $date_end==false){
            $fetch['where'] = array("date >='" . $date_start . "'");
        }elseif($date_start == false && $date_end!=false){
            $fetch['where'] = array("date <='". $date_end . "'");            
        }else{
            $fetch['where'] = array();
        }

        if ($status != false) {
            array_push($fetch['where'], array('status' => $status));
            
        }

        if ($age != false) {
            array_push($fetch['where'], array('age' => $age));
            
        }

        $fetch['order'] = array(
            "field" => "date",
            "type" => "DESC"
        );
        $data['table_content'] = $this->m_patients->fetch($fetch);
        $total_records = $this->m_patients->fetch($fetch,true);

        //pagination config
        $pagination['base_url'] = site_url($this->url) . '/index';
        $pagination['limit_per_page'] = $limit_per_page;
        $pagination['start_record'] = $start_record;
        $pagination['uri_segment'] = 3;
        $pagination['total_records'] =  $total_records;
        $data['pagination'] = false;
        if ($pagination['total_records'] > 0){
            $config = $this->table_template->set_pagination($pagination);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        }


        //breadcrumbs config
        $this->breadcrumbs->push('Patient', '/patient');
        $this->breadcrumbs->unshift('Admin', '/');


        //page properties        
        $data['status_select'] = $this->status;
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['page_title'] = '<strong>Patient</strong> Management';
        $data['table_start_number'] = $start_record;
        $data['page_content'] = 'page/patient/index';
        $data['page_current'] = 'page/patient';
        $data['page_url'] = site_url($this->url);

        $this->load->view('index', $data);
    }

    
    public function create()
    {
        
        //breadcrumbs config
        $this->breadcrumbs->push('Patient', '/patient');
        $this->breadcrumbs->push('Create', '/create');
        $this->breadcrumbs->unshift('Admin', '/');

        //page props
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['page_title'] = '<strong>Add New</strong> Patient';
        $data['page_content'] = 'page/patient/create';
        $data['page_current'] = 'page/patient';

        //form props
        $data['form_title'] = "<strong>Add new</strong> Patient";
        $data['form_action'] = site_url($this->url.'/create');

        //select option
        $data['status_select'] = $this->status;
        $data['form_value']['patient_number'] = "No_".sprintf("%04d", $this->get_patient_number()) ; 

        if ($_POST) {
            $this->form_validation_rules();
            if ($this->form_validation->run() == FALSE) {
                $data['form_value'] = $this->input->post();
                $data['validation_error'] =  validation_errors();
            } else {
                $post_data = $this->input->post();               
               
                $this->add($post_data);                
            }
        }

        $data['page_url'] = site_url($this->url);
        $this->load->view('index', $data);
    }

    private function get_patient_number(){
        $last = $this->m_patients->last();
        if($last==null) return 1;
        return $last->id+1; 
    }

    

    public function add($post_data)
    {
        $post_data['patient_number'] =  "No_".sprintf("%04d", $this->get_patient_number());
        $insert = $this->m_patients->add($post_data);
        if ($insert) {
            $this->session->set_flashdata('alert', $this->alert->set_alert('info', 'Data berhasil di masukan ke database'));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Data gagal di masukan ke database'));
        }
        redirect($this->url);
    }

    public function edit($id)
    {
        //checkk if id is exist
        if ($id == null) {
            $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Anda perlu memilih data yang akan di edit'));
            redirect($this->url);
        }

        //breadcrumbs config
        $this->breadcrumbs->push('Patient', '/patient');
        $this->breadcrumbs->push('Edit', '/edit');
        $this->breadcrumbs->unshift('Admin', '/');

        //page props
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['page_title'] = '<strong>Edit</strong> Patient';
        $data['page_content'] = 'page/patient/edit';
        $data['page_current'] = 'page/patient';

        //form props
        $data['form_title'] = "<strong>Edit</strong> Patient";
        $data['form_action'] = site_url($this->url . '/edit/'.$id);
        $data['edit'] = true;

        //select option
        $data['status_select'] = $this->status;

        //get current data
        $current_data = $this->m_patients->getWhere(array('id'=>$id));
        if(count($current_data)==0){
            $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Data yang akan diedit tidak ditemukan di database'));
            redirect($this->url);
        }else{
            $data['form_value'] = (array) $current_data[0];
        }

        if ($_POST) {
            $this->form_validation_rules(TRUE);
            if ($this->form_validation->run() == FALSE) {
                $data['form_value'] = $this->input->post();
                $data['validation_error'] =  $this->alert->set_alert('warning', validation_errors());
            } else {
                $post_data = $this->input->post();
                $this->update($id, $post_data);
            }
        }

        $data['page_url'] = site_url($this->url);
        $this->load->view('index',$data);
    }

    public function update($id, $post_data)
    {
        $update = $this->m_patients->update($id, $post_data);
        if ($update) {
            $this->session->set_flashdata('alert', $this->alert->set_alert('info', 'Data berhasil di update ke database'));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Data gagal di update ke database'));
        }
        //redirect($this->url);
    }

    public function delete($id=null)
    {
        if($id!=null){
            $where_id['id'] = $id;
            if($this->m_patients->delete($where_id)){
                $this->session->set_flashdata('alert', $this->alert->set_alert('info', 'Data berhasil di hapus'));
            }else{
                $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Data tidak ditemukan'));
            }
        }else{
            $this->session->set_flashdata('alert', $this->alert->set_alert('danger', 'Anda perlu memilih data yang akan di hapus'));
        }
        redirect($this->url);    
    }

    public function form_validation_rules()
    {

        $this->form_validation->set_rules('patient_number', 'Nomor Pasien', 'required|min_length[5]',
            array('required'=>'Anda Perlu Mengisi Nomor Pasien'));
        $this->form_validation->set_rules('date', 'Tanggal', 'required', 
            array('required'=>'Anda Perlu Memilih Tanggal'));
        $this->form_validation->set_rules('age', 'Umur', 'required|integer|greater_than_equal_to[1]', 
            array('required'=>'Anda Perlu Memasukan Umur Pasien',
                'greater_than_equal_to' => 'Umur Pasien Tidak Boleh Kosong Atau Dibawah Angka 0'));
        $this->form_validation->set_rules('status', 'Status', 'required', 
            array('required'=>'Anda Perlu Memilih Status Pasien'));
       
       
    }

 //function for adding dummy data
    // public function random_add(){
    //     $status = ['Dirawat','Sembuh','Meninggal'];
    //     $total_data =0;
    //     for ($i=1; $i <= 31; $i++) { 
    //         // $date_ran = rand(1, 31);
    //         if($i<10){
    //             $date_ran = sprintf("%01d", $i);
    //         }else{
    //             $date_ran = $i;
    //         }
    //         $post_data['date'] = "2021-03-".$date_ran;
    //         $ran_patient = rand(5,50);
    //         for ($j=0; $j < $ran_patient; $j++) {
    //             $age_ran = rand(8, 70);
    //             $post_data['age'] = $age_ran;

    //             $status_ran = rand(0, 2);
    //             $post_data['status'] = $status[$status_ran];


    //             $this->add($post_data);   
    //             $total_data++;
    //         }  
    //     }
    //     echo "total data yang masuk: ".$total_data;
    // }

    //to decrease dead patient 
    // public function update_dead(){
    //     $data = $this->m_patients->get();
    //     $count = 0;

    //     foreach ($data as $key => $value) {
    //         if($value->status== 'Meninggal'){
    //             if($count % 2 ==0 ){
    //                 $update['status'] = 'Sembuh';
    //                 $this->update($value->id, $update);
                   
    //             }
    //             $count++;
    //         }
    //     }
    //     echo "done";
    // }


}
    
    /* End of file Patients.php */
    
   
    

?>