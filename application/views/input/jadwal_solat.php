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
				<a href="javascript:void(0);" class="btn btn-flat btn-xs btn-primary" OnClick="load_import(<?=$id_bulan; ?>)"><i class="fa fa-file-excel-o"></i> Import</a>
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
					<table class="table" id="tb-solat">
						<thead class="bg-black">
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Imsak</th>
								<th>Subuh</th>
								<th>Terbit</th>
								<th>Duha</th>
								<th>Dzuhur</th>
								<th>Ashar</th>
								<th>Magrib</th>
								<th>Isya</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							$no=0;
							foreach($data->result() as $solat){
								$no++;
						?>
							<tr>
								<td><?=$no; ?></td>
								<td><?=$solat->tanggal; ?></td>
								<td><?=$solat->imsak; ?></td>
								<td><?=$solat->subuh; ?></td>
								<td><?=$solat->terbit; ?></td>
								<td><?=$solat->duha; ?></td>
								<td><?=$solat->dzuhur; ?></td>
								<td><?=$solat->ashar; ?></td>
								<td><?=$solat->magrib; ?></td>
								<td><?=$solat->isya; ?></td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="3">No Jadwal Sholat data, please add new Jadwal Sholat item.</td>
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
	<div class ="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-body">
					<h4>Cara Memperbaharui Jadwal Sholat</h4>
					<ol>
						<li>Klik Menu Import</li>
						<li>Download blanko</li>
						<li>Kemudian akses ke website Kementrian Agama di <a href="https://bimasislam.kemenag.go.id/jadwalshalat">BIMAS ISLAM</a></li>
						<li>Pilih provinsi - kabupaten/kota - bulan - tahun </li>
						<li>Klik Menu Proses Data (Icon Search)</li>
						<li>Setelah tampil jadwal sholat klik Menu Export Excel (icon download)</li>
						<li>Buka kedua file yang telah kita download, file blanko dari system, dan file dari Kemenag</li>
						<li>Copy data dari kemenag ke blanko dan save</li>
						<li>Pada aplikasi Disfo klik import file blanko yang sudah kita isi tersebut</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready( function () {
    $('#tb-solat').DataTable();
});
function load_import(id){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/jadwal_solat/load_import',{id_bulan:id},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-import').modal('show');
	},'html');
}
</script>