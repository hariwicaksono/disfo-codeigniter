<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<?php 
		if(in_array($this->session->user_type,array("1"))) { 
			$this->load->view('backend/dashboard_admin');
		}else{
			$this->load->view('backend/dashboard_users');
		}
	?>
</section>
<!-- /.content -->
<script type="text/javascript">

</script>