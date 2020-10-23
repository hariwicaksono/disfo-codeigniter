<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_kelas(){
		$query=$this->db->select('*')
				->from('kelas')
				->order_by('nm_kelas','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_kelas($id){
		return $this->db->get_where('kelas',array('id' => $id));
	}
	
}