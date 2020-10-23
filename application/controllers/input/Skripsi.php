<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_skripsi','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Jadwal Skripsi";
		$this->vars['display']=$this->vars['skripsi']=TRUE;
		$this->vars['data']=$this->m_skripsi->get_skripsi();
		$this->vars['content']='input/skripsi';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Jadwal Skripsi';
			return $this->load->view('input/modal_skripsi',$this->vars);
		}else{
			redirect('input/skripsi');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_skripsi->get_single_skripsi($id);
			$this->vars['modal_title']='Jadwal Skripsi';
			return $this->load->view('input/modal_skripsi',$this->vars);
		}else{
			redirect('input/skripsi');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=$this->security->xss_clean(array(
						'npm' => $_POST['npm'],
						'nama_mhs' => $_POST['nama_mhs'],
						'tgl_skripsi' => $_POST['tgl_skripsi'],
						'txt_skripsi' => $_POST['txt_skripsi'],
						'ruang' => $_POST['ruang'],
						'waktu' => $_POST['waktu']
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'skripsi',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'npm' => $_POST['npm'],
						'nama_mhs' => $_POST['nama_mhs'],
						'tgl_skripsi' => $_POST['tgl_skripsi'],
						'txt_skripsi' => $_POST['txt_skripsi'],
						'ruang' => $_POST['ruang'],
						'waktu' => $_POST['waktu']
					));
					$hasil=$this->m_curd->add_new('skripsi',$filldata);
				}
				if($hasil){
					$this->vars['type']='alert-success';
					$this->vars['message']='Berhasil Menyimpan';
				}else{
					$this->vars['type']='alert-danger';
					$this->vars['message']='Gagal Menyimpan';				
				}
			}else{
				$this->vars['type'] = 'error';
				$this->vars['message'] = validation_errors();					
			}
			$this->vars['title']="Display Jadwal Skripsi";
			$this->vars['display']=$this->vars['skripsi']=TRUE;
			$this->vars['data']=$this->m_skripsi->get_skripsi();
			$this->vars['content']='input/skripsi';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/skripsi');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('txt_skripsi', 'Skripsi Text','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_skripsi=(int) $id;
		if($id_skripsi && $id_skripsi !=0 && ctype_digit((string) $id_skripsi)){
			$hasil = $this->m_curd->hapus(array('id' => $id_skripsi),'skripsi');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Jadwal Skripsi";
			$this->vars['display']=$this->vars['skripsi']=TRUE;
			$this->vars['data']=$this->m_skripsi->get_skripsi();
			$this->vars['content']='input/skripsi';
			$this->load->view('backend/index',$this->vars);				
		}else{
			redirect('input/skripsi');
		}
	}
}
