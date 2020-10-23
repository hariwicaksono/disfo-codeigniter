<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_kadis extends CI_Model {

	public function __construct() {
		parent::__construct(); 
	}
	
	public function get_agenda(){
		$query=$this->db->select('*')
				->from('agenda_kadis')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	public function get_single_agenda($id){
		return $this->db->get_where('agenda_kadis',array('id' => $id));
	}	
}