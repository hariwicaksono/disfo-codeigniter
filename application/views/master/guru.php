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
				<a href="javascript:void(0);" class="btn btn-flat btn-xs btn-primary" OnClick="load_import()"><i class="fa fa-file-excel-o"></i> Import</a>
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
					<table class="table table-border" id="tb-guru">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th><i class="fa fa-gear"></i></th>
								<th>Foto</th>
								<th>Nama Lengkap</th>
								<th>Kode Guru</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $guru){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td>
									<a href="javascript:void(0)" OnClick="upload(<?=$guru->id; ?>)">
										<i class="fa fa-file-image-o"></i>
									</a>
								</td>
								<td>
									<img class="img-responsive" src="<?php echo base_url('images/photo/'.($guru->foto=="" ? 'default.jpeg' : $guru->foto)); ?>" width="50px" height="100%" alt="User Image">
								</td>
								<td>
									<?=$guru->nama_lengkap; ?><br />
									<?=$guru->nip; ?>
								</td>
								<td><?=$guru->kode_guru; ?></td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-xs" OnClick="load_edit(<?=$guru->id; ?>)">
										<i class="fa fa-pencil"></i> Edit
									</a>
									<a href="<?=site_url('master/guru/hapus/'.$guru->id); ?>" class="btn btn-danger btn-xs">
										<i class="fa fa-trash"></i> Delete
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="8">No guru data, please add new guru item.</td>
							</tr>						
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
				<?php 
				if(isset($dataInfo)){
				?>
				<table class="table">
					<thead class="bg-gray">
						<tr>
							<th>NIP</th>
							<th>Nama</th>
							<th>Keterangan Upload</th>
						</tr>
					</thead>
					<tbody>
				<?php
					foreach($dataInfo as $guru_import){
				?>
					<tr>
						<td><?=$guru_import['nip']; ?></td>
						<td><?=$guru_import['nama']; ?></td>
						<td><?=$guru_import['info']; ?></td>
					</tr>
				<?php 
					}
				?>
					</tbody>
				</table>
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready( function () {
    $('#tb-guru').DataTable();
});
function load_new(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'master/guru/add',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-guru').modal('show');
	},'html');
}
function load_edit(idguru){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'master/guru/edit',{id:idguru},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-guru').modal('show');
	},'html');
}
function upload(idx){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'master/guru/add_foto',{id:idx},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-upload').modal('show');
	},'html');
}
function load_import(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'master/guru/load_import',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-import').modal('show');
	},'html');
}
</script>