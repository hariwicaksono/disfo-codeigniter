<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_masjid extends CI_Model {


	public function __construct() {
		parent::__construct();
	}
	
	public function jumatan(){
		$query = $this->db->select('*')
				->from('jumatan')
				->order_by('tanggal','DESC')
				->get();
		
		return $query;
	}
	public function save(){
		$data=$this->security->xss_clean(array(
			'tanggal' => $this->input->post('tanggal'),
			'imam' => $this->input->post('imam'),
			'khotib' => $this->input->post('khotib'),
			'muazin' => $this->input->post('muazin'),
			'judul_khotbah' => $this->input->post('judul_khotbah')
		));
		$this->db->insert('jumatan',$data);
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
			'tanggal' => $this->input->post('tanggal'),
			'imam' => $this->input->post('imam'),
			'khotib' => $this->input->post('khotib'),
			'muazin' => $this->input->post('muazin'),
			'judul_khotbah' => $this->input->post('judul_khotbah')
		));
		$this->db->where($key,$value);
		$this->db->update('jumatan',$data);
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
	public function aktifkan_jumatan($key,$value){
		$this->db->update('jumatan',array('status' => 0));

		$this->db->where($key,$value);
		$this->db->update('jumatan',array('status' => 1));
		$hasil=$this->db->affected_rows();
		if($hasil >0){
			$response['type'] ='success';
			$response['message'] ='Data berhasil diaktifkan!';
		}else{
			$response['type'] ='error';
			$response['message'] ='Data gagal diaktifkan!';			
		}
		return $response;
	}		
	public function get_jumatan($key,$value){
		$query = $this->db->select('*')
				->from('jumatan')
				->where($key,$value)
				->get();
				
		return $query;
	}
	
	public function hapus($key,$value){
		$query=$this->db->delete('jumatan', array($key => $value)); 	
		if($query){
			$response['type'] ='success';
			$response['message'] ='Data berhasil dihapus!';
		}else{
			$response['type'] ='error';
			$response['message'] ='Data gagal dihapus!';			
		}
		return $response;
	}
	
}