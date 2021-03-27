<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_patients extends MY_Model{

    function __construct() {
        parent::__construct();
        parent::table('patients','id');
        
    }

    private $table = 'patients';
    private $id = 'id';

    public function fetch($data, $count=false, $compiled=false){
      return $this->new_fetch_db($data, $count, $compiled);
    }

    public function get(){
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function get_patient_by($key){
      $this->db->select(array($key,'COUNT(*) as count'));
      $this->db->from($this->table);
      $this->db->group_by($key);
      $query = $this->db->get();
      return $query->result();
    }

    public function get_recap(){
        $query = $this->db->query("SELECT date, COUNT(*) as total, SUM(if(status = 'Dirawat', 1, 0)) AS dirawat, 
        SUM(if(status = 'Meninggal', 1, 0)) AS meninggal, SUM(if(status = 'Sembuh', 1, 0)) AS sembuh
        FROM patients GROUP BY date ORDER BY date DESC");
        return $query->result();

    }

    public function getWhere($data){
      $query = ($this->db->where($data)->get($this->table));
      return $query->result();
    }

    public function get_total(){
      return $this->db->count_all($this->table);
    }

    public function add($data){
      $this->db->insert($this->table,$data);
      return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update($id, $data){
      //run Query to update data
      if(isset($data[$this->id]))unset($data[$this->id]);
      $query = $this->db->where('id', $id)->update(
        $this->table, $data
      );
      return ($this->db->affected_rows() != 1) ? false : true;

    }

    public function delete($data){

      $this->db->delete($this->table, $data);
      return ($this->db->affected_rows() != 1) ? false : true;
    }

    
    public function last(){
      return $last_row = $this->db->select('*')->order_by('id', "desc")->limit(1)->get($this->table)->row();
    }

    


}
