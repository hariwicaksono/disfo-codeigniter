<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper" style="background:url('<?=base_url('images/'.$this->settings->info['background']);?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
	<div class="row" id="atas">
		<div class="col-md-12 col-lg-12">
			<div class="col-md-4 col-lg-4" id="kiri">
				<div class="info-box-4 bg-light-blue hover-zoom-effect">
					<div class="icon">
						<i class="material-icons">access_alarm</i>
					</div>
					<div class="content" style="line-height:1.2;">
						<div class="text" style="margin-top: 0px;">
							<span id="range-jam"></span> <br />
							Jam Ke
						</div>
						<div class="number"><span id="jam-ke"></span></div>
					</div>			
					<div class="content" style="line-height:1.2;">
						<div class="text" style="margin-top: 0px;">
							<?=hari(date("D")); ?><br />
							<?=date("d M Y"); ?>
						</div>
						<div class="number" id="waktu"></div>
					</div>
				</div>
				<div class="card">
					<div class="header bg-red">
						<h2>
							Event Hari Ini<small><b>Kegiatan Sekolah Hari Ini</b></small>
						</h2>
					</div>
					<div class="body">
					  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
					  <?php
					  if($data_event->num_rows()>0){
						  $no_event=0;
						  foreach($data_event->result() as $event){
							  $no_event++;
					  ?>
						  <div class="item <?php echo ($no_event==1 ? "active" : ""); ?>">
							<div class="card">
								<div class="body bg-pink">
									<h4><?=$event->nm_event; ?></h4>
									<p>
										<span><?=$event->tempat; ?></span><br />
										<span class="number"><?=$event->waktu_mulai; ?>-<?=$event->waktu_akhir; ?> WIB</span>
									</p>
								</div>
							</div>
						  </div>			  
					  <?php
						  }
					  }else{
					  ?>
						  <div class="item active">
							<div class="card">
								<div class="body bg-pink">
									<h4>No Event Added</h4>
									<p>
										Tidak ada event / kegiatan untuk hari ini, yang tercatat di sistem
									</p>
								</div>
							</div>
						  </div>			  
					  <?php
					  }
					  ?>				
						</div>
					  </div>
					</div>
				</div>	
			</div>
			<div class="col-md-8 col-lg-8" id="kanan">
				<div class="row">
					<div id="judul" class="text-center">
						<h1>DISPLAY INFORMASI</h1>
						<p><h3><?=$this->settings->info['nama_instansi']; ?></h3></p>
						<p id="alamat"><?=$this->settings->info['alamat']; ?></p>
					</div>
				</div>
				<div class="row" id="main-content" style="overflow:hidden;height:100%;">
					<div class="col-lg-4" id="event">
						<div class="transparan" style="height:100%;">
							<h3 class="text-center">
								<span id="kegiatan"></span><br />
								<span id="des-keg" style="font-size:10pt;line-height:0px;"></span>
							</h3>
							<div class="transparan" style="height:315px; overflow:hidden;">
								<table style="width:100%;">
									<tbody id="tb-guru">
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-8" id="media" style="padding-bottom:0px;">
						<div class="transparan" style="height:100%">
							<div class="embed-responsive embed-responsive-4by3">
							<video id="my-player" autoplay controls muted>					
							  
							</video>
							</div>
						</div>			
					</div>
						
				</div>
			</div>
		</div>
	</div>

</div>
<!--first slide-->
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
	upward();
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
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  if(s=="01" || jam_ke==0){
	  cek_jam_pelajaran();
  }
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