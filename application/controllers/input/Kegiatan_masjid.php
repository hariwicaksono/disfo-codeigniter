<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_masjid extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_kegiatan']);
		
	}
	public function index()
	{
		$this->vars['title']="Kegiatan Masjid";
		$this->vars['display']=$this->vars['kegiatan_masjid']=TRUE;
		$this->vars['data']=$this->m_kegiatan->kegiatan_masjid();
		$this->vars['content']='input/kegiatan_masjid';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function form($param="",$param2=""){
		if($param=="add"){
			$this->vars['title']="Form Kegiatan Masjid";
			$this->vars['display']=$this->vars['kegiatan_masjid']=TRUE;
			$this->vars['mode']=$param;
			$this->vars['content']='input/form_kegiatan';
			$this->load->view('backend/index',$this->vars);	
		}elseif($param=="edit"){
			$data=$this->m_kegiatan->get_kegiatan('id',$param2);
			if($data->num_rows()>0){
				$this->vars['title']="Form Kegiatan Masjid";
				$this->vars['display']=$this->vars['kegiatan_masjid']=TRUE;
				$this->vars['data']=$data->row();
				$this->vars['mode']=$param;
				$this->vars['content']='input/form_kegiatan';
				$this->load->view('backend/index',$this->vars);	
			}
		}else{
			redirect(site_url('input/kegiatan_masjid'),'refresh');
		}
	}
	
	public function save($param="",$param2=""){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation_kegiatan()){
				if($param=="add"){
					$response=$this->m_kegiatan->save();
					$this->session->set_flashdata('type',$response['type']);
					$this->session->set_flashdata('message',$response['message']);
				}elseif($param=="edit"){
					$response=$this->m_kegiatan->edit('id',$param2);
					$this->session->set_flashdata('type',$response['type']);
					$this->session->set_flashdata('message',$response['message']);					
				}
			}else{
				$this->session->set_flashdata('type','error');
				$this->session->set_flashdata('message',validation_errors());	
				redirect(site_url('input/kegiatan_masjid/form/'.$param),'refresh');
			}
		}
		redirect(site_url('input/kegiatan_masjid'),'refresh');
	}
	
	public function hapus($param=""){
		if($param!=""){
			$response=$this->m_kegiatan->hapus('id',$param);
			$this->session->set_flashdata('type',$response['type']);
			$this->session->set_flashdata('message',$response['message']);
		}
		redirect(site_url('input/kegiatan_masjid'),'refresh');
	}	
	
	private function validation_kegiatan(){
		$val = $this->form_validation;
		$val->set_rules('tgl_kegiatan', 'Tanggal','trim|required');
		$val->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan','trim|required');
		$val->set_rules('nama_kegiatan', 'Nama Kegiatan','trim|required|min_length[3]');
		$val->set_rules('tmp_kegiatan', 'Tempat Kegiatan','trim|required|min_length[3]');
		$val->set_rules('waktu', 'Waktu Kegiatan','trim|required|min_length[4]');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}		
	
}
