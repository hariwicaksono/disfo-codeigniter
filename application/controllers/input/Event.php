<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_event','m_curd']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Event";
		$this->vars['display']=$this->vars['event']=TRUE;
		$this->vars['data']=$this->m_event->get_event();
		$this->vars['content']='input/event';
		$this->load->view('backend/index',$this->vars);
	}
	public function bulan()
	{
		$this->vars['title']="Display Event Bulan Ini";
		$this->vars['display']=$this->vars['event_bulan']=TRUE;
		$this->vars['data']=$this->m_event->get_event_bulan();
		$this->vars['content']='input/event_bulan';
		$this->load->view('backend/index',$this->vars);
	}	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Add Event';
			return $this->load->view('input/modal_event',$this->vars);
		}else{
			redirect('input/event');
		}
	}
	public function add_event_bulan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Add Event Bulan Ini';
			return $this->load->view('input/modal_event_bulan',$this->vars);
		}else{
			redirect('input/event');
		}
	}	
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_event->get_single_event($id);
			$this->vars['modal_title']='Edit Event';
			return $this->load->view('input/modal_event',$this->vars);
		}else{
			redirect('input/event');
		}
	}	
	public function edit_bulan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_event->get_single_event_bulan($id);
			$this->vars['modal_title']='Edit Event Bulan Ini';
			return $this->load->view('input/modal_event_bulan',$this->vars);
		}else{
			redirect('input/event/bulan');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=array(
						'tanggal' => $_POST['tanggal'],
						'waktu_mulai' => $_POST['waktu_mulai'],
						'waktu_akhir' => $_POST['waktu_akhir'],
						'nm_event' => $_POST['nm_event'],
						'tempat' => $_POST['tempat']
					);				
					$hasil=$this->m_curd->update(array('id' => $id),'event',$filldata);
				}else{
					//new 
					$filldata=array(
						'tanggal' => $_POST['tanggal'],
						'waktu_mulai' => $_POST['waktu_mulai'],
						'waktu_akhir' => $_POST['waktu_akhir'],
						'nm_event' => $_POST['nm_event'],
						'tempat' => $_POST['tempat']
					);
					$hasil=$this->m_curd->add_new('event',$filldata);
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
			$this->vars['title']="Display Event";
			$this->vars['display']=$this->vars['event']=TRUE;
			$this->vars['data']=$this->m_event->get_event();
			$this->vars['content']='input/event';
			$this->load->view('backend/index',$this->vars);		
		}else{
			redirect('input/event');
		}		
	}
	public function simpan_event_bulan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation_bulan()){
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=array(
						'nama_event' => $_POST['nama_event'],
						'tgl_event' => $_POST['tgl_event'],
						'tmp_event' => $_POST['tmp_event'],
						'waktu' => $_POST['waktu'],
						'status' => $_POST['status']
					);				
					$hasil=$this->m_curd->update(array('id' => $id),'event_bulan',$filldata);
				}else{
					//new 
					$filldata=array(
						'nama_event' => $_POST['nama_event'],
						'tgl_event' => $_POST['tgl_event'],
						'tmp_event' => $_POST['tmp_event'],
						'waktu' => $_POST['waktu'],
						'status' => $_POST['status']
					);	
					$hasil=$this->m_curd->add_new('event_bulan',$filldata);
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
			$this->vars['title']="Display Event Bulan Ini";
			$this->vars['display']=$this->vars['event_bulan']=TRUE;
			$this->vars['data']=$this->m_event->get_event_bulan();
			$this->vars['content']='input/event_bulan';
			$this->load->view('backend/index',$this->vars);
		}else{
			redirect('input/event/bulan');
		}		
	}	
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('tanggal', 'Tanggal','trim|required|xss_clean');
		$val->set_rules('waktu_mulai', 'Waktu Mulai Event','trim|required|xss_clean');
		$val->set_rules('waktu_akhir', 'Waktu Akhir Event','trim|required|xss_clean');
		$val->set_rules('nm_event', 'Deskripsi Event','trim|required|xss_clean');
		$val->set_rules('tempat', 'Deskripsi Event','trim|required|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}
	private function validation_bulan(){
		$val = $this->form_validation;
		$val->set_rules('nama_event', 'Nama Event','trim|required|xss_clean');
		$val->set_rules('tgl_event', 'Tanggal Event','trim|required|xss_clean');
		$val->set_rules('tmp_event', 'Tempat Event','trim|required|xss_clean');
		$val->set_rules('waktu', 'Waktu Event','trim|required|xss_clean');
		$val->set_rules('status', 'Status Event','trim|required|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}
	public function hapus($id){
		$id_event=(int) $id;
		if($id_event && $id_event !=0 && ctype_digit((string) $id_event)){
			$hasil = $this->m_curd->hapus(array('id' => $id_event),'event');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Event";
			$this->vars['display']=$this->vars['event']=TRUE;
			$this->vars['data']=$this->m_event->get_event();
			$this->vars['content']='input/event';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/event');
		}
	}
	public function hapus_bulan($id){
		$id_event=(int) $id;
		if($id_event && $id_event !=0 && ctype_digit((string) $id_event)){
			$hasil = $this->m_curd->hapus(array('id' => $id_event),'event_bulan');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display Event Bulan Ini";
			$this->vars['display']=$this->vars['event_bulan']=TRUE;
			$this->vars['data']=$this->m_event->get_event_bulan();
			$this->vars['content']='input/event_bulan';
			$this->load->view('backend/index',$this->vars);		
		}else{
			redirect('input/event/bulan');
		}
	}	
	
}
