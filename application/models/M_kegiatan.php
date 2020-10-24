<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_kegiatan extends CI_Model {


	public function __construct() {
		parent::__construct();
	}
	
	public function kegiatan_masjid(){
		$query = $this->db->select('*')
				->from('kegiatan_masjid')
				->order_by('tgl_kegiatan','DESC')
				->get();
		 
		return $query;
	}
	public function save(){
		$data=$this->security->xss_clean(array(
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
			'deskripsi_kegiatan' => $this->input->post('deskripsi_kegiatan'),
			'tmp_kegiatan' => $this->input->post('tmp_kegiatan'),
			'tgl_kegiatan' => $this->input->post('tgl_kegiatan'),
			'waktu' => $this->input->post('waktu')
		));
		$this->db->insert('kegiatan_masjid',$data);
		$hasil=$this->db->affected_rows();
		if($hasil >0){
			$response['type'] ='success';
			$response['message'] ='Data berhasil disimpan!';
		}else{
			$response['type'] ='error';
			$response['message'] ='Data gagal disimpan!';			
		}
		return $response;
	}
	
	public function edit($key,$value){
		$data=$this->security->xss_clean(array(
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
			'deskripsi_kegiatan' => $this->input->post('deskripsi_kegiatan'),
			'tmp_kegiatan' => $this->input->post('tmp_kegiatan'),
			'tgl_kegiatan' => $this->input->post('tgl_kegiatan'),
			'waktu' => $this->input->post('waktu')
		));
		$this->db->where($key,$value);
		$this->db->update('kegiatan_masjid',$data);
		$hasil=$this->db->affected_rows();
		if($hasil >0){
			$response['type'] ='success';
			$response['message'] ='Data berhasil disimpan!';
		}else{
			$response['type'] ='error';
			$response['message'] ='Data gagal disimpan!';			
		}
		return $response;
	}	
	
	public function get_kegiatan($key,$value){
		$query = $this->db->select('*')
				->from('kegiatan_masjid')
				->where($key,$value)
				->get();
				
		return $query;
	}
	
	public function hapus($key,$value){
		$query=$this->db->delete('kegiatan_masjid', array($key => $value)); 	
		if($query){
			$response['type'] ='success';
			$response['message'] ='Data berhasil dihapus!';
		}else{
			$response['type'] ='error';
			$response['message'] ='Data gagal dihapus!';			
		}
		return $response;
	}

	public function kegiatan_masjid_bulan($bulan){
		$query = $this->db->query("select * from kegiatan_masjid where MONTH(tgl_kegiatan)='$bulan' ORDER BY tgl_kegiatan DESC");
		return $query;
	}	
}