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
					<table class="table table-border">
						<thead class="bg-black">
							<tr>
								<th colspan="2" rowspan="2" class="text-center" style="vertical-align:middle;">Jam Ke</th>
								
							<?php
							if($rombel->num_rows()>0){
								$jml_rombel=$rombel->num_rows();
							?>
								<th colspan="<?=$jml_rombel; ?>" class="text-center">KELAS</th>
								<th rowspan="2" class="text-center" style="vertical-align:middle;">Action</th>
							</tr>
							<tr>
							<?php
								foreach($rombel->result() as $kelas){
							?>
								<th><?=$kelas->nm_kelas; ?></th>
							<?php
								}
							}
							?>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($jampel->num_rows()>0){
							foreach($jampel->result() as $jam){
						?>
							<tr>
								<td class="text-center"><?=$jam->jam_ke; ?></td>
								<td class="text-center"><?=$jam->awal; ?>-<?=$jam->akhir; ?></td>
						<?php 
						if($rombel->num_rows()>0){
							foreach($rombel->result() as $kelas){
						?>
								<td class="text-center">
						<?php 
								$hari_belajar=$this->db->select("id, $str_hari")
										->from('hari_belajar')
										->where('id_jam_pelajaran',$jam->id)
										->get();
								if($hari_belajar->num_rows()>0){
									$hari=$hari_belajar->row();
									$kegiatan=$hari->$str_hari;
								
						?>
								<?php if($kegiatan==1){ //KBM ?> 
									<a href="javascript:void(0);" class="btn btn-primary btn-xs" OnClick="isi_guru();">
									<?php 
									$kriteria=array('hari' => $str_hari, 'jam_ke' => $jam->jam_ke, 'id_kelas' => $kelas->id);
									$jadwal=$this->db->get_where('jadwal_pelajaran',$kriteria);
									if($jadwal->num_rows()>0){
										$data_jadwal=$jadwal->row();
										$kode_guru=$data_jadwal->kode_guru;
										echo $kode_guru;
									}else{
										echo "Set";
									}
									?>
									</a>
								<?php }else{ ?>
									<a href="javascript:void(0);" class="btn btn-default btn-xs">
										X
									</a>
								<?php } ?>
								</td>
						<?php
								}
							}
						?>
								<?php if($kegiatan==1){ //KBM ?> 
								<td class="text-center">
									<a href="javascript:void(0);" class="btn btn-warning btn-xs" OnClick="isi_guru_masal('<?=$str_hari; ?>',<?=$jam->jam_ke; ?>);">
										Isi Sekaligus
									</a>								
								</td>
								<?php } ?>
						<?php
						}
						?>
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
				<div class="box-footer">
					<p><small>* Isi dengan kode guru pada kegiatan KBM</small></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
function isi_guru(){
	alert('isi dengan Kode Guru');
}
function isi_guru_masal(hari,jam_ke){
	var items={
		'hari' : hari,
		'jam_ke' : jam_ke
	};
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/jadwal_pelajaran/load_isi',items,function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-isi').modal('show');
	},'html');
}
</script>