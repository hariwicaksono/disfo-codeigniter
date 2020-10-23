<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('images/photo/'.($this->session->foto=="" ? 'default.jpeg' : $this->session->foto)); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->fullname; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li class="<?=isset($dashboard) ? 'active' : ''; ?>">
          <a href="<?=site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>		
<?php 
	if(in_array($this->session->user_type,array('1'))) { 
		$this->load->view('backend/sidebar_admin');
	}
?>
<?php 
	if(in_array($this->session->user_type,array('2'))) { 
		$this->load->view('backend/sidebar_users');
	}
?>
		
		<li class="<?=isset($logout) ? 'active' : ''; ?>">
			<a href="<?=site_url('logout'); ?>"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a>
		</li>
      </ul>
