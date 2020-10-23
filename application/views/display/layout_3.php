<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper" style="background:url('<?=base_url('images/'.$this->settings->info['background']);?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
	<div class="row transparan" >
		<div class="col-sm-1" id="box-logo">
			<img style="margin:auto;margin-left:20px" id="logo" class="img-responsive" src="<?php echo base_url('images/'.($this->settings->info['logo']=="" ? 'logo.png' : $this->settings->info['logo'])); ?>" width="130" height="130" />
		</div>
		<div class="col-sm-11 text-center" id="judul_parent">
			<span id="judul_1" style="line-height:1.15;"><strong><?=$this->settings->info['nama_instansi']; ?></strong></span><br/>
			<span id="judul_2"><?=$this->settings->info['alamat']; ?></span>
		</div>	
	</div> 

<div class="container-fluid">	

	<div class="row-fluid">
		<div class="col-sm-7 col-md-7 col-lg-7">
			<div class="embed-responsive embed-responsive-4by3" style="padding-top:40px">
				<video id="my-player" autoplay controls muted>					
			  
				</video>
			</div>		
		</div>
		<div class="col-sm-5 col-md-5 col-lg-5">
			<div style="padding-top:36px">
				<div class="body bg-red-no text-center">
					<span class="header-agenda">JADWAL KP</span>
				</div>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
					<?php
					if($jadwal_kp->num_rows()>0){
						$no_kp=0;
						foreach($jadwal_kp->result() as $kp){
							$no_kp++;
					?>
						<div class="item <?php echo ($no_kp==1 ? "active" : ""); ?>">
							<div class="body transparan" style="padding:2px 5px 2px 15px;">
							<h4 class="number" id="nama-event"><?=$kp->npm; ?> / <?=$kp->nama_mhs; ?> &mdash; <?=$kp->txt_kp; ?></h4>
								<p>
									<span id="tgl-event" style="font-size:14pt;"><?=hari(date("D",strtotime($kp->tgl_kp))); ?>, <?=date_format(date_create($kp->tgl_kp),"d F Y"); ?></span> <br/>
									<span id="tmp-event" style="font-size:14pt;">Ruang: <?=$kp->ruang; ?></span><br />
									<span id="waktu-event" style="font-size:14pt;">Waktu: <?=$kp->waktu; ?> - Selesai</span>
								</p>
							</div>
						</div>					
					<?php
						}
					}
					?>
					</div>
				</div>
			</div>
			<div style="padding-top:30px">
				<div class="body bg-red-no text-center">
					<span class="header-agenda">JADWAL SKRIPSI</span>
				</div>				  
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
					<?php
					if($jadwal_skripsi->num_rows()>0){
						$no_skripsi=0;
						foreach($jadwal_skripsi->result() as $skripsi){
							$no_skripsi++;
					?>
						<div class="item <?php echo ($no_skripsi==1 ? "active" : ""); ?>">
							<div class="body transparan" style="padding:2px 5px 2px 15px;">
								<h4 class="number" id="nama-event"><?=$skripsi->npm; ?> / <?=$skripsi->nama_mhs; ?> &mdash; <?=$skripsi->txt_skripsi; ?></h4>
								<p>
									<span id="tgl-event" style="font-size:14pt;"><?=hari(date("D",strtotime($skripsi->tgl_skripsi))); ?>, <?=date_format(date_create($skripsi->tgl_skripsi),"d F Y"); ?></span> <br/>
									<span id="tmp-event" style="font-size:14pt;">Ruang: <?=$skripsi->ruang; ?></span><br />
									<span id="waktu-event" style="font-size:14pt;">Waktu: <?=$skripsi->waktu; ?> - Selesai</span>
								</p>
							</div>
						</div>					
					<?php
						}
					}
					?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row-fluid">
			<div class="col-sm-6">
				<div class="body bg-red-no text-center">
					<span class="header-agenda">BERITA KAMPUS</span>
				</div>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
					<?php 
					if($agenda_kadis->num_rows()>0){
						$no_agenda=0;
						foreach($agenda_kadis->result() as $kadis){
							$no_agenda++;
					?>
						<div class="item <?php echo ($no_agenda==1 ? "active" : ""); ?>">
							<div class="body transparan" style="padding:2px 5px 2px 15px;">
								<h4 class="number" id="nama-event"><?=$kadis->nama_agenda; ?></h4>
								<p>
									<span id="tgl-event" style="font-size:14pt;"><?=hari(date("D",strtotime($kadis->tgl_agenda))); ?>, <?=date_format(date_create($kadis->tgl_agenda),"d F Y"); ?></span><br />
									<span id="tmp-event"><?=$kadis->tmp_agenda; ?></span><br />
									<span><h4 style="line-height:0.6;" id="waktu-event"><?=$kadis->waktu; ?> - Selesai</h4></span>
								</p>
							</div>
						</div>					
					<?php
						}
					}
					?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="body bg-red-no text-center">
					<span class="header-agenda">PENGUMUMAN AKADEMIK</span>
				</div>				  
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
					<?php
					if($agenda_disdik->num_rows()>0){
						$no_agenda=0;
						foreach($agenda_disdik->result() as $disdik){
							$no_agenda++;
					?>
						<div class="item <?php echo ($no_agenda==1 ? "active" : ""); ?>">
							<div class="body transparan" style="padding:2px 5px 2px 15px;">
								<h4 class="number" id="nama-event"><?=$disdik->nama_agenda; ?></h4>
								<p>
									<span id="tgl-event" style="font-size:14pt;"><?=hari(date("D",strtotime($disdik->tgl_agenda))); ?>, <?=date_format(date_create($disdik->tgl_agenda),"d F Y"); ?></span><br />
									<span id="tmp-event"><?=$disdik->tmp_agenda; ?></span><br />
									<span><h4 style="line-height:0.6;" id="waktu-event"><?=$disdik->waktu; ?> - Selesai</h4></span>
								</p>
							</div>
						</div>					
					<?php
						}
					}
					?>
					</div>
				</div>
			</div>
	</div>

	</div>

</div>


<!--first slide-->
<div id="tanggal-jam" class="text-center">
	<!--<p><span id="hari" style="color : black;"><?=strtoupper(hari(date("D"))); ?>, <?=strtoupper(date('d F Y')); ?></span></p>-->
	<p><span id="hari" style="color : black;font-size:26px;"></span></p>
	<span id="waktu" style="color : black;"></span>
</div>
<div id="slide-container">
	<div id="first-content">
		<span class="header-text">
			<?=$news; ?>
		</span>
	</div> 
</div>
<script type="text/javascript">

var jam_ke=0;

var intervalID = setInterval( function(){
	//upward();
}, 3000);

var intervalSolat = setInterval( function(){
	cek_waktu_solat();
}, 1000);

var intervalNewsTicker = setInterval(function(){
	cek_news();
}, <?=$this->settings->info['news_refresh']; ?> * 1000);

var i=0;
var videoSource = <?php echo json_encode($data_video); ?>;
var videoCount = videoSource.length;
document.getElementById("my-player").setAttribute("src",videoSource[0]);
function videoPlay(videoNum)
{
	document.getElementById("my-player").setAttribute("src",videoSource[videoNum]);
	document.getElementById("my-player").load();
	document.getElementById("my-player").play();
}
document.getElementById('my-player').addEventListener('ended',myHandler,false);
function myHandler() {
	if(i == (videoCount-1)){
		i = 0;
		$.post(_BASE_URL + 'display/get_video',function(f){
			videoSource = f;
			videoCount = videoSource.length;
		},'json');
		videoPlay(i);
	}else{
		i++;
		videoPlay(i);
	}
}
function cek_jam_pelajaran(){
	$.post(_BASE_URL + 'display/get_jam_pelajaran',function(f){
		if(f.jam_ke!=jam_ke){
			$('#range-jam').html(f.range_jam);
			$('#jam-ke').html(f.jam_ke);
			jam_ke = f.jam_ke;
			cek_kegiatan(f.id_jam);
			guru_mengajar(f.jam_ke);
		}
	},'json');
}
function cek_kegiatan(int_jam_ke){
	$.post(_BASE_URL + 'display/cek_kegiatan',{id:int_jam_ke},function(f){
		$('#kegiatan').html(f.ket);
		$('#des-keg').html(f.des);
	},'json');	
}
function guru_mengajar(int_jam_ke){
	var xhari ="<?=strtolower(hari(date("D"))); ?>";
	$.post(_BASE_URL + 'display/guru_mengajar',{jam_ke:int_jam_ke,hari:xhari},function(f){
		$('#tb-guru').html(f);
	},'html');		
}
function startTime() {
  var day = new Array();
  day[0] = "Minggu";
  day[1] = "Senin";
  day[2] = "Selasa";
  day[3] = "Rabu";
  day[4] = "Kamis";
  day[5] = "Jum'at";
  day[6] = "Sabtu";
  var month = new Array();
  month[0] = "Januari";
  month[1] = "Februari";
  month[2] = "Maret";
  month[3] = "April";
  month[4] = "Mei";
  month[5] = "Juni";
  month[6] = "Juli";
  month[7] = "Agustus";
  month[8] = "September";
  month[9] = "Oktober";
  month[10] = "November";
  month[11] = "Desember";
  var today = new Date();
  var day = day[today.getDay()];
  var dd = today.getDate();
  var mm = month[today.getMonth()];
  var yyyy = today.getFullYear();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  if(s=="01" || jam_ke==0){
	  cek_jam_pelajaran();
  }
  if(dd<10) {
    dd='0'+dd
  } 
  if(mm<10) {
    mm='0'+mm
  } 
  document.getElementById('hari').innerHTML =
  day+', '+dd+' '+mm+' '+yyyy;
  var t = setTimeout(startTime, 500);

  document.getElementById('waktu').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
  
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}

function cek_waktu_solat(){
	$.post(_BASE_URL + 'display/cek_waktu_solat',function(f){
		if(f.waktu!=""){
			var now = new Date().getTime();
			var countDownDate = new Date(f.waktu).getTime();
			var distance = countDownDate - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = checkTime(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
			var minutes = checkTime(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
			var seconds = checkTime(Math.floor((distance % (1000 * 60)) / 1000));	
			
			$('#count-solat').html(f.jelang + ' ' + hours + ":" + minutes + ":" + seconds);
		}else{
			$('#count-solat').html(f.jelang);
		}
	},'json');		
}
function cek_news(){
	$.post(_BASE_URL + 'display/cek_news',function(f){
		$('.header-text').html(f);
	},'text');
}
</script>