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
					<table class="table" id="tb-jam">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Jam Ke</th>
								<th>Start</th>
								<th>End</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $jam){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td><?=$jam->jam_ke; ?></td>
								<td><?=$jam->awal; ?></td>
								<td><?=$jam->akhir; ?></td>
								<td>
									<a href="javascript:void(0);" class="btn btn-flat btn-xs btn-primary" OnClick="load_edit('<?=$jam->id; ?>')">
										<i class="fa fa-edit"><span> Edit</span></i>
									</a>
									<a href="<?=site_url('input/jam_pelajaran/hapus/'.$jam->id); ?>" class="btn btn-flat btn-xs btn-danger">
										<i class="fa fa-trash"><span> Delete</span></i>
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="3">No Jam Pelajaran data, please add new jam pelajaran item.</td>
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
	$.post(_BASE_URL + 'input/jam_pelajaran/add',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-jam-pelajaran').modal('show');
	},'html');
}
function load_edit(idjam){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/jam_pelajaran/edit',{id:idjam},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-jam-pelajaran').modal('show');
	},'html');
}
</script>