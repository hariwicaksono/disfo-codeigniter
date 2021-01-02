<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model {


	public function __construct() {
		parent::__construct();
	}

	public function add_new($table,$data){
		return $this->db->insert($table,$data);
	}
	
	public function hapus($kriteria=array(),$table){
		return $this->db->delete($table, $kriteria); 		
	}
	public function update($kriteria=array(),$table,$data=array()){
		$this->db->where($kriteria);
		return $this->db->update($table,$data);
	}
	public function insert_excel($table,$data)
	{
		$this->db->db_debug = false;
		$this->db->insert_batch($table, $data);
		return $this->db->affected_rows();
	}
	
	
}