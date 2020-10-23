<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper" style="background:url('<?=base_url('images/'.$this->settings->info['background']);?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
	<div class="row transparan" >
		<div class="col-sm-2" id="box-logo">
			<img style="margin:auto;" id="logo" class="img-responsive" src="<?php echo base_url('images/'.($this->settings->info['logo']=="" ? 'logo.png' : $this->settings->info['logo'])); ?>" width="70" height="70" />
		</div>
		<div class="col-sm-10 text-center" id="judul_parent">
			<span id="judul_1"><?=$this->settings->info['nama_instansi']; ?></span><br />
			<span id="judul_2"><?=$this->settings->info['alamat']; ?></span>
		</div>	
	</div>	
	<div class="row" id="tengah">
		<div class="col-sm-8">
			<div class="embed-responsive embed-responsive-4by3">
				<video id="my-player" autoplay controls muted>					
			  
				</video>
			</div>
			<div id="element">
				<div id="nama-guru" style="background:url('<?=base_url('images/app/back_foto.png');?>') no-repeat; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;;">
					<div id="jabatan" class="text-center">
						<h5>GURU</h5>
					</div>
					<div id="guru-info">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner" id="tempat-guru">
							<?php
							if($data_guru->num_rows()>0){
								$noguru=0;
								foreach($data_guru->result() as $guru){
									$noguru++;
							?>
								<div class="item <?php echo ($noguru==1 ? "active" : ""); ?>" style="padding-left:20px;">
									<div class="body">
										<div class="media">
											<div class="media-left">
												<a href="javascript:void(0);">
													<img class="media-object" src="<?php echo base_url('images/photo/'.($guru->foto=="" ? '64x64.png' : $guru->foto)); ?>" width="64" height="64">
												</a>
											</div>
											<div class="media-body">
												<h4 class="media-heading" style="color:#fff!important;"><?=$guru->nama_lengkap; ?></h4> 
												<span style="color:#fff!important;"><?=$guru->tmp_lahir; ?>, <?=date("d F Y", strtotime($guru->tgl_lahir)); ?></span>
												<h3 class="media-heading" style="color:#fff!important;">GURU : <?=$guru->ket; ?></h3>
											</div>
										</div>					
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
		<div class="col-sm-4">
			<div class="card right-card" id="bulan-ini">
				<div class="body bg-orange text-center up-card">
					<span class="header-agenda">EVENT BULAN INI</span>
				</div>	
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" id="isi-event">
					<?php 
					if($event_bulan_ini->num_rows()>0){
						$noevent=0;
						foreach($event_bulan_ini->result() as $event){
							$noevent++;
							$date=strtotime($event->tgl_event);
							$nama_event=$event->nama_event;
							$tgl_event=hari(date("D", $date)) . ", " .date("d",$date) . " " . str_bulan(date("n",$date)) . " " . date("Y",$date);
							$tmp_event=$event->tmp_event;
							$waktu_event=$event->waktu;							
					?>
						<div class="item <?php echo ($noevent==1 ? "active" : ""); ?>">
							<div class="body bg-cyan" style="padding:2px 5px 2px 15px;">
								<h4 class="number" style="line-height:1;" id="nama-event"><?=$nama_event; ?></h4>
								<p>
									<span id="tgl-event" style="font-size:14pt;"><?=$tgl_event; ?></span><br />
									<span id="tmp-event"><?=$tmp_event; ?></span><br />
									<span><h4 style="line-height:0.6;" id="waktu-event"><?=$waktu_event; ?> - Selesai</h4></span>
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
			<div class="card right-card">
				<div class="body bg-red text-center up-card">
					<span class="header-agenda">AGENDA KEPALA DINAS</span>
				</div>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" id="isi-agenda">
					<?php
					if($agenda_kadis->num_rows()>0){
						$no_agenda=0;
						foreach($agenda_kadis->result() as $kadis){
							$no_agenda++;
					?>
						<div class="item <?php echo ($no_agenda==1 ? "active" : ""); ?>">
							<div class="body bg-cyan" style="padding:2px 5px 2px 15px;">
								<h4 class="number" style="line-height:1;" id="nama-event"><?=$kadis->nama_agenda; ?></h4>
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
	<span id="hari" style="color : white;"><?=strtoupper(hari(date("D"))); ?>, <?=strtoupper(date('d F Y')); ?></span><br />
	<span id="waktu" style="color : white;"></span>
</div>
<div id="slide-container">
	<div id="first-content">
		<span class="header-text">
			<?=$news; ?>
		</span>
	</div> 
</div>

<script type="text/javascript">

var intervalID = setInterval( function(){
	cek_event_bulan();
	cek_agenda_kadis();
}, <?=$this->settings->info['agenda_refresh']; ?> * 1000);

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
function cek_event_bulan(){
	$.post(_BASE_URL + 'display/cek_event_bulan_slide',function(f){
		$('#isi-event').html(f);
	},'html');
}
function cek_agenda_kadis(){
	$.post(_BASE_URL + 'display/cek_agenda_kadis',function(f){
		$('#isi-agenda').html(f);
	},'html');
}
function cek_guru(){
	$.post(_BASE_URL + 'display/cek_guru',function(f){
		$('#tempat-guru').html(f);
	},'html');	
}
function cek_photos(){
	$.post(_BASE_URL + 'display/cek_photos',function(f){
		$('#slide-photos').html(f);
	},'html');	
}
</script>