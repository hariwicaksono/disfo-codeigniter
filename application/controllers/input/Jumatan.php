<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jumatan extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_masjid']);
		
	}
	public function index()
	{
		$this->vars['title']="Imam dan Khotib Jum'at";
		$this->vars['display']=$this->vars['jumatan']=TRUE;
		$this->vars['data']=$this->m_masjid->jumatan();
		$this->vars['content']='input/jumatan';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function form($param="",$param2=""){
		if($param=="add"){
			$this->vars['title']="Form Info Jum'at";
			$this->vars['display']=$this->vars['jumatan']=TRUE;
			$this->vars['mode']=$param;
			$this->vars['content']='input/form_jumat';
			$this->load->view('backend/index',$this->vars);	
		}elseif($param=="edit"){
			$data=$this->m_masjid->get_jumatan('id',$param2);
			if($data->num_rows()>0){
				$this->vars['title']="Form Info Jum'at";
				$this->vars['display']=$this->vars['jumatan']=TRUE;
				$this->vars['data']=$data->row();
				$this->vars['mode']=$param;
				$this->vars['content']='input/form_jumat';
				$this->load->view('backend/index',$this->vars);	
			}
		}else{
			redirect(site_url('input/jumatan'),'refresh');
		}
	}
	
	public function save($param="",$param2=""){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation_jumat()){
				if($param=="add"){
					$response=$this->m_masjid->save();
					$this->session->set_flashdata('type',$response['type']);
					$this->session->set_flashdata('message',$response['message']);
				}elseif($param=="edit"){
					$response=$this->m_masjid->edit('id',$param2);
					$this->session->set_flashdata('type',$response['type']);
					$this->session->set_flashdata('message',$response['message']);					
				}
			}else{
				$this->session->set_flashdata('type','error');
				$this->session->set_flashdata('message',validation_errors());	
				redirect(site_url('input/jumatan/form/'.$param),'refresh');
			}
		}
		redirect(site_url('input/jumatan'),'refresh');
	}
	public function aktifkan($param=""){
		if($param!=""){
			$response=$this->m_masjid->aktifkan_jumatan('id',$param);
			$this->session->set_flashdata('type',$response['type']);
			$this->session->set_flashdata('message',$response['message']);
		}
		redirect(site_url('input/jumatan'),'refresh');
	}
	public function hapus($param=""){
		if($param!=""){
			$response=$this->m_masjid->hapus('id',$param);
			$this->session->set_flashdata('type',$response['type']);
			$this->session->set_flashdata('message',$response['message']);
		}
		redirect(site_url('input/jumatan'),'refresh');
	}	
	
	private function validation_jumat(){
		$val = $this->form_validation;
		$val->set_rules('tanggal', 'Tanggal','trim|required');
		$val->set_rules('imam', 'Imam','trim|required|min_length[3]');
		$val->set_rules('khotib', 'Khotib','trim|required|min_length[3]');
		$val->set_rules('muazin', 'Muazin','trim|required|min_length[3]');
		$val->set_rules('judul_khotbah', 'Judul Khotbah','trim|required|min_length[4]');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}		
	
}
