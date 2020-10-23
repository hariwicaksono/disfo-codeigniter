<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		if ($this->auth->is_logged_in())
			redirect('dashboard');
		
	}
	public function index()
	{
		$this->vars['title']="Login";
		$this->vars['login']=TRUE;
		$this->vars['content']='public/login';
		$this->load->view('public/index',$this->vars);
	}

	public function process() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->validation()) {
				$user_name = $this->input->post('username', TRUE);
				$user_password = $this->input->post('password', TRUE);
				$ip_address = get_ip_address();
				$logged_in = $this->auth->logged_in($user_name, $user_password, $ip_address) ? 'alert-success' : 'alert-danger';
				$this->vars['type'] = $logged_in;
				$this->vars['message'] = $logged_in == 'alert-success' ? 'Login Success' : 'Login Failed.';
			} else {
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = validation_errors();
			}
			if($this->vars['type']=="alert-danger"){
				$this->vars['title']="Login";
				$this->vars['login']=TRUE;
				$this->vars['content']='public/login';
				$this->load->view('public/index',$this->vars);			
			}
			if($this->vars['type']=="alert-success"){
				redirect('dashboard');
			}
		}else{
			redirect('home');
		}
	}

	/**
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('username', 'Username', 'trim|required');
		$val->set_rules('password', 'Password', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}	
}
