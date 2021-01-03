<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<li class="treeview <?=isset($display) ? 'active' : ''; ?>">
	<a href="#">
		<i class="fa fa-tv"></i><span>Display</span>
		<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
	</a>
	<ul class="treeview-menu">
		<li class="<?=(isset($news) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/news'); ?>"><i class="fa fa-circle-o"></i> Berita</a>
		</li>
		<li class="<?=(isset($agenda) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/agenda'); ?>"><i class="fa fa-circle-o"></i> Agenda</a>
		</li>			 					
		<li class="<?=(isset($gallery) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/gallery'); ?>"><i class="fa fa-circle-o"></i> Foto Galeri</a> 
		</li>			
		<li class="<?=(isset($video) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/video'); ?>"><i class="fa fa-circle-o"></i> Video</a>
		</li>	
		<li class="<?=(isset($cuaca) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/cuaca'); ?>"><i class="fa fa-circle-o"></i> Cuaca</a>
		</li>	
		<li class="<?=(isset($jadwal_solat) ? 'active' : ''); ?>">
			<a href="javascript:void(0);" OnClick="load_bulan();"><i class="fa fa-circle-o"></i> Jadwal Sholat</a>
		</li>
		<li class="<?=(isset($jumatan) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/jumatan'); ?>" ><i class="fa fa-circle-o"></i> Imam, Khotib Jum'at</a>
		</li>
		<li class="<?=(isset($kegiatan_masjid) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/kegiatan_masjid'); ?>" ><i class="fa fa-circle-o"></i> Kegiatan Masjid</a>
		</li>	
		<li class="<?=(isset($keuangan_masjid) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/keuangan_masjid'); ?>" ><i class="fa fa-circle-o"></i> Keuangan Masjid</a>
		</li>	
	</ul>
</li>
<li class="treeview <?=isset($settings) ? 'active' : ''; ?>">
  <a href="#">
	<i class="fa fa-gear"></i>
	<span>Pengaturan</span>
	<span class="pull-right-container">
	  <i class="fa fa-angle-left pull-right"></i>
	</span>
  </a>
  <ul class="treeview-menu">
	<li class="<?=isset($general) ? 'active' : ''; ?>">
		<a href="<?=site_url('settings/general'); ?>"><i class="fa fa-circle-o"></i> Pengaturan Umum</a>
	</li>	
	<li class="<?=isset($app) ? 'active' : ''; ?>">
		<a href="<?=site_url('settings/app'); ?>"><i class="fa fa-circle-o"></i> Pengaturan App</a>
	</li>		
  </ul>
</li>
<script type="text/javascript">
function load_hari(){
	$('body').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/jadwal_pelajaran/load_hari',function(f){
		$("#modalku").html(f);
		$('body').LoadingOverlay('hide');
		$('#modal-hari').modal('show');
	},'html');
}
function load_bulan(){
	$('body').LoadingOverlay('show');
	$.post(_BASE_URL + 'input/jadwal_solat/load_bulan',function(f){
		$("#modalku").html(f);
		$('body').LoadingOverlay('hide');
		$('#modal-bulan').modal('show');
	},'html');
}
</script>