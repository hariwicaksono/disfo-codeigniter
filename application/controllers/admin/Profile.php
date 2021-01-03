<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_users','m_crud']);
		$this->load->library('upload');
	}
	public function index()
	{
		$this->vars['title']="Profil Saya";
		$this->vars['dashboar']=TRUE;
		$this->vars['data']=$this->m_users->get_profile();
		$this->vars['content']='admin/profile';
		$this->load->view('backend/index',$this->vars);
	}
	private function validation_profile(){
		$val = $this->form_validation;
		$val->set_rules('username', 'Username Anda','trim|required|xss_clean|callback_username_check');
		$val->set_rules('fullname', 'Nama Lengkap Anda','trim|required|xss_clean');
		$val->set_rules('email', 'Email Anda','trim|required|valid_email|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}
	Public function username_check($username){
		$hasil=$this->db->get_where('users',array('username' => $username));
		if($hasil->num_rows()>0){
			//username sudah ada
			if($this->session->username != $hasil->row()->username){
				$this->form_validation->set_message('username_check', 'username sudah ada!');
				return FALSE;
			}
		}
		return TRUE;		
	}	
	Public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation_profile()){
				$filldata=$this->security->xss_clean(array(
					'username' => $_POST['username'],
					'fullname' => $_POST['fullname'],
					'email' => $_POST['email']
				));
				$hasil=$this->m_crud->update(array('id' => $this->session->id),'users',$filldata);
				if($hasil){
					$this->session->set_userdata('username', $_POST['username']);
					$this->session->set_userdata('fullname', $_POST['fullname']);
					$this->session->set_userdata('email', $_POST['email']);
					$this->vars['type'] = 'alert-success';
					$this->vars['message'] = "Berhasil disimpan!";						
				}else{
					$this->vars['type'] = 'alert-danger';
					$this->vars['message'] = "Gagal disimpan!";						
				}
			}else{
				$this->vars['type'] = 'error';
				$this->vars['message'] = validation_errors();					
			}
			$this->vars['title']="Profil Saya";
			$this->vars['dashboar']=TRUE;
			$this->vars['data']=$this->m_users->get_profile();
			$this->vars['content']='admin/profile';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('admin/profile');
		}
	}
	
	private function validation_password(){
		$val = $this->form_validation;
		//$val->set_rules('pass_lama', 'Password Lama Anda','trim|required|xss_clean|callback_password_check');
		$val->set_rules('pass_baru', 'Password Baru Anda','trim|required|xss_clean|min_length[8]');
		$val->set_rules('konf_pass', 'Password Konfirmasi','trim|required|matches[pass_baru]|xss_clean');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();			
	}
	Public function password_check($pass_lama){
		$hasil=$this->db->get_where('users',array('id' => $this->session->id));
		if($hasil->num_rows()>0){
			//password _check
			if(password_verify($pass_lama, $hasil->row()->password)){
				return TRUE;
			}
		}
		$this->form_validation->set_message('password_check', 'Password Lama anda tidak cocok!');
		return FALSE;			
	}	
	Public function ubah_pw(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->validation_password()){
				$filldata=array(
					'password' => password_hash($this->security->xss_clean($_POST['pass_baru']),PASSWORD_DEFAULT)
				);
				$hasil=$this->m_crud->update(array('id' => $this->session->id),'users',$filldata);
				if($hasil){
					$this->vars['type'] = 'alert-success';
					$this->vars['message'] = "Berhasil ganti password!";						
				}else{
					$this->vars['type'] = 'alert-danger';
					$this->vars['message'] = "Gagal ganti password!";						
				}
			}else{
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = validation_errors();					
			}
			$this->vars['title']="Profil Saya";
			$this->vars['dashboar']=TRUE;
			$this->vars['data']=$this->m_users->get_profile();
			$this->vars['content']='admin/profile';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('admin/profile');
		}
	}	
	
	public function add_foto(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Ganti Foto';
			return $this->load->view('admin/modal_upload_foto',$this->vars);
		}else{
			redirect('admin/profile');
		}
	}

	private function upload_options(){   
		//  upload an image options
		$config = array();
		$config['upload_path'] = './images/photo';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;
		$config['encrypt_name'] = TRUE;
		return $config;
	}	
	
	public function upload(){
		if(isset($_FILES["file"]["name"])){
			$this->upload->initialize($this->upload_options());
			if ( ! $this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				$this->vars['type']="alert-danger";
				$this->vars['message'] = $this->upload->display_errors();
			}else{
				
				$data = array('upload_data' => $this->upload->data());
				$filename = $this->upload->data('file_name');
				
				$filldata=$this->security->xss_clean(array(
					'foto' => $filename
				));
				$hasil=$this->m_crud->update(array('id' => $this->session->id),'users',$filldata);
				if($hasil){
					$this->session->set_userdata('foto', $filename);
					$this->vars['type'] = 'alert-success';
					$this->vars['message'] = "Upload Foto Success!";						
				}else{
					$this->vars['type'] = 'alert-danger';
					$this->vars['message'] = "Upload Foto Gagal!";						
				}
			}

			$this->vars['title']="Profil Saya";
			$this->vars['dashboar']=TRUE;
			$this->vars['data']=$this->m_users->get_profile();
			$this->vars['content']='admin/profile';
			$this->load->view('backend/index',$this->vars);
		}else{
			redirect('admin/profile');
		}
	}		
}
