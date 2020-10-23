<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_pelajaran extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_jadwal','m_curd','m_kelas','m_jam_pelajaran','m_guru']);
		
	}
	public function show()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['title']="Setup Jadwal Pelajaran Hari " . ucwords($_POST['hari']);
			$this->vars['display']=$this->vars['jadwal_pelajaran']=TRUE;
			$this->vars['jampel']=$this->m_jam_pelajaran->get_jam();
			$this->vars['rombel']=$this->m_kelas->get_kelas();
			$this->vars['str_hari']=$_POST['hari'];
			$this->vars['content']='input/jadwal_pelajaran';
			$this->load->view('backend/index',$this->vars);
		}else{
			redirect('dashboard');
		}
	}
	
	public function load_hari(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return $this->load->view('input/modal_hari');
		}else{
			redirect('dashboard');
		}
	}	
	
	public function load_isi(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Jadwal Mengajar Hari ' . ucwords($_POST['hari']) . ' Jam Ke ' .$_POST['jam_ke'];
			$this->vars['hari']=$_POST['hari'];
			$this->vars['jam_ke']=$_POST['jam_ke'];
			$this->vars['data_kelas'] =$this->m_kelas->get_kelas();
			$this->vars['data_guru']=$this->m_guru->get_guru();
			//$this->vars['data_jadwal'] = $this->m_jadwal->get_jadwal(array('jam_ke' => $_POST['jam_ke'], 'hari' => $_POST['hari']));
			return $this->load->view('input/modal_jadwal',$this->vars);
		}else{
			redirect('dashboard');
		}
	}	
	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hari=$_POST['hari'];
			$jam_ke=$_POST['jam_ke'];
			$id_kelas=$_POST['id_kelas'];
			$kode_guru=$_POST['kode_guru'];			
			if($this->validation()){
				$arrlen=count($id_kelas);
				for($i=0; $i<$arrlen; $i++){
					$filldata=array('id_kelas' => $id_kelas[$i], 'kode_guru' => $kode_guru[$i], 'hari' => $hari, 'jam_ke' =>$jam_ke);
					$query=$this->m_jadwal->get_jadwal(array('id_kelas' => $id_kelas[$i], 'hari' => $hari, 'jam_ke' =>$jam_ke));
					if($query->num_rows()>0){
						//edit
						$hasil=$this->m_curd->update(array('id_kelas' => $id_kelas[$i], 'hari' => $hari, 'jam_ke' =>$jam_ke),'jadwal_pelajaran',$filldata);
					}else{
						//addnew
						$hasil =$this->m_curd->add_new('jadwal_pelajaran',$filldata);
					}
				}
				$this->vars['type'] = 'alert-success';
				$this->vars['message'] = 'Berhasil Disimpan';					
			}else{
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = validation_errors();				
			}
			$this->vars['title']="Setup Jadwal Pelajaran Hari " . ucwords($hari);
			$this->vars['display']=$this->vars['jadwal_pelajaran']=TRUE;
			$this->vars['jampel']=$this->m_jam_pelajaran->get_jam();
			$this->vars['rombel']=$this->m_kelas->get_kelas();
			$this->vars['str_hari']=$hari;
			$this->vars['content']='input/jadwal_pelajaran';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('dashboard');
		}
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('kode_guru[]', 'Kode Guru','trim|required|numeric|callback_kodeguru_check');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}
	Public function kodeguru_check($input_kode_guru){
		$hasil=$this->db->get_where('guru',array('kode_guru' => $input_kode_guru));
		if($hasil->num_rows()<=0){
			$this->form_validation->set_message('kodeguru_check', "Kode guru $input_kode_guru Tidak ada!");
			return FALSE;
		}
		return TRUE;		
	}		
}
