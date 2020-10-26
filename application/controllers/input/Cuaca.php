<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuaca extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_cuaca','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Prakiraan Cuaca";
		$this->vars['display']=$this->vars['cuaca']=TRUE;
		$this->vars['data']=$this->m_cuaca->get_settings()->row();
		$this->vars['content']='input/cuaca';
		$this->load->view('backend/index',$this->vars);
	}
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
					
				$id=$_POST['id']; 
				$filldata=$this->security->xss_clean(array(
					'area' => $_POST['area']
				));					
				$hasil=$this->m_curd->update(array('id' => $id),'cuaca',$filldata);
				
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
			$this->vars['title']="Prakiraan Cuaca";
			$this->vars['display']=$this->vars['cuaca']=TRUE;
			$this->vars['data']=$this->m_cuaca->get_settings()->row();
			$this->vars['content']='input/cuaca';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/cuaca');
		}		
	}

	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('area', 'Area','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}



}
