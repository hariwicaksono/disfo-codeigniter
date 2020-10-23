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
			<div class="alert alert-info">
				<h4><i class="icon fa fa-info"></i> Info!</h4>
				Bagian ini hanya untuk Layout 2
			</div>
			<div class="box box-default" >
				<div class="box-body">
					<?php if(isset($type)){ ?>
					<div class="alert <?=$type; ?>">
						<?=$message; ?>
					</div>
					<?php } ?>								
					<table class="table">
						<thead class="bg-gray">
							<tr>
								<th>No</th>
								<th>Tema</th>
								<th>Sub Tema</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $tema){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td><?=$tema->tema; ?></td>
								<td><?=$tema->sub_tema; ?></td>
								<td><?=$tema->start_date; ?></td>
								<td><?=$tema->end_date; ?></td>
								<td>
									<a href="javascript:void(0);" OnClick="load_edit(<?=$tema->id; ?>)">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?=site_url('input/tema/hapus/'. $tema->id); ?>">
										<i class="fa fa-edit"></i> Hapus
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="5">No data available ....</td>
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
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/tema/load_new',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-tema').modal('show');
	},'html');
}
function load_edit(idtema){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/tema/edit',{id:idtema},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-tema').modal('show');
	},'html');
}
</script>