<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kp extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_kp','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Jadwal KP";
		$this->vars['display']=$this->vars['kp']=TRUE;
		$this->vars['data']=$this->m_kp->get_kp();
		$this->vars['content']='input/kp';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Jadwal kp';
			return $this->load->view('input/modal_kp',$this->vars);
		}else{
			redirect('input/kp');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_kp->get_single_kp($id);
			$this->vars['modal_title']='Jadwal kp';
			return $this->load->view('input/modal_kp',$this->vars);
		}else{
			redirect('input/kp');
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
						'tgl_kp' => $_POST['tgl_kp'],
						'txt_kp' => $_POST['txt_kp'],
						'ruang' => $_POST['ruang'],
						'waktu' => $_POST['waktu']
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'kp',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'npm' => $_POST['npm'],
						'nama_mhs' => $_POST['nama_mhs'],
						'tgl_kp' => $_POST['tgl_kp'],
						'txt_kp' => $_POST['txt_kp'],
						'ruang' => $_POST['ruang'],
						'waktu' => $_POST['waktu']
					));
					$hasil=$this->m_curd->add_new('kp',$filldata);
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
			$this->vars['title']="Display Jadwal kp";
			$this->vars['display']=$this->vars['kp']=TRUE;
			$this->vars['data']=$this->m_kp->get_kp();
			$this->vars['content']='input/kp';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/kp');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('txt_kp', 'kp Text','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_kp=(int) $id;
		if($id_kp && $id_kp !=0 && ctype_digit((string) $id_kp)){
			$hasil = $this->m_curd->hapus(array('id' => $id_kp),'kp');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Jadwal kp";
			$this->vars['display']=$this->vars['kp']=TRUE;
			$this->vars['data']=$this->m_kp->get_kp();
			$this->vars['content']='input/kp';
			$this->load->view('backend/index',$this->vars);				
		}else{
			redirect('input/kp');
		}
	}
}
