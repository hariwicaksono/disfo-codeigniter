<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_news','m_jam_pelajaran','m_jadwal','m_event','m_solat','m_video']);
		
	}
	public function index()
	{
		$this->vars['data_video']=$this->m_video->get_aktif_video2();
		$this->load->view('welcome_message',$this->vars);
	}
	

}
