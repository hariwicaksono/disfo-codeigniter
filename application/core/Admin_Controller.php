<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

	/**
	 * Primary key
	 * @var string
	 */
	protected $pk;

	/**
	 * Table
	 * @var string
	 */
	protected $table;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		// Restrict
		$this->auth->restrict();
		
		// Check privileges Users
		if (!in_array($this->uri->segment(1), $this->user_privileges())) {
			redirect(base_url());
		}

		// $this->output->enable_profiler();
	}

	private function user_privileges(){
		$type=$this->session->user_type;
		switch ($type) {
			case 1: //admin
				$hasil=['admin','dashboard','settings','input','master'];
				break;
			case 2: //guru
				$hasil=['dashboard','guru'];
				break;
			case 3: //tu
				$hasil=['dashboard'];
				break;	
			case 4: //siswa
				$hasil=['dashboard'];
				break;				
		}
		return $hasil;		
	}
}