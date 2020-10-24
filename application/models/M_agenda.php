<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_agenda extends CI_Model {

	public function __construct() { 
		parent::__construct();
	}
	
	public function get_agenda(){
		$query=$this->db->select('*')
				->from('agenda_instansi')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	public function get_single_agenda($id){
		return $this->db->get_where('agenda_instansi',array('id' => $id));
	}	

	public function agenda_bulan($bulan){
		$query = $this->db->query("select * from agenda_instansi where MONTH(tgl_agenda)='$bulan' ORDER BY tgl_agenda DESC");
		return $query;
	}
}