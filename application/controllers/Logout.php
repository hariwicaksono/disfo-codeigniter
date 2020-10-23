<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	/**
	 * Constructor
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_users');
	}

	/**
	 * index()
	 * Fungsi untuk menghapus data session users
	 * @access  public
	 * @return   void
	 */
	public function index() {
		if (!$this->auth->is_logged_in())
			redirect(base_url());
		$id = $this->session->userdata('id');
		if (!empty($id)) {
			$this->m_users->reset_logged_in($id);
			$this->session->sess_destroy();
		}
		redirect('home');
	}
 }