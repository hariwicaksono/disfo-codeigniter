<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_solat extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_solat($id_bulan){
		$query=$this->db->select('*')
				->from('jadwal_solat')
				->where('id_bulan',$id_bulan)
				->order_by('tanggal','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_solat($kriteria=array()){
		return $this->db->get_where('jadwal_solat',$kriteria);
	}
		
}