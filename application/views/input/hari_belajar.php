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
								<th colspan="2" class="text-center">Jam Ke</th>
								<th>Senin</th>
								<th>Selasa</th>
								<th>Rabu</th>
								<th>Kamis</th>
								<th>Jum'at</th>
								<th>Sabtu</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows()>0){
							foreach($data->result() as $jam){
						?>
							<tr>
								<td class="text-center"><?=$jam->jam_ke; ?></td>
								<td class="text-center"><?=$jam->awal; ?>-<?=$jam->akhir; ?></td>
						<?php
							$query=$this->db->get_where('hari_belajar',array('id_jam_pelajaran' => $jam->id));
							if($query->num_rows()>0){
								$hari=$query->row();
								$id_hari=$hari->id;
								$senin=kegiatan($hari->senin)['id'];
								$selasa=kegiatan($hari->selasa)['id'];
								$rabu=kegiatan($hari->rabu)['id'];
								$kamis=kegiatan($hari->kamis)['id'];
								$jumat=kegiatan($hari->jumat)['id'];
								$sabtu=kegiatan($hari->sabtu)['id'];
							}else{
								$senin="";
								$selasa="";
								$rabu="";
								$kamis="";
								$jumat="";
								$sabtu="";								
							}
						?>
								<td class="<?php echo ($senin=="Istirahat" ? "bg-orange" : "");?>"><?php echo (isset($senin) ? $senin : ""); ?> </td>
								<td class="<?php echo ($selasa=="Istirahat" ? "bg-orange" : "");?>"><?php echo (isset($selasa) ? $selasa : ""); ?></td>
								<td class="<?php echo ($rabu=="Istirahat" ? "bg-orange" : "");?>"><?php echo (isset($rabu) ? $rabu : ""); ?></td>
								<td class="<?php echo ($kamis=="Istirahat" ? "bg-orange" : "");?>"><?php echo (isset($kamis) ? $kamis : ""); ?></td>
								<td class="<?php echo ($jumat=="Istirahat" ? "bg-orange" : "");?>"><?php echo (isset($jumat) ? $jumat : ""); ?></td>
								<td class="<?php echo ($sabtu=="Istirahat" ? "bg-orange" : "");?>"><?php echo (isset($sabtu) ? $sabtu : ""); ?></td>
								<td>
									<a href="javascript:void(0);" class="btn btn-primary btn-xs" OnClick="isi(<?=$jam->id; ?>)">
										<i class="fa fa-pencil"></i> Isi
									</a>
								</td>
							</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="8">No Jam Pelajaran data, please add new jam pelajaran item.</td>
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
function isi(idjam){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/hari_belajar/edit',{id:idjam},function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-hari-belajar').modal('show');
	},'html');
}
</script>