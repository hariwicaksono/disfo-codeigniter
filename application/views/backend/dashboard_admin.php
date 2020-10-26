<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
	<div class="col-sm-12">
		<div class="content body">
		  <p class="lead">
			Bacalah panduan ini dengan baik, dan jika anda masih belum memahaminya,
			silahkan hubungi kami di Contact Center.
		  </p>
		  <section id="setting">
			<h2 class="page-header">1. Setting Aplikasi</h2>
			<p class="lead">
				Lakukan pengaturan aplikasi melalui menu Pengaturan, dalam menu pengaturan terdapat 
				menu General Settings dan App Settings.<br />
				<a href="<?=site_url('settings/general'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> General Settings</a>
				<a href="<?=site_url('settings/app'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> App Settings</a>
			</p>
		  </section>	  	
		  <section id="input-display">
			<h2 class="page-header">2. Input Data Display</h2>
			<p class="lead">
				Hal yang terpenting adalah menginputkan data Display yaitu data-data yang akan ditampilkan pada
				layar Display Informasi seperti :
			</p>
			<p>
				<ul>
					<li>News</li>
					<li>Agenda</li>
					<li>Jadwal Sholat</li>
					<li>Video</li>
				</ul>
			</p>
			<p  class="lead">
				Untuk penggunaan pertama kali, lakukanlah sesuai dengan urutan diatas, anda dapat mengakses semua itu
				di menu Display.
				<br />
				<a href="<?=site_url('input/news'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> News</a>
				<a href="<?=site_url('input/agenda'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Agenda</a>
				<a href="javascript:void(0);" OnClick="load_bulan();" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Jadwal</a>
				<a href="<?=site_url('input/video'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Video</a>
			</p>
		  </section>	
		  <section id="php-ini">
			<h2 class="page-header">3. Pengaturan file php.ini</h2>
			<p class="lead">
				Pengaturan file php.ini berguna dalam hal upload video ke server anda.
			</p>
			<p>
				<ul>
					<li>Lakukan pengaturan file php.ini di local server anda atau web server anda</li>
					<li>Berikan parameter sebagai berikut :</li>
						post_max_size: Recommended values are 50M or as large as the maximum file you will be uploading <br />
						upload_max_filesize: Recommended values are 50M or as large as the maximum file you will be uploading <br />
						memory_limit: Recommended values are at least 256M or as large as the maximum file you will be uploading <br />	
						Note: if you're uploading extremely large files (more 500MB each), then you might need to also tweak the following settings:  <br />

						max_input_time in php.ini <br />
						max_execution_time in php.ini <br />
						FcgidMaxRequestLen in Apache, if you're using fastcgi <br />
						FcgidBusyTimeout in Apache, if you're using fastcgi <br />
						FcgidIOTimeout in Apache, if you're using fastcgi <br />
						Timeout in Apache <br />
						LimitRequestBody in Apache <br />							
					<li>Restart Apache Webserver jika anda local host</li>
					<li>Upload file MP4 video</li>
					<li>Jangan lakukan apapun sampai proses upload selesai, setelah anda menekan tombol Upload</li>
				</ul>			
			</p>
		  </section>		
		  <section id="profile">
			<h2 class="page-header">4. Pengaturan Profile Anda</h2>
			<p class="lead">
				Lakukan pengaturan profile dan password akun anda di menu profile. <br />
				<a href="<?=site_url($this->session->url_profile); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Profile</a>
			</p>
		  </section>	
		  <section id="display-show">
			<h2 class="page-header">6. Jalankan Display</h2>
			<p class="lead">
				Setelah semua siap hubungkan perangkat anda ke TV LED. Logout dan klik Menu Display untuk menjalankan tampilan Display Informasi anda. Tekan tombol 
				keyboard F11 untuk fullscreen view. (minimum resolution TV 1366 x 768)<br />
			</p>
		  </section>
		</div>
	</div>
</div>				
