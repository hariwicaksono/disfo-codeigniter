<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_skripsi extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_skripsi(){
		$query=$this->db->select('*')
				->from('skripsi')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_skripsi($id){
		return $this->db->get_where('skripsi',array('id' => $id));
	}
	
}