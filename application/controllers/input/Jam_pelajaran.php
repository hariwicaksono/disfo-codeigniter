<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jam_pelajaran extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_jam_pelajaran','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Jam Pelajaran";
		$this->vars['display']=$this->vars['jam_pelajaran']=TRUE;
		$this->vars['data']=$this->m_jam_pelajaran->get_jam();
		$this->vars['content']='input/jam_pelajaran';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Jam Pelajaran';
			return $this->load->view('input/modal_jam_pelajaran',$this->vars);
		}else{
			redirect('input/jam_pelajaran');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_jam_pelajaran->get_single_jam($id);
			$this->vars['modal_title']='Jam Pelajaran';
			return $this->load->view('input/modal_jam_pelajaran',$this->vars);
		}else{
			redirect('input/jam_pelajaran');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=$this->security->xss_clean(array(
						'awal' => $_POST['awal'],
						'akhir' => $_POST['akhir']
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'jam_pelajaran',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'jam_ke' => $_POST['jam_ke'],
						'awal' => $_POST['awal'],
						'akhir' => $_POST['akhir']
					));
					$hasil=$this->m_curd->add_new('jam_pelajaran',$filldata);
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
			$this->vars['title']="Display Jam Pelajaran";
			$this->vars['display']=$this->vars['jam_pelajaran']=TRUE;
			$this->vars['data']=$this->m_jam_pelajaran->get_jam();
			$this->vars['content']='input/jam_pelajaran';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/jam_pelajaran');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('jam_ke', 'Jam Ke','trim|required');
		$val->set_rules('awal', 'Start','trim|required');
		$val->set_rules('akhir', 'End','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$idjam=(int) $id;
		if($idjam && $idjam !=0 && ctype_digit((string) $idjam)){
			$hasil = $this->m_curd->hapus(array('id' => $idjam),'jam_pelajaran');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Jam Pelajaran";
			$this->vars['display']=$this->vars['jam_pelajaran']=TRUE;
			$this->vars['data']=$this->m_jam_pelajaran->get_jam();
			$this->vars['content']='input/jam_pelajaran';
			$this->load->view('backend/index',$this->vars);				
		}else{
			redirect('input/jam_pelajaran');
		}
	}
}
