<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DISFO | <?=$title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
	
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css'); ?>">
	
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toast/toastr.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jsosial/jssocials.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jsosial/jssocials-theme-classic.css'); ?>">
	
	
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

	<script src="<?php echo base_url('assets/plugins/toast/toastr.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dist/js/pollapp.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dist/js/loadingoverlay.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/jsosial/jssocials.min.js'); ?>"></script>
	<script type="text/javascript">
		const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';			
	</script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="<?php echo base_url(); ?>" class="navbar-brand"><b>DISFO </b></a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="navbar-collapse collapse" id="navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="<?=isset($home) ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
							<li class="<?=isset($login) ? 'active' : ''; ?>"><a href="<?=site_url('login'); ?>">Login</a></li>
							<li class="<?=isset($display) ? 'active' : ''; ?>"><a href="<?=site_url('display'); ?>">Display</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
					
						</ul>
					</div>
					<!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">

					</div>
					<!-- /.navbar-custom-menu -->
				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>
		<div class="content-wrapper" style="background:url('<?=base_url('images/backx.jpg');?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
			  <!-- Main content -->
			  <section class="content">
					<?php $this->load->view($content); ?>
			  </section>
			  <!-- /.content -->
		</div>		
		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs">
				<!--	<b>Version</b> <?php echo $this->settings->info['ver']; ?> -->
				</div>
				<strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?=$this->settings->info['owner']; ?></a>.</strong> All rights
				reserved.
			</div>			
		</footer>
		
	</div>
		<!--wrapper-->

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>		
</body>
<script type="text/javascript">

</script>
</html>