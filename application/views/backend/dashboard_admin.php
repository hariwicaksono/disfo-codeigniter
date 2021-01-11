<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
	<div class="col-sm-12">
		<div class="content body">
		  <section id="setting">
			<h2>1. Setting Aplikasi</h2>
			<p class="lead">
				Lakukan pengaturan aplikasi melalui menu Pengaturan, dalam menu pengaturan terdapat 
				menu General Settings dan App Settings.	</p>
				<a href="<?=site_url('settings/general'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Pengaturan Umum</a>
				<a href="<?=site_url('settings/app'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Pengaturan App</a>
		
		  </section>	  	
		  <section id="input-display">
			<h2>2. Input Data Display</h2>
			<p class="lead">
				Hal yang terpenting adalah menginputkan data Display yaitu data-data yang akan ditampilkan pada
				layar Display Informasi seperti :
			</p>
			<p>
				<ul>
					<li>Berita</li>
					<li>Agenda</li>
					<li>Jadwal Sholat</li>
					<li>Video</li>
				</ul>
			</p>
			<p  class="lead">
				Untuk penggunaan pertama kali, lakukanlah sesuai dengan urutan diatas, anda dapat mengakses semua itu
				di menu Display.
				</p>
				<a href="<?=site_url('input/news'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Berita</a>
				<a href="<?=site_url('input/agenda'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Agenda</a>
				<a href="javascript:void(0);" OnClick="load_bulan();" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Jadwal</a>
				<a href="<?=site_url('input/video'); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Video</a>
			
		  </section>	
		  <section id="php-ini">
			<h2>3. Pengaturan file php.ini</h2>
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
			<h2>4. Pengaturan Profil Anda</h2>
			<p class="lead">
				Lakukan pengaturan profil dan password akun anda di menu profil.	</p>
				<a href="<?=site_url($this->session->url_profile); ?>" class="btn btn-primary btn-md">Go <i class="fa fa-arrow-right"></i> Profil</a>
		
		  </section>	
		  <section id="display-show">
			<h2>5. Jalankan Display</h2>
			<p class="lead">
				Setelah semua siap hubungkan perangkat anda ke TV LED. Logout dan klik Menu Display untuk menjalankan tampilan Display Informasi anda. Tekan tombol 
				keyboard F11 untuk fullscreen view. (minimum resolution TV 1366 x 768)
			</p>
		  </section>
		</div>
	</div>
</div>				
