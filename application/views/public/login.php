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
<div class="row justify-content-center py-3">
<div class="col-sm-4">
	<div class="card card-body">
	<h4 class="card-title mb-3">Sign in to start your session</h4>
		<?php if(isset($type)){ ?>
		<div class="alert <?=$type; ?>">
			<?=$message; ?>
		</div>
		<?php } ?>
		<form action="<?=site_url('login/process'); ?>" method="post">
			<div class="form-group input-group">
				<input type="text" class="form-control" placeholder="username" name="username" id="username">
				<div class="input-group-append">
				<div class="input-group-text"><i class="fa fa-user"></i></div>
				</div>
			</div>
			<div class="form-group input-group">
				<input type="password" class="form-control" placeholder="Password" name="password" id="password">
				<div class="input-group-append">
				<div class="input-group-text"><i class="fa fa-lock"></i></div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Masuk</button>
			</div>
		</form>

	</div>
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
