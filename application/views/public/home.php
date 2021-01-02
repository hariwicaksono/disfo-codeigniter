<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.judul-home {
	font-size:8vw;
	font-weight:bold;
	-webkit-text-stroke: 1px black;
	color: white;
	text-shadow:
	   3px 3px 0 #000,
	 -1px -1px 0 #000,  
	  1px -1px 0 #000,
	  -1px 1px 0 #000,
	   1px 1px 0 #000;
}
.text-white{
	color: white;
	font-weight:bold;
	text-shadow:
	   3px 3px 0 #000,
	 -1px -1px 0 #000,  
	  1px -1px 0 #000,
	  -1px 1px 0 #000,
	   1px 1px 0 #000;
}
</style>
<div class="row justify-content-center">
	<div class="col-9">
	<div class="text-center">
		<b><h1 class="judul-home">DISPLAY INFORMASI</h1></b>
		<h3 class="text-white my-3"><i>
			Tampilkan informasi dengan Display Informasi. Pemakaian sangat mudah hanya dengan IST (Input, Setting, dan Tampilkan).
		</i></h3>
		<div class="form-group">
			<a href="<?=site_url('login'); ?>" class="btn btn-warning btn-lg"><i class="fa fa-sign-in"></i> Login</a>
			<a href="<?=site_url('display'); ?>" class="btn btn-success btn-lg"><i class="fa fa-tv"></i> Display</a>
		</div>
	</div>
	</div>
</div>