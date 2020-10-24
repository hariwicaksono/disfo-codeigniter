<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_news extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_news(){
		$query=$this->db->select('*')
				->from('news')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	
	public function get_single_news($id){
		return $this->db->get_where('news',array('id' => $id));
	}
	
	public function str_news(){
		$query=$this->db->select('*')
				->from('news')
				->order_by('id','DESC')
				->get();
		$news_array=array();
		if($query->num_rows()>0){
			foreach($query->result() as $news){
				array_push($news_array,$news->txt_news);
			}
		}
		array_push($news_array,"News");
		array_push($news_array,"localhost");
		$hasil = implode("&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;",$news_array);
		
		return $hasil;
	}	
}