<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DISFO | <?=$title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=""> 
	<meta name="keyword" content="">
	<meta name="google" content="nositelinkssearchbox" />
	<meta name="robots" content="index, follow">	  
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css'); ?>">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
	
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toast/toastr.min.css'); ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.min.js'); ?>"></script>
	
	<!-- daterangepicker -->
	<script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
	<!-- Slimscroll -->
	<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/toast/toastr.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dist/js/pollapp.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/dist/js/loadingoverlay.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dist/js/printThis.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/plugins/sweetalert/sweetalert.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>	
	
	<!-- AdminLTE -->
	<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>	
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/bower_components/ckeditor/ckeditor.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image'); ?>"></script>
	<script type="text/javascript">
		const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';			
	</script>	
</head>
<body class="hold-transition skin-blue-light sidebar-mini <?php echo (isset($jadwal_pelajaran) ? "sidebar-collapse" : "" ); ?>" onload="load_konten()">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>DIS</b>FO</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DISFO</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	<?php $this->load->view('backend/nav_custom'); ?>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
	<?php $this->load->view('backend/sidebar'); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<?php $this->load->view($content);?>
	<div class="row">
		<div class="col-md-12" id="modalku">
		 
		</div>
	</div>	
  </div>  
  <!-- /.content-wrapper -->
 
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version <?=$this->settings->info['ver']; ?></b> 
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?=$this->settings->info['owner']; ?></a>.</strong> All rights
    reserved.
  </footer>
</div>
<a href="javascript:" id="return-to-top"><i class="fa fa-angle-double-up"></i></a>
<!-- ./wrapper -->
<!-- CK Editor -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
$.LoadingOverlay("show");
$( document ).ready(function(){
	
});
function load_konten(){
	$.LoadingOverlay("hide");
}
$(window).scroll(function() {
	if ($(this).scrollTop() >= 50) {
		$('#return-to-top').fadeIn(200);
	} else {
		$('#return-to-top').fadeOut(200);
	}
});
$('#return-to-top').click(function() {
	$('body,html').animate({
		scrollTop : 0
	}, 500);
});	
</script>
</body>
</html>
