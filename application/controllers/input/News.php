<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_news','m_crud']);
		
	}
	public function index()
	{
		$this->vars['title']="Display Berita Teks Berjalan";
		$this->vars['display']=$this->vars['news']=TRUE;
		$this->vars['data']=$this->m_news->get_news();
		$this->vars['content']='input/news';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Berita Teks Berjalan';
			return $this->load->view('input/modal_news',$this->vars);
		}else{
			redirect('input/news');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_news->get_single_news($id);
			$this->vars['modal_title']='Berita Teks Berjalan';
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
					$hasil=$this->m_crud->update(array('id' => $id),'news',$filldata);
				}else{
					//new 
					$filldata=$this->security->xss_clean(array(
						'txt_news' => $_POST['txt_news'],
						'tgl_news' => date("Y-m-d")
					));
					$hasil=$this->m_crud->add_new('news',$filldata);
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
			$this->vars['title']="Display Berita Teks Berjalan";
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
			$hasil = $this->m_crud->hapus(array('id' => $id_news),'news');
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
