<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_settings extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function settings(){
		return $this->db->get('settings');
	}
	
	Public function get_settings($get_by,$value){
		$query=$this->db->select('*')
				->from('settings')
				->where($get_by,$value)
				->get();
		return $query;
	}	
}