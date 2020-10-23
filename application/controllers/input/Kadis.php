<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kadis extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_kadis','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Agenda Rapat Kampus";
		$this->vars['display']=$this->vars['kadis']=TRUE;
		$this->vars['data']=$this->m_kadis->get_agenda();
		$this->vars['content']='input/kadis';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function load_new(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Agenda Kepala Dinas';
			return $this->load->view('input/modal_kadis',$this->vars);
		}else{
			redirect('input/kadis');
		}
	}

	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data_kadis']=$this->m_kadis->get_single_agenda($id);
			$this->vars['modal_title']='Agenda Kepala Dinas';
			return $this->load->view('input/modal_kadis',$this->vars);
		}else{
			redirect('input/kadis');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){		
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=$this->security->xss_clean(array(
						'nama_agenda' => $_POST['nama_agenda'],
						'tmp_agenda' => $_POST['tmp_agenda'],
						'tgl_agenda' => $_POST['tgl_agenda'],
						'waktu' => $_POST['waktu']
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'agenda_kadis',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'nama_agenda' => $_POST['nama_agenda'],
						'tmp_agenda' => $_POST['tmp_agenda'],
						'tgl_agenda' => $_POST['tgl_agenda'],
						'waktu' => $_POST['waktu']
					));		
					$hasil=$this->m_curd->add_new('agenda_kadis',$filldata);
				}
				if($hasil){
					$this->vars['type']='alert-success';
					$this->vars['message']='Berhasil Menyimpan';
				}else{
					$this->vars['type']='alert-danger';
					$this->vars['message']='Gagal Menyimpan';				
				}
			}else{
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = validation_errors();					
			}
			$this->vars['title']="Display Agenda Rapat Kampus";
			$this->vars['display']=$this->vars['kadis']=TRUE;
			$this->vars['data']=$this->m_kadis->get_agenda();
			$this->vars['content']='input/kadis';
			$this->load->view('backend/index',$this->vars);
		}else{
			redirect('input/kadis');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('nama_agenda', 'Nama Agenda','trim|required');
		$val->set_rules('tmp_agenda', 'Tempat Agenda','trim|required');
		$val->set_rules('tgl_agenda', 'Tanggal Agenda','trim|required');
		$val->set_rules('waktu', 'Waktu Agenda','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_agenda=(int) $id;
		if($id_agenda && $id_agenda !=0 && ctype_digit((string) $id_agenda)){
			$hasil = $this->m_curd->hapus(array('id' => $id_agenda),'agenda_kadis');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Agenda Rapat Kampus";
			$this->vars['display']=$this->vars['kadis']=TRUE;
			$this->vars['data']=$this->m_kadis->get_agenda();
			$this->vars['content']='input/kadis';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/kadis');
		}
	}
}
