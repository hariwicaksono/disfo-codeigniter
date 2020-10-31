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
	<!--Style Sheet-->
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet"> 
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">	
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style_2.css'); ?>">

	<?php if($this->settings->info['layout']=="layout_1"){ ?>
	<link rel="stylesheet" href="<?=base_url('assets/display/css/style_1.css'); ?>" media="screen" type="text/css" />
    <?php } ?>		

	<?php if($this->settings->info['layout']=="layout_2"){ ?>
	<link rel="stylesheet" href="<?=base_url('assets/display/css/style_2.css'); ?>" media="screen" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/plugins/rotate/simpletextrotator.css'); ?>" media="screen" type="text/css" />
	<?php } ?>	

	<?php if($this->settings->info['layout']=="layout_3"){ ?>
	<link rel="stylesheet" href="<?=base_url('assets/display/css/style_3.css'); ?>" media="screen" type="text/css" />
	<?php } ?>	
	
	<link rel="stylesheet" href="<?=base_url('assets/display/css/animate.css'); ?>" media="screen" type="text/css" />
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/rotate/jquery.simple-text-rotator.min.js'); ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
	<script type="text/javascript">
		const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';			
	</script>	
</head>
<body onload="startTime()">
	<?php $this->load->view($content); ?>	
</body>
</html>