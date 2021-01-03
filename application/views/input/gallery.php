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
				<a href="<?=site_url('dashboard'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-home"></i></a>
				<a href="javascript:void(0);" class="btn btn-sm btn-primary" OnClick="load_new()"><i class="fa fa-plus"></i> Tambah</a>
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
					<div class="alert <?=$type; ?> alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?=$message; ?>
					</div>
					<?php } ?>								
					<table class="table table-border" id="tb-images">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Images</th>
								<th>Label</th>
								<th>Description</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $images){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td>
									<img class="img-responsive" src="<?php echo base_url('images/gallery/'.($images->image_url=="" ? 'no_thumbnail.jpg' : $images->image_url)); ?>" width="150px" height="100%" alt="Image">
								</td>
								<td>
									<?=$images->label; ?>
								</td>
								<td><?=$images->deskripsi; ?></td>
								<td>
									<?php echo ($images->status==1 ? "Aktif" : "Tidak Aktif"); ?>
								</td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-sm" OnClick="load_edit(<?=$images->id; ?>)">
										<i class="fa fa-pencil"></i> Edit
									</a>
									<a href="<?=site_url('input/gallery/hapus/'.$images->id); ?>" class="btn btn-danger btn-sm">
										<i class="fa fa-trash"></i> Hapus
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="6">Belum ada Galeri Gambar</td>
							</tr>						
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready( function () {
    $('#tb-images').DataTable();
});
function load_new(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/gallery/add',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-upload').modal('show');
	},'html');
}
function load_edit(idimage){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/gallery/edit',{id:idimage},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-upload').modal('show');
	},'html');
}
</script>