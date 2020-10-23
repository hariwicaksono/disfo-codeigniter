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
					<table class="table table-border" id="tb-hari">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Tingkat</th>
								<th>Nama Kelas</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $kelas){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td><?=$kelas->tingkat; ?></td>
								<td><?=$kelas->nm_kelas; ?></td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-xs" OnClick="load_edit(<?=$kelas->id; ?>)">
										<i class="fa fa-pencil"></i> Edit
									</a>
									<a href="<?=site_url('master/kelas/hapus/'.$kelas->id); ?>" class="btn btn-danger btn-xs">
										<i class="fa fa-trash"></i> Delete
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="8">No Kelas data, please add new kelas item.</td>
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
function load_new(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'master/kelas/add',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-kelas').modal('show');
	},'html');
}
function load_edit(idkelas){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'master/kelas/edit',{id:idkelas},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-kelas').modal('show');
	},'html');
}
</script>