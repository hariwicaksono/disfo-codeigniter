<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_event extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_event(){
		$query=$this->db->select('*')
				->from('event')
				->order_by('id','DESC')
				->get();
		
		return $query;
	}
	public function get_event_bulan(){
		$query=$this->db->select('*')
				->from('event_bulan')
				->order_by('id','DESC')
				->get();
		
		return $query;
	}	
	
	public function get_single_event($id){
		return $this->db->get_where('event',array('id' => $id));
	}
	
	public function get_single_event_bulan($id){
		return $this->db->get_where('event_bulan',array('id' => $id));
	}	
	public function get_event_bulan_ini(){
		$hasil['nama_event']="";
		$hasil['tgl_event']="";
		$hasil['tmp_event']="";
		$hasil['waktu_event']="";
		$bulan=date("n");
		$sql="select * from event_bulan where MONTH(tgl_event)='$bulan' AND status='1' LIMIT 1";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$event=$query->row();
			$date=strtotime($event->tgl_event);
			$hasil['nama_event']=$event->nama_event;
			$hasil['tgl_event']=hari(date("D", $date)) . ", " .date("d",$date) . " " . str_bulan(date("n",$date)) . " " . date("Y",$date);
			$hasil['tmp_event']=$event->tmp_event;
			$hasil['waktu_event']=$event->waktu;
		}
		return $hasil;
	}	

	public function get_event_bulan_ini_slide(){
		$bulan=date("n");
		$sql="select * from event_bulan where MONTH(tgl_event)='$bulan' AND status='1' ORDER BY id DESC";
		$query=$this->db->query($sql);
		return $query;
	}		
}