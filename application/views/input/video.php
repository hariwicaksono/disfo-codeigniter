<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
		<div class="col-xs-7">
			<h3 style="margin:0;"><span class="table-header"><?=$title; ?></span></h3>
		</div>
		<div class="col-xs-5">
			<!--for button tools-->
			<div class="box-tools btn-group btn-grid pull-right">
				<a href="<?=site_url('dashboard'); ?>" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-home"></i></a>
				<a href="javascript:void(0);" class="btn btn-flat btn-xs btn-primary" OnClick="load_new()"><i class="fa fa-plus"></i></a>
			</div>				
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-12" >
			<div class="box box-default" >
				<div class="box-body" id="settings-content">
					<?php if(isset($type)){ ?>
					<div class="alert <?=$type; ?>">
						<?=$message; ?>
					</div>
					<?php } ?>								
					<table class="table" id="tb-video">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Video</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $video){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td>
									<?=$video->judul; ?> <br />
									<?=$video->upload_time; ?>
								</td>
								<td>
									<div class="embed-responsive embed-responsive-4by3">
										<video controls>
										  <source src="<?=base_url('uploads/video/'.$video->nm_file); ?>" type="video/mp4">
										  Your browser does not support HTML5 video.
										</video>
									</div>
								</td>
								<td>
									<?=$video->status; ?>
								</td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-xs" OnClick="load_edit('<?=$video->id; ?>')">
										<i class="fa fa-edit"><span> Edit</span></i>
									</a>
									<a href="<?=site_url('input/video/hapus/'.$video->id); ?>" class="btn btn-danger btn-xs">
										<i class="fa fa-trash"><span> Delete</span></i>
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="3">No video data, please add new video item.</td>
							</tr>						
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="box-footer bg-aqua">
					<p>
						<h4>Info : </h4>
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
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready( function () {
    $('#tb-video').DataTable();
});
function load_new(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/video/add',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-upload').modal('show');
	},'html');
}
function load_edit(idvideo){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/video/edit',{id:idvideo},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-video').modal('show');
	},'html');
}

</script>