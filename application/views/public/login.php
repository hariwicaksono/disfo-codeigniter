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
<div class="col-md-4 col-xs-12 pull-right kotak">
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
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
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

	</div>
	<!-- /.login-box-body -->
	<p class="text-white text-right"><i>
		Login menggunakan hak Administrator untuk melakukan input data dan
		pengaturan aplikasi. User dengan hak akses biasa tidak dapat melakukan pengaturan
		pada aplikasi.
	</i></p>
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
