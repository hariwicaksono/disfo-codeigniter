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
					<table class="table" id="tb-event">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Waktu</th>
								<th>Event</th>
								<th>Tempat</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $event){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td>
									<?=$event->tanggal; ?> <br />
									<?=$event->waktu_mulai; ?>-<?=$event->waktu_akhir; ?>
								</td>
								<td><?=$event->nm_event; ?></td>
								<td><?=$event->tempat; ?></td>
								<td>
									<a href="javascript:void(0);" class="btn btn-flat btn-xs btn-default text-light-blue" OnClick="load_edit('<?=$event->id; ?>')">
										<i class="fa fa-edit"><span> Edit</span></i>
									</a>
									<a href="<?=site_url('input/event/hapus/'.$event->id); ?>" class="btn btn-flat btn-xs btn-default text-red">
										<i class="fa fa-trash"><span> Delete</span></i>
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="3">No event data, please add new event item.</td>
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
    $('#tb-event').DataTable();
});
function load_new(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/event/add',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-event').modal('show');
	},'html');
}
function load_edit(idevent){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/event/edit',{id:idevent},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-event').modal('show');
	},'html');
}
</script>