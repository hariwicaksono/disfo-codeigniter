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
				<div class="box-body">
					<?php if(isset($type)){ ?>
					<div class="alert <?=$type; ?>">
						<?=$message; ?>
					</div>
					<?php } ?>								
					<table class="table" id="tb-agenda">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Nama Agenda</th>
								<th>Tempat/Tanggal/Waktu</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $agenda){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td><?=$agenda->nama_agenda; ?></td>
								<td>
									<?=$agenda->tmp_agenda; ?><br />
									<?=$agenda->tgl_agenda; ?><br />
									<?=$agenda->waktu; ?>
								</td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-sm" OnClick="load_edit(<?=$agenda->id; ?>)">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?=site_url('input/agenda/hapus/'. $agenda->id); ?>" class="btn btn-danger btn-sm">
										<i class="fa fa-edit"></i> Hapus
									</a>									
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="4">No data available ....</td>
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
    $('#tb-agenda').DataTable();
});
function load_new(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/agenda/load_new',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-agenda').modal('show');
	},'html');
}
function load_edit(idagenda){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/agenda/edit',{id:idagenda},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-agenda').modal('show');
	},'html');
}
</script>