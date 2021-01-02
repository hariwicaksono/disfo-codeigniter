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
					<div class="alert <?=$type; ?>">
						<?=$message; ?>
					</div>
					<?php } ?>								
					<table class="table" id="tb-news">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>News</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $news){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td><?=$news->tgl_news; ?></td>
								<td><?=$news->txt_news; ?></td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-sm" OnClick="load_edit('<?=$news->id; ?>')">
										<i class="fa fa-edit"><span></i> Edit</span>
									</a>
									<a href="<?=site_url('input/news/hapus/'.$news->id); ?>" class="btn btn-danger btn-sm">
										<i class="fa fa-trash"><span></i> Hapus</span>
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="3">No News data, please add new news ticker item.</td>
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
    $('#tb-news').DataTable();
});
function load_new(){
	$('.contetnt-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/news/add',function(f){
		$('#modalku').html(f);
		$('.contetnt-wrapper').LoadingOverlay('hide');
		$('#modal-news').modal('show');
	},'html');
}
function load_edit(idnews){
	$('.contetnt-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/news/edit',{id:idnews},function(f){
		$('#modalku').html(f);
		$('.contetnt-wrapper').LoadingOverlay('hide');
		$('#modal-news').modal('show');
	},'html');
}
</script>