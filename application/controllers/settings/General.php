<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_settings']);
	}

	/**
	 * index
	 */
	public function index() {
		$this->vars['title'] = 'General Settings';
		$this->vars['settings'] = $this->vars['general']=true;
		$this->vars['data'] =$this->m_settings->get_settings("group_setting","general");
		$this->vars['content'] = 'settings/read';
		$this->load->view('backend/index', $this->vars);
	}
	
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['modal_title']="Edit General Settings";
			$this->vars['data']=$this->m_settings->get_settings("id",$id);
			return $this->load->view('settings/modal_edit',$this->vars);
		}
	}
	
}