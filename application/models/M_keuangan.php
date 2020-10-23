<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model {


	public function __construct() {
		parent::__construct();
	}
	
	public function keuangan_masjid(){
		$query = $this->db->select('*')
				->from('keuangan_masjid')
				->order_by('tanggal','ASC')
				->get();
		return $query;
	}
	public function save(){
		$jenis = $this->input->post('jenis');
		$nominal =$this->input->post('jumlah');
		$pemasukan=0;
		$pengeluaran=0;
		
		if($jenis==1){
			$pemasukan =$nominal;
		}
		if($jenis==2){
			$pengeluaran=$nominal;
		}
		
		$data=$this->security->xss_clean(array(
			'tanggal' => $this->input->post('tanggal'),
			'uraian' => $this->input->post('uraian'),
			'jenis' => $this->input->post('jenis'),
			'pemasukan' => $pemasukan,
			'pengeluaran' => $pengeluaran
		));
		$this->db->insert('keuangan_masjid',$data);
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
		$jenis = $this->input->post('jenis');
		$nominal =$this->input->post('jumlah');
		$pemasukan=0;
		$pengeluaran=0;
		
		if($jenis==1){
			$pemasukan =$nominal;
		}
		if($jenis==2){
			$pengeluaran=$nominal;
		}
		
		$data=$this->security->xss_clean(array(
			'tanggal' => $this->input->post('tanggal'),
			'uraian' => $this->input->post('uraian'),
			'jenis' => $this->input->post('jenis'),
			'pemasukan' => $pemasukan,
			'pengeluaran' => $pengeluaran
		));
		
		$this->db->where($key,$value);
		$this->db->update('keuangan_masjid',$data);
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
	
	public function get_keuangan($key,$value){
		$query = $this->db->select('*')
				->from('keuangan_masjid')
				->where($key,$value)
				->get();
				
		return $query;
	}
	
	public function hapus($key,$value){
		$query=$this->db->delete('keuangan_masjid', array($key => $value)); 	
		if($query){
			$response['type'] ='success';
			$response['message'] ='Data berhasil dihapus!';
		}else{
			$response['type'] ='error';
			$response['message'] ='Data gagal dihapus!';			
		}
		return $response;
	}
	
	public function nominal_pemasukan($bulan){
		$query=$this->db->query("select SUM(pemasukan) as pemasukan from keuangan_masjid where MONTH(tanggal)='$bulan'");
		return number_format($query->row()->pemasukan,0,"",".");
	}
	
	public function nominal_pengeluaran($bulan){
		$query=$this->db->query("select SUM(pengeluaran) as pengeluaran from keuangan_masjid where MONTH(tanggal)='$bulan'");
		return number_format($query->row()->pengeluaran,0,"",".");
	}	
	
	public function get_transaksi($bulan){
		$query=$this->db->query("select * from keuangan_masjid where MONTH(tanggal)='$bulan' ORDER BY tanggal DESC");
		return $query;		
	}
}