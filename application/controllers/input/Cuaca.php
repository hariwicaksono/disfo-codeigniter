<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuaca extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_cuaca']);
		
	}
	public function index()
	{
		$this->vars['title']="Prakiraan Cuaca BMKG 3 Harian";
		$this->vars['display']=$this->vars['cuaca']=TRUE;
		$this->vars['data']=$this->m_cuaca->get_settings()->row();
		$this->vars['opsi']=$this->load_area($this->vars['data']->url_area);
		$this->vars['content']='input/cuaca';
		$this->load->view('backend/index',$this->vars);
	}
	private function load_area($url){
		$data="";
		if(status_koneksi('data.bmkg.go.id')){
			libxml_use_internal_errors(true);
			$xml=simplexml_load_file($url);
			if (false === $xml) {
				$data .= "<option value='0'>Failed loading XML</option>" ;					
			}else{	
				foreach($xml->forecast->area as $area) {
					$data .= "<option value='".$area['description']."'>".$area['description']."</option>" ;
				}					
			}
		}else{
			$data .= "<option value='0'>Not Connected</option>" ;
		}	
		return $data;
	}
	public function load_xml(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$url=$this->security->xss_clean($this->input->post('url'));
			if($this->validation_set()){
				if(status_koneksi('data.bmkg.go.id')){
					libxml_use_internal_errors(true);
					$xml=simplexml_load_file($url);
					if (false === $xml) {
						$message = "Failed loading XML\n";
						foreach(libxml_get_errors() as $error) {
							$message .= '<br />' . $error->message;
						}
						$this->session->set_flashdata('type','error');
						$this->session->set_flashdata('message',$message);
						redirect(site_url('input/cuaca'),'refresh');						
					}else{	
						$data="";
						foreach($xml->forecast->area as $area) {
							$data .= "<option value='".$area['description']."'>".$area['description']."</option>" ;
						}
						$this->session->set_flashdata('url',$url);
						$this->session->set_flashdata('area',$data);
						$this->session->set_flashdata('type','success');
						$this->session->set_flashdata('message','Update file XML Success, choose your area now');
						redirect(site_url('input/cuaca'),'refresh');						
					}
				}else{
					$this->session->set_flashdata('type','error');
					$this->session->set_flashdata('message','not connected');
					redirect(site_url('input/cuaca'),'refresh');
				}	
			}else{
				$this->session->set_flashdata('type','error');
				$this->session->set_flashdata('message',validation_errors());
				redirect(site_url('input/cuaca'),'refresh');				
			}
		}else{
			redirect('input/cuaca','refresh');
		}			
	}
	private function validation_set(){
		$val = $this->form_validation;
		$val->set_rules('url', 'Alamat File BMK','trim|required|valid_url');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='News Ticker';
			return $this->load->view('input/modal_news',$this->vars);
		}else{
			redirect('input/news');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_news->get_single_news($id);
			$this->vars['modal_title']='News Ticker';
			return $this->load->view('input/modal_news',$this->vars);
		}else{
			redirect('input/news');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				if(isset($_POST['id'])){
					//edit
					$id=$_POST['id']; 
					$filldata=$this->security->xss_clean(array(
						'txt_news' => $_POST['txt_news']
					));					
					$hasil=$this->m_curd->update(array('id' => $id),'news',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'txt_news' => $_POST['txt_news'],
						'tgl_news' => date("Y-m-d")
					));
					$hasil=$this->m_curd->add_new('news',$filldata);
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
			$this->vars['title']="Display News Ticker";
			$this->vars['display']=$this->vars['news']=TRUE;
			$this->vars['data']=$this->m_news->get_news();
			$this->vars['content']='input/news';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/news');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('txt_news', 'News Text','trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_news=(int) $id;
		if($id_news && $id_news !=0 && ctype_digit((string) $id_news)){
			$hasil = $this->m_curd->hapus(array('id' => $id_news),'news');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Display News Ticker";
			$this->vars['display']=$this->vars['news']=TRUE;
			$this->vars['data']=$this->m_news->get_news();
			$this->vars['content']='input/news';
			$this->load->view('backend/index',$this->vars);				
		}else{
			redirect('input/news');
		}
	}
}
