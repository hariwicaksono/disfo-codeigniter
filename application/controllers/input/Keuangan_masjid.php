<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan_masjid extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_keuangan']);
		
	}
	public function index()
	{
		$this->vars['title']="Keuangan Masjid";
		$this->vars['display']=$this->vars['keuangan_masjid']=TRUE;
		$this->vars['data']=$this->m_keuangan->keuangan_masjid();
		$this->vars['content']='input/keuangan_masjid';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function form($param="",$param2=""){
		if($param=="add"){
			$this->vars['title']="Form Keuangan Masjid";
			$this->vars['display']=$this->vars['keuangan_masjid']=TRUE;
			$this->vars['mode']=$param;
			$this->vars['content']='input/form_keuangan';
			$this->load->view('backend/index',$this->vars);	
		}elseif($param=="edit"){
			$data=$this->m_keuangan->get_keuangan('id',$param2);
			if($data->num_rows()>0){
				$this->vars['title']="Form Keuangan Masjid";
				$this->vars['display']=$this->vars['keuangan_masjid']=TRUE;
				$this->vars['data']=$data->row();
				$this->vars['mode']=$param;
				$this->vars['content']='input/form_keuangan';
				$this->load->view('backend/index',$this->vars);	
			}
		}else{
			redirect(site_url('input/keuangan_masjid'),'refresh');
		}
	}
	
	public function save($param="",$param2=""){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation_keuangan()){
				if($param=="add"){
					$response=$this->m_keuangan->save();
					$this->session->set_flashdata('type',$response['type']);
					$this->session->set_flashdata('message',$response['message']);
				}elseif($param=="edit"){
					$response=$this->m_keuangan->edit('id',$param2);
					$this->session->set_flashdata('type',$response['type']);
					$this->session->set_flashdata('message',$response['message']);					
				}
			}else{
				$this->session->set_flashdata('type','error');
				$this->session->set_flashdata('message',validation_errors());	
				redirect(site_url('input/keuangan_masjid/form/'.$param),'refresh');
			}
		}
		redirect(site_url('input/keuangan_masjid'),'refresh');
	}
	
	public function hapus($param=""){
		if($param!=""){
			$response=$this->m_keuangan->hapus('id',$param);
			$this->session->set_flashdata('type',$response['type']);
			$this->session->set_flashdata('message',$response['message']);
		}
		redirect(site_url('input/keuangan_masjid'),'refresh');
	}	
	
	private function validation_keuangan(){
		$val = $this->form_validation;
		$val->set_rules('tanggal', 'Tanggal','trim|required');
		$val->set_rules('uraian', 'Uraian Transaksi','trim|required');
		$val->set_rules('jumlah', 'Jumlah nominal transaksi','trim|required|numeric');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}		
	
}
