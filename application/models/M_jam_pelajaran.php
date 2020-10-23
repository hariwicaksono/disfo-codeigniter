<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_jam_pelajaran extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_jam(){
		$query=$this->db->select('*')
				->from('jam_pelajaran')
				->order_by('jam_ke','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_jam($id){
		return $this->db->get_where('jam_pelajaran',array('id' => $id));
	}
	
	public function get_hari_belajar($id_jam_pelajaran){
		return $this->db->get_where('hari_belajar',array('id_jam_pelajaran' => $id_jam_pelajaran));
	}	
}