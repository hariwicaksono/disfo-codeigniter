<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
	public function index()
	{
		$this->vars['title']="Display Informasi";
		$this->vars['home']=TRUE;
		$this->vars['content']='public/home';
		$this->load->view('public/index',$this->vars);
	}
}
