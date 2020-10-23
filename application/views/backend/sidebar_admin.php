<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--<li class="treeview <?=isset($master) ? 'active' : ''; ?>">
	<a href="#">
		<i class="fa fa-database"></i><span>Master</span>
		<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
	</a>
	<ul class="treeview-menu">
		<li class="<?=(isset($kelas) ? 'active' : ''); ?>">
			<a href="<?=site_url('master/kelas'); ?>"><i class="fa fa-circle-o"></i> Kelas</a>
		</li>	
		<li class="<?=(isset($guru) ? 'active' : ''); ?>">
			<a href="<?=site_url('master/guru'); ?>"><i class="fa fa-circle-o"></i> Guru</a>
		</li>		
	</ul>
</li> -->
<li class="treeview <?=isset($display) ? 'active' : ''; ?>">
	<a href="#">
		<i class="fa fa-tv"></i><span>Display</span>
		<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
	</a>
	<ul class="treeview-menu">
		<!--<li class="<?=(isset($jadwal_solat) ? 'active' : ''); ?>">
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
		</li>	-->

		<li class="<?=(isset($news) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/news'); ?>"><i class="fa fa-circle-o"></i> News</a>
		</li>
		<li class="<?=(isset($agenda) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/agenda'); ?>"><i class="fa fa-circle-o"></i> Agenda Instansi</a>
		</li>			 
		<li class="<?=(isset($kadis) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/kadis'); ?>"><i class="fa fa-circle-o"></i> Agenda Rapat</a>
		</li>	
		<li class="<?=(isset($disdik) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/disdik'); ?>"><i class="fa fa-circle-o"></i> Pengumuman Akademik</a>
		</li>	
		<li class="<?=(isset($skripsi) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/skripsi'); ?>"><i class="fa fa-circle-o"></i> Jadwal Skripsi</a>
		</li>
		<li class="<?=(isset($kp) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/kp'); ?>"><i class="fa fa-circle-o"></i> Jadwal KP</a>
		</li>		
	<!--<li class="<?=(isset($tema) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/tema'); ?>"><i class="fa fa-circle-o"></i> Tema Per Minggu</a>
		</li>		
		<li class="<?=(isset($jam_pelajaran) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/jam_pelajaran'); ?>"><i class="fa fa-circle-o"></i> Jam Pelajaran</a>
		</li>
		<li class="<?=(isset($hari_belajar) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/hari_belajar'); ?>"><i class="fa fa-circle-o"></i> Hari Belajar</a>
		</li>		
		<li class="<?=(isset($jadwal_pelajaran) ? 'active' : ''); ?>">
			<a href="javascript:void(0);" OnClick="load_hari();"><i class="fa fa-circle-o"></i> Jadwal Pelajaran</a>-->
		</li>		
		<li class="<?=(isset($event) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/event'); ?>"><i class="fa fa-circle-o"></i> Event Hari Ini</a>
		</li>	
		<li class="<?=(isset($event_bulan) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/event/bulan'); ?>"><i class="fa fa-circle-o"></i> Event Bulan Ini</a>
		</li>			
		<li class="<?=(isset($gallery) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/gallery'); ?>"><i class="fa fa-circle-o"></i> Gallery Images</a> 
		</li>			
		<li class="<?=(isset($video) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/video'); ?>"><i class="fa fa-circle-o"></i> Video</a>
		</li>	
		<li class="<?=(isset($cuaca) ? 'active' : ''); ?>">
			<a href="<?=site_url('input/cuaca'); ?>"><i class="fa fa-circle-o"></i> Cuaca</a>
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
		<a href="<?=site_url('settings/general'); ?>"><i class="fa fa-circle-o"></i> General Settings</a>
	</li>	
	<li class="<?=isset($app) ? 'active' : ''; ?>">
		<a href="<?=site_url('settings/app'); ?>"><i class="fa fa-circle-o"></i> App Settings</a>
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