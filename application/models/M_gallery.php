<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_gallery extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_images(){
		$query=$this->db->select('*')
				->from('gallery')
				->order_by('id','DESC')
				->get();
		
		return $query;
	}
	
	public function get_single_image($id){
		return $this->db->get_where('gallery',array('id' => $id));
	}

	public function get_aktif_images(){
		$query=$this->db->select('*')
				->from('gallery')
				->where('status',1)
				->order_by('id','DESC')
				->get();
		
		return $query;
	}
}