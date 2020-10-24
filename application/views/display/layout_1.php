<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper" style="background:url('<?=base_url('images/'.$this->settings->info['background']);?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
	<div class="row transparan" style="margin-bottom: 3rem;">
		<div class="col-sm-4" id="box-logo">
			<img style="margin:0 auto;margin-top: 10px;" id="logo" class="img-responsive" src="<?php echo base_url('images/'.($this->settings->info['logo']=="" ? 'logo.png' : $this->settings->info['logo'])); ?>" width="100" />
		</div>
		<div class="col-sm-8" id="judul_parent">
			<span id="judul_1"><?=$this->settings->info['nama_instansi']; ?></span><br />
			<span id="judul_2"><?=$this->settings->info['alamat']; ?></span>
		</div>	
	</div>	
	<div class="row">
		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-3">
					<?php 
					if($jadwal_solat->num_rows()>0){
						$solat=$jadwal_solat->row();
						$subuh =$solat->subuh;
						$duha=$solat->duha;
						$dzuhur=$solat->dzuhur;
						$ashar=$solat->ashar;
						$magrib=$solat->magrib;
						$isya=$solat->isya;
					}
					?>				
					<div class="body bg-blue text-center up-card" style="margin-top:5px;">
						<span class="header-agenda">JADWAL SHALAT</span>
					</div>	
					<div class="card">
						<div class="body bg-blue-grey text-center">
							<span class="nm-solat">Subuh</span><br />
							<span class="waktu-solat"><?php echo (isset($subuh) ? $subuh : "-"); ?></span>
						</div>
					</div>	
					<div class="card">
						<div class="body bg-red text-center">
							<span class="nm-solat">Dzuha</span><br />
							<span class="waktu-solat"><?php echo (isset($duha) ? $duha : "-"); ?></span>
						</div>
					</div>
					<div class="card">
						<div class="body bg-cyan text-center">
							<span class="nm-solat">Dzuhur</span><br />
							<span class="waktu-solat"><?php echo (isset($dzuhur) ? $dzuhur : "-"); ?></span>
						</div>
					</div>
					<div class="card">
						<div class="body bg-green text-center">
							<span class="nm-solat">Ashar</span><br />
							<span class="waktu-solat"><?php echo (isset($ashar) ? $ashar : "-"); ?></span>
						</div>
					</div>
					<div class="card">
						<div class="body bg-orange text-center">
							<span class="nm-solat">Maghrib</span><br />
							<span class="waktu-solat"><?php echo (isset($magrib) ? $magrib : "-"); ?></span>
						</div>
					</div>
					<div class="card">
						<div class="body bg-pink text-center">
							<span class="nm-solat">Isya</span><br />
							<span class="waktu-solat"><?php echo (isset($isya) ? $isya : "-"); ?></span>
						</div>
					</div>					
				</div>
				<div class="col-sm-9">
					<div class="embed-responsive embed-responsive-4by3">
						<video id="my-player" autoplay controls muted>					
					  
						</video>
					</div>						
				</div>
			</div>
			 
		</div>
		<div class="col-sm-3">
			<div class="card right-card" id="bulan-ini">
				<div class="body bg-red text-center up-card">
					<span class="header-agenda"><?=$this->settings->info['name_agenda_instansi']; ?></span>
				</div>	
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" id="isi-event">
					<?php 
					if($agenda_instansi->num_rows()>0){
						$noevent=0;
						foreach($agenda_instansi->result() as $event){
							$noevent++;
							$date=strtotime($event->tgl_agenda);
							$nama_event=$event->nama_agenda;
							$tgl_event=hari(date("D", $date)) . ", " .date("d",$date) . " " . str_bulan(date("n",$date)) . " " . date("Y",$date);
							$tmp_event=$event->tmp_agenda;
							$waktu_event=$event->waktu;							
					?>
						<div class="item <?php echo ($noevent==1 ? "active" : ""); ?>">
							<div class="body bg-cyan" style="padding:2px 5px 2px 15px;">
								<h4 class="number" style="line-height:1;" id="nama-event"><?=$nama_event; ?></h4>
								<p>
									<span id="tgl-event" style="font-size:14pt;"><?=$tgl_event; ?></span><br />
									<span id="tmp-event" style="font-size:14pt;"><?=$tmp_event; ?></span><br />
									<span><h4 style="line-height:0.6;" id="waktu-event"><?=$waktu_event; ?> - Selesai</h4></span>
								</p>
							</div>
						</div>						
						<?php
						  }
					  }else{
					  ?>
						  <div class="item active">
						  <div class="body bg-cyan" style="padding:2px 5px 2px 15px;">
							<p>
								Tidak ada event / kegiatan untuk bulan ini, yang tercatat di sistem
							</p>
						  </div>	
						  </div>		  
					  <?php
					  }
					  ?>
					</div>
				</div>	  
			</div>
			<div id="carousel-example-generic" class="carousel slide right-card" data-ride="carousel">
				<div class="body bg-orange text-center up-card">
					<span class="header-agenda">GALLERY PHOTOS</span>
				</div>				
				<div class="carousel-inner" role="listbox" id="slide-photos">
				<?php 
				if($data_gallery->num_rows()>0){
					$i=0;
					foreach($data_gallery->result() as $gallery){
						$i++;
				?>
					<div class="item <?php echo ($i==1 ? 'active' : ''); ?>">
						<img src="<?php echo base_url('images/gallery/'.($gallery->image_url=="" ? 'no_thumbnail.jpg' : $gallery->image_url)); ?>">
						<div class="carousel-caption">
							<h3><?=$gallery->label; ?></h3>
							<p><?=$gallery->deskripsi; ?></p>
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
<!--first slide-->
<div id="tanggal-jam" class="text-center">
	<p id="hari" style="color: white;"><?=strtoupper(hari(date("D"))); ?>, <?=strtoupper(date('d F Y')); ?></p>
	<p id="waktu" style="color: white;"></p>
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
	cek_agenda();
}, <?=$this->settings->info['agenda_refresh']; ?> * 1000);

var intervalSolat = setInterval( function(){
	cek_waktu_solat();
}, 1000);

var intervalGuruSlide = setInterval( function(){
	cek_guru();
	cek_photos();
}, <?=$this->settings->info['slide_refresh']; ?> * 1000); //setiap 5 menit

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

function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('waktu').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
  
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}

function cek_news(){
	$.post(_BASE_URL + 'display/cek_news',function(f){
		$('.header-text').html(f);
	},'text');
}
function cek_agenda(){
	$.post(_BASE_URL + 'display/cek_agenda',function(f){
		$('#isi-event').html(f);
	},'html');
}
function cek_photos(){
	$.post(_BASE_URL + 'display/cek_photos',function(f){
		$('#slide-photos').html(f);
	},'html');	
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

</script>