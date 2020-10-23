<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_tema extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_tema(){
		$query=$this->db->select('*')
				->from('tema')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	public function get_single_tema($id){
		return $this->db->get_where('tema',array('id' => $id));
	}	
}