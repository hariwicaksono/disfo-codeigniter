<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hari_belajar extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_jam_pelajaran','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Setup Hari Belajar";
		$this->vars['display']=$this->vars['hari_belajar']=TRUE;
		$this->vars['data']=$this->m_jam_pelajaran->get_jam();
		$this->vars['content']='input/hari_belajar';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id_jam_pelajaran=$_POST['id'];
			$this->vars['id_jam_pelajaran_x']=$id_jam_pelajaran;
			$this->vars['jam_pelajaran']=$this->m_jam_pelajaran->get_single_jam($id_jam_pelajaran);
			$this->vars['data']=$this->m_jam_pelajaran->get_hari_belajar($id_jam_pelajaran);
			$this->vars['modal_title']='Kegiatan';
			return $this->load->view('input/modal_hari_belajar',$this->vars);
		}else{
			redirect('input/hari_belajar');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(isset($_POST['id'])){
				//edit
				$id=$_POST['id']; 
				$filldata=$this->security->xss_clean(array(
					'senin' => $_POST['senin'],
					'selasa' => $_POST['selasa'],
					'rabu' => $_POST['rabu'],
					'kamis' => $_POST['kamis'],
					'jumat' => $_POST['jumat'],
					'sabtu' => $_POST['sabtu']
				));					
				$hasil=$this->m_curd->update(array('id' => $id),'hari_belajar',$filldata);
			}else{
				//new 
				$filldata=$this->security->xss_clean(array(
					'id_jam_pelajaran' => $_POST['id_jam_pelajaran'],
					'senin' => $_POST['senin'],
					'selasa' => $_POST['selasa'],
					'rabu' => $_POST['rabu'],
					'kamis' => $_POST['kamis'],
					'jumat' => $_POST['jumat'],
					'sabtu' => $_POST['sabtu']
				));
				$hasil=$this->m_curd->add_new('hari_belajar',$filldata);
			}
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menyimpan';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menyimpan';				
			}
			$this->vars['title']="Setup Hari Belajar";
			$this->vars['display']=$this->vars['hari_belajar']=TRUE;
			$this->vars['data']=$this->m_jam_pelajaran->get_jam();
			$this->vars['content']='input/hari_belajar';
			$this->load->view('backend/index',$this->vars);		
		}else{
			redirect('input/hari_belajar');
		}		
	}
}
