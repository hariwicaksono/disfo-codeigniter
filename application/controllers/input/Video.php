<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_video','m_crud']);
		$this->load->library('upload');
		
	} 
	public function index()
	{
		$this->vars['title']="Display Video";
		$this->vars['display']=$this->vars['video']=TRUE;
		$this->vars['data']=$this->m_video->get_video();
		$this->vars['content']='input/video';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Tambah Video';
			return $this->load->view('input/modal_upload_video',$this->vars);
		}else{
			redirect('input/video');
		}
	}
	
	private function upload_options(){   
		//  upload an image options
		$config = array();
		$config['upload_path'] = './uploads/video';
		$config['allowed_types'] = 'wmv|mp4|avi|mov';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;
		$config['encrypt_name'] = TRUE;
		return $config;
	}	
	
	public function upload(){
		if(isset($_FILES["file"]["name"])){
			if($this->validation_upload()){
				$this->upload->initialize($this->upload_options());
				if ( ! $this->upload->do_upload('file')){
					$error = array('error' => $this->upload->display_errors());
					$this->vars['type']="alert-danger";
					$this->vars['message'] = $this->upload->display_errors();
				}else{
					
					$data = array('upload_data' => $this->upload->data());
					$filename = $this->upload->data('file_name');
					
					$filldata=$this->security->xss_clean(array(
						'judul' => $_POST['judul'],
						'nm_file' => $filename,
						'status' => $_POST['status']
					));
					$hasil=$this->m_crud->add_new('video',$filldata);
					$this->vars['type']="alert-success";
					$this->vars['message']="Upload Video Berhasil";
				}
			}else{
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = validation_errors();						
			}

			$this->vars['title']="Display Video";
			$this->vars['display']=$this->vars['video']=TRUE;
			$this->vars['data']=$this->m_video->get_video();
			$this->vars['content']='input/video';
			$this->load->view('backend/index',$this->vars);	
		}else{
			redirect('input/video');
		}
	}	
	
	private function validation_upload(){
		$val = $this->form_validation;
		$val->set_rules('judul', 'Judul Video','trim|required|xss_clean');
		$val->set_rules('status', 'Status Video','trim|required|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}	
	
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_video->get_single_video($id);
			$this->vars['modal_title']='Edit Info Video';
			return $this->load->view('input/modal_video',$this->vars);
		}else{
			redirect('input/video');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				$id=$_POST['id']; 
				$filldata=array(
					'judul' => $_POST['judul'],
					'status' => $_POST['status']
				);				
				$hasil=$this->m_crud->update(array('id' => $id),'video',$filldata);
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
			$this->vars['title']="Display Video";
			$this->vars['display']=$this->vars['video']=TRUE;
			$this->vars['data']=$this->m_video->get_video();
			$this->vars['content']='input/video';
			$this->load->view('backend/index',$this->vars);	
		}else{
			redirect('input/video');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('judul', 'Judul Video','trim|required|xss_clean');
		$val->set_rules('status', 'Status Video','trim|required|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_video=(int) $id;
		$del_video=FALSE;
		if($id_video && $id_video !=0 && ctype_digit((string) $id_video)){
			$data_video=$this->m_video->get_single_video($id_video);
			if($data_video->num_rows()>0){
				$video_file=$data_video->row()->nm_file;
				if($video_file!=""){
					$file=FCPATH."uploads/video/".$video_file;
					if(file_exists($file)){
						if (unlink($file)) {
							$del_video=TRUE;
						}						
					}else{
						$del_video=TRUE;
					}
				}
				if($del_video){
					$hasil = $this->m_crud->hapus(array('id' => $id_video),'video');
					if($hasil){
						$this->vars['type']='alert-success';
						$this->vars['message']='Berhasil Menghapus';
					}else{
						$this->vars['type']='alert-danger';
						$this->vars['message']='Gagal Menghapus';				
					}
				}
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';					
			}
			$this->vars['title']="Display Video";
			$this->vars['display']=$this->vars['video']=TRUE;
			$this->vars['data']=$this->m_video->get_video();
			$this->vars['content']='input/video';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('input/video');
		}
	}
}
