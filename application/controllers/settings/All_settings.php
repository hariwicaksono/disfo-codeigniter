<?php defined('BASEPATH') OR exit('No direct script access allowed');

class All_settings extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_settings','m_curd']);
		$this->load->library('upload');
	}
	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$group=$_POST['group'];
			if(isset($_FILES["file"]["name"])){
				$this->upload->initialize($this->upload_options());
				if ( ! $this->upload->do_upload('file')){
					$error = array('error' => $this->upload->display_errors());
					$this->vars['type']="alert-danger";
					$this->vars['message'] = $this->upload->display_errors();
				}else{
					
					$data = array('upload_data' => $this->upload->data());
					$filename = $this->upload->data('file_name');
					$value_setting=$filename;
					$filldata=array(
						'value_setting' => $value_setting
					);
					$hasil =$this->m_curd->update(array('id' => $id),"settings",$filldata);
					if($hasil){
						$this->vars['type']="alert-success";
						$this->vars['message']="Berhasil Menyimpan.!";
					}else{
						$this->vars['type']="alert-danger";
						$this->vars['message']="Gagal Menyimpan Data, Coba Lagi!" ;			
					}					
				}

			}else{
				$value_setting=$_POST['value_setting'];
				$filldata=$this->security->xss_clean(array(
					'value_setting' => $value_setting
				));
				$hasil =$this->m_curd->update(array('id' => $id),"settings",$filldata);
				if($hasil){
					$this->vars['type']="alert-success";
					$this->vars['message']="Berhasil Menyimpan.!";
				}else{
					$this->vars['type']="alert-danger";
					$this->vars['message']="Gagal Menyimpan Data, Coba Lagi!" ;			
				}				
			}			
			
			$this->vars['title'] = ucwords($group).' Settings';
			$this->vars['settings'] = $this->vars[$group]=true;
			$this->vars['data'] =$this->m_settings->get_settings("group_setting",$group);
			$this->vars['content'] = 'settings/read';
			$this->load->view('backend/index', $this->vars);			
		}else{
			redirect('dashboard');
		}
	}
	
	private function upload_options(){   
		//  upload an image options
		$config = array();
		$config['upload_path'] = './images';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;
		$config['encrypt_name'] = TRUE;
		return $config;
	}	
	
	public function upload(){

	}		
}