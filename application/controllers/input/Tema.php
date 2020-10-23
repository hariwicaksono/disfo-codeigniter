<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tema extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_tema','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Tema";
		$this->vars['display']=$this->vars['tema']=TRUE;
		$this->vars['data']=$this->m_tema->get_tema();
		$this->vars['content']='input/tema';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function load_new(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Add/Edit Tema';
			return $this->load->view('input/modal_tema',$this->vars);
		}else{
			redirect('input/tema');
		}
	}

	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data_tema']=$this->m_tema->get_single_tema($id);
			$this->vars['modal_title']='Add/Edit Tema';
			return $this->load->view('input/modal_tema',$this->vars);
		}else{
			redirect('input/tema');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				$start_date=$_POST['start_date'];
				$date = strtotime("+1 week", strtotime($start_date));
				$end_date=date("Y-m-d", $date);				
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=$this->security->xss_clean(array(
						'start_date' => $start_date,
						'end_date' => $end_date,
						'tema' => strtoupper($_POST['tema']),
						'sub_tema' => strtoupper($_POST['sub_tema'])
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'tema',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'start_date' => $start_date,
						'end_date' => $end_date,
						'tema' => strtoupper($_POST['tema']),
						'sub_tema' => strtoupper($_POST['sub_tema'])
					));		
					$hasil=$this->m_curd->add_new('tema',$filldata);
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
			$this->vars['title']="Display Tema";
			$this->vars['display']=$this->vars['tema']=TRUE;
			$this->vars['data']=$this->m_tema->get_tema();
			$this->vars['content']='input/tema';
			$this->load->view('backend/index',$this->vars);	
		}else{
			redirect('input/tema');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('tema', 'Tema','trim|required');
		$val->set_rules('sub_tema', 'Sub Tema','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_tema=(int) $id;
		if($id_tema && $id_tema !=0 && ctype_digit((string) $id_tema)){
			$hasil = $this->m_curd->hapus(array('id' => $id_tema),'tema');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Tema";
			$this->vars['display']=$this->vars['tema']=TRUE;
			$this->vars['data']=$this->m_tema->get_tema();
			$this->vars['content']='input/tema';
			$this->load->view('backend/index',$this->vars);				
		}else{
			redirect('input/tema');
		}
	}
}
