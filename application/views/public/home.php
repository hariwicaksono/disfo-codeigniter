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
	<div class="col-sm-10">
	<div class="text-center">
		<b><h1 class="judul-home">DISPLAY INFORMASI</h1></b>
		<h3 class="text-white my-3"><i>
			Tampilkan informasi dengan digital viewer, sangat mudah
			input data anda, setting, dan tampilkan. Informasi lebih dapat diterima dan 
			menarik untuk dilihat. Pastikan informasi anda dibaca dengan Display Informasi.
		</i></h3>
		<div class="form-group">
			<a href="<?=site_url('login'); ?>" class="btn btn-danger">Login</a>
			<a href="<?=site_url('display'); ?>" class="btn btn-warning">Display</a>
		</div>
	</div>
	</div>
</div>