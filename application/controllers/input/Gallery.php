<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_gallery','m_curd']);
		$this->load->library('upload');
		
	}
	public function index()
	{
		$this->vars['title']="Images Gallery";
		$this->vars['display']=$this->vars['gallery']=TRUE;
		$this->vars['data']=$this->m_gallery->get_images();
		$this->vars['content']='input/gallery';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Add Image';
			return $this->load->view('input/modal_upload_gallery',$this->vars);
		}else{
			redirect('input/gallery');
		}
	}
	
	private function upload_options(){   
		//  upload an image options
		$config = array();
		$config['upload_path'] = './images/gallery';
		$config['allowed_types'] = 'jpg|png';
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
						'label' => $_POST['label'],
						'deskripsi' => $_POST['deskripsi'],
						'image_url' => $filename,
						'status' => $_POST['status']
					));
					$hasil=$this->m_curd->add_new('gallery',$filldata);
					$this->vars['type']="alert-success";
					$this->vars['message']="Upload Image Success";
				}
			}else{
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = validation_errors();						
			}

			$this->vars['title']="Images Gallery";
			$this->vars['display']=$this->vars['gallery']=TRUE;
			$this->vars['data']=$this->m_gallery->get_images();
			$this->vars['content']='input/gallery';
			$this->load->view('backend/index',$this->vars);
		}else{
			redirect('input/gallery');
		}
	}	
	private function validation_upload(){
		$val = $this->form_validation;
		$val->set_rules('label', 'Label Image','trim|required|xss_clean');
		$val->set_rules('deskripsi', 'Deskripsi Singkat Image','trim|required|xss_clean');
		$val->set_rules('status', 'Status Image','trim|required|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}		
	
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_gallery->get_single_image($id);
			$this->vars['modal_title']='Edit Image Info';
			return $this->load->view('input/modal_upload_gallery',$this->vars);
		}else{
			redirect('input/gallery');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation()){
				$id=$_POST['id']; 
				$filldata=$this->security->xss_clean(array(
					'label' => $_POST['label'],
					'deskripsi' => $_POST['deskripsi'],
					'status' => $_POST['status']
				));			
				$hasil=$this->m_curd->update(array('id' => $id),'gallery',$filldata);
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
			$this->vars['title']="Images Gallery";
			$this->vars['display']=$this->vars['gallery']=TRUE;
			$this->vars['data']=$this->m_gallery->get_images();
			$this->vars['content']='input/gallery';
			$this->load->view('backend/index',$this->vars);	
		}else{
			redirect('input/gallery');
		}		
	}
	private function validation(){
		$val = $this->form_validation;
		$val->set_rules('label', 'Label Image','trim|required|xss_clean');
		$val->set_rules('deskripsi', 'Deskripsi Video','trim|required|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	public function hapus($id){
		$id_image=(int) $id;
		$del_image=FALSE;
		if($id_image && $id_image !=0 && ctype_digit((string) $id_image)){
			$data_image=$this->m_gallery->get_single_image($id_image);
			if($data_image->num_rows()>0){
				$image_file=$data_image->row()->image_url;
				if($image_file!=""){
					$file=FCPATH."images/gallery/".$image_file;
					if(file_exists($file)){
						if (unlink($file)) {
							$del_image=TRUE;
						}						
					}else{
						$del_image=TRUE;
					}
				}
				if($del_image){
					$hasil = $this->m_curd->hapus(array('id' => $id_image),'gallery');
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
			$this->vars['title']="Images Gallery";
			$this->vars['display']=$this->vars['gallery']=TRUE;
			$this->vars['data']=$this->m_gallery->get_images();
			$this->vars['content']='input/gallery';
			$this->load->view('backend/index',$this->vars);		
		}else{
			redirect('input/gallery');
		}
	}
}
