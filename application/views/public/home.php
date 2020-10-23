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
}
</style>
<div class="row">
	<div class="col-sm-6 pull-right text-right">
		<b><h1 class="judul-home">DISPLAY INFORMASI</h1></b>
		<p class="text-white"><i>
			Tampilkan informasi dengan digital viewer, sangat mudah
			input data anda, setting, dan tampilkan. Informasi lebih dapat diterima dan 
			menarik untuk dilihat. Pastikan informasi anda dibaca dengan Display Informasi.
		</i></p>
		<div class="form-group">
			<a href="<?=site_url('login'); ?>" class="btn bg-orange btn-md">Login</a>
			<a href="<?=site_url('display'); ?>" class="btn bg-purple btn-md">Display</a>
		</div>
	</div>
</div>