<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_kelas','m_curd']);
		
	}
	
	public function index()
	{
		$this->vars['title']="Data Kelas";
		$this->vars['master']=$this->vars['kelas']=TRUE;
		$this->vars['data']=$this->m_kelas->get_kelas();
		$this->vars['content']='master/kelas';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Add New';
			return $this->load->view('master/modal_kelas',$this->vars);
		}else{
			redirect('master/kelas');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_kelas->get_single_kelas($id);
			$this->vars['modal_title']='Edit';
			return $this->load->view('master/modal_kelas',$this->vars);
		}else{
			redirect('master/kelas');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=$this->security->xss_clean(array(
						'tingkat' => $_POST['tingkat'],
						'nm_kelas' => $_POST['nm_kelas']
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'kelas',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'tingkat' => $_POST['tingkat'],
						'nm_kelas' => $_POST['nm_kelas']
					));
					$hasil=$this->m_curd->add_new('kelas',$filldata);
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
			$this->vars['title']="Data Kelas";
			$this->vars['master']=$this->vars['kelas']=TRUE;
			$this->vars['data']=$this->m_kelas->get_kelas();
			$this->vars['content']='master/kelas';
			$this->load->view('backend/index',$this->vars);		
		}else{
			redirect('master/kelas');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('nm_kelas', 'Nama Kelas','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_kelas=(int) $id;
		if($id_kelas && $id_kelas !=0 && ctype_digit((string) $id_kelas)){
			$hasil = $this->m_curd->hapus(array('id' => $id_kelas),'kelas');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Data Kelas";
			$this->vars['master']=$this->vars['kelas']=TRUE;
			$this->vars['data']=$this->m_kelas->get_kelas();
			$this->vars['content']='master/kelas';
			$this->load->view('backend/index',$this->vars);					
		}else{
			redirect('master/kelas');
		}
	}
}
