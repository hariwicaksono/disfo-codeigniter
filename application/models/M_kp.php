<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_kp extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_kp(){
		$query=$this->db->select('*')
				->from('kp')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_kp($id){
		return $this->db->get_where('kp',array('id' => $id));
	}
		
}