<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['']);
	}

	/**
	 * index
	 */
	public function index() {
		$this->vars['title'] = 'Dashboard';
		$this->vars['dashboard'] = true;
		$this->vars['content'] = 'backend/dashboard';
		$this->load->view('backend/index', $this->vars);
	}

}