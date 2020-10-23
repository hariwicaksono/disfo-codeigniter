<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_guru(){
		$query=$this->db->select('*')
				->from('guru')
				->order_by('nama_lengkap','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_guru($id){
		return $this->db->get_where('guru',array('id' => $id));
	}
	
	public function is_present($nip,$kode){
		$query = $this->db->get_where('guru',array('nip' => $nip));
		if($query->num_rows()>0){
			//ada guru dengan NIP tersebut
			return TRUE;
		}else{
			$query = $this->db->get_where('guru',array('kode_guru' => $kode));
			if($query->num_rows()>0){
				//ada guru dengan kode tersebut 
				return TRUE;
			}else{
				return false;
			}
		}
	}
}