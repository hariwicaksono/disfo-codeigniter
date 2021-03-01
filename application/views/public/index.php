<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
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
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>" type="image/x-icon"><!-- X -->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.css'); ?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	   <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
	<!-- Google Font 
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	
	<script type="text/javascript">
		const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';			
	</script>
</head> 
<body class="hold-transition skin-blue-light layout-top-nav">
	<div class="wrapper">
		<header class="main-header">
			<nav class="navbar navbar-expand-lg navbar-dark navbar-static-top">
				<div class="container">
					
					<a href="<?php echo base_url(); ?>" class="navbar-brand"><b>DISFO </b></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item <?=isset($home) ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
							<li class="nav-item <?=isset($login) ? 'active' : ''; ?>"><a class="nav-link" href="<?=site_url('login'); ?>">Login</a></li>
							<li class="nav-item <?=isset($display) ? 'active' : ''; ?>"><a class="nav-link" href="<?=site_url('display'); ?>">Display</a></li>
						</ul>
						
					</div>
					<!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->

					<!-- /.navbar-custom-menu -->
				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>
		<div class="content-wrapper" style="background:url('<?=base_url('images/Background.png');?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
			  <!-- Main content -->
			  <section class="content py-5">
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
<script src="<?php echo base_url('assets/dist/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>		
</body>
<script type="text/javascript">

</script>
</html>