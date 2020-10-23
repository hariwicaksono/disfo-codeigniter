<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_jadwal($kriteria=array()){
		$query = $this->db->select('*')
				->from('jadwal_pelajaran')
				->where($kriteria)
				->order_by('id_kelas','ASC')
				->get();
		return $query;
	}
	
	public function guru_mengajar($jam_ke,$hari){
		$query = $this->db->select('jd.id_kelas, jd.kode_guru, jd.jam_ke, k.nm_kelas, g.nama_lengkap, g.nip, g.tmp_lahir, g.tgl_lahir, g.foto, g.ket')
				->from('jadwal_pelajaran as jd')
				->join('kelas as k','jd.id_kelas=k.id')
				->join('guru as g','jd.kode_guru=g.kode_guru')
				->where('jd.jam_ke',$jam_ke)
				->where('jd.hari',$hari)
				->order_by('jd.id','ASC')
				->get();
		return $query;
	}
}