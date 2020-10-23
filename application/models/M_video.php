<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_video extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_video(){
		$query=$this->db->select('*')
				->from('video')
				->order_by('upload_time','DESC')
				->get();
		
		return $query;
	}
	
	public function get_single_video($id){
		return $this->db->get_where('video',array('id' => $id));
	}

	public function get_aktif_video(){
		$query=$this->db->select('*')
				->from('video')
				->where('status',1)
				->order_by('upload_time','DESC')
				->get();
		
		return $query;
	}
	public function get_aktif_video2(){
		$query=$this->db->select('*')
				->from('video')
				->where('status',1)
				->order_by('upload_time','DESC')
				->get();
		$hasil=array();
		if($query->num_rows()>0){
			foreach($query->result() as $video){
				$alamat=base_url("uploads/video/".$video->nm_file);
				array_push($hasil,array($alamat));
			}
		}
		
		return $hasil;
	}		
}