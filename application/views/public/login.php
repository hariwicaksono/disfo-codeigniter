<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.login-box-body{
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	opacity: 0.9;
}
.text-white{
	color: white;
	font-weight:bold;
}
</style>
<div class="row justify-content-center">
<div class="col-sm-4">
	<div class="card card-body">
	<h5 class="card-title mb-3">Sign in to start your session</h5>
		<?php if(isset($type)){ ?>
		<div class="alert <?=$type; ?>">
			<?=$message; ?>
		</div>
		<?php } ?>
		<form action="<?=site_url('login/process'); ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="username" name="username" id="username">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="password" id="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
		</form>

	</div>
	<!-- /.login-box-body -->
	<p class="text-center"><i>
		Login menggunakan hak Administrator untuk melakukan input data dan
		pengaturan aplikasi.
	</i></p>
</div>
</div>
<!-- /.login-box -->
<script type="text/javascript">
$( "#username" ).keydown(function() {
  $(".alert").alert("close");
});
$( "#password" ).keydown(function() {
  $(".alert").alert("close");
});
$( "#password" ).keypress(function( event ) {
  if ( event.which == 13 ) {
     $("form").submit();
  }
});
</script>
