<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper">
	<div class="row transparan" style="padding: 20px 0;margin-bottom: 1rem;">
		<div class="col-sm-1" id="box-logo">
			<img style="margin:auto;margin-left:20px;margin-top: 10px;" id="logo" class="img-responsive" src="<?php echo base_url('images/'.($this->settings->info['logo']=="" ? 'logo.png' : $this->settings->info['logo'])); ?>" width="100" height="100" />
		</div>
		<div class="col-sm-11 text-left" id="judul_parent">
			<span id="judul_1" style="line-height:1;"><strong><?=$this->settings->info['nama_instansi']; ?></strong></span><br/>
			<span id="judul_2"><?=$this->settings->info['alamat']; ?></span>
		</div>	
	</div> 
 
<div class="container-fluid">	

	<div class="row-fluid">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<div style="padding-top:36px">
				<div class="body bg-red-no text-center">
					<span class="header-agenda">CUACA</span>
				</div>
				
				<div class="row listdata bg-red" style="padding:25px 15px;">
				<?php if($sock = @fsockopen('www.google.com', 80)) { ?>
					<p><?=$current_weather['name']?>, <?=$current_weather['sys']['country']?> | <?=$current_weather['weather'][0]['main']?>, <?=$current_weather['weather'][0]['description']?></p>
		                <div class="col-sm-6 level">
		                	<p><strong><?=substr($current_weather['main']['temp'], 0, 2)?></strong> &deg;</p>
		                	<p id="unit">Celcius</p>
		                </div>
		                <div class="col-sm-6 descript">
		                	<p><strong>Low:</strong> <?=$current_weather['main']['temp_min']?>&deg;</p>
		                	<p><strong>High:</strong> <?=$current_weather['main']['temp_max']?>&deg;</p>
		                	<p><strong>Humidity:</strong> <?=$current_weather['main']['humidity']?>%</p>
		                </div>
						<?php } else { ?>
						<h5>Not Connected to Internet</h5>
					<?php } ?>
	            </div>	
			</div>
			<div style="padding-top:36px">
				<div class="body bg-red-no text-center">
					<span class="header-agenda">AGENDA</span>
				</div>				  
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
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
							<div class="body bg-cyan" style="padding:10px 15px;padding-bottom:20px;">
								<h3 class="number" id="nama-event"><?=$nama_event; ?></h3>
								<p>
									<span><h4 id="tgl-event"><?=$tgl_event; ?></h4></span>
									<span><h4 id="tmp-event"><?=$tmp_event; ?></h4></span>
									<span><h4 id="waktu-event"><?=$waktu_event; ?> - Selesai</h4></span>
								</p>
							</div>
						</div>						
						<?php
						  }
					  }else{
					  ?>
						  <div class="item active">
						  <div class="body bg-cyan" style="padding:25px 15px;">
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
		</div>
		<div class="col-sm-8 col-md-8 col-lg-8">
			<div class="embed-responsive embed-responsive-4by3" style="padding-top:40px">
			<!--
			|--------------------------------------------------------------------------
			| Pengaturan Video Dengan Suara dan Tanpa Suara (Muted) 
			|--------------------------------------------------------------------------
			| 1. Video Dengan Suara gunakan ini:
			| <video id="my-player" autoplay controls>					
			|				
			| </video>
			|
			| 2. Video Tanpa Suara gunakan yang ini: 
			| <video id="my-player" autoplay controls muted>					
			|				
			| </video>
			|
			-->
			<video id="my-player" autoplay controls>					
				
			</video>
			</div>		
		</div>
	</div>

	</div>
</div>


<!--first slide-->
<div id="tanggal-jam" class="text-center">
	<p id="hari" style="color: white;"></p>
	<p id="waktu" style="color: white;"></p>
</div>
<div id="slide-container">
	<div id="first-content">
		<span class="header-text">
			<?=$news; ?>
		</span>
	</div> 
</div>

<script>
function displayDate() {
    var date = moment().format('dddd, Do MMMM YYYY');
    $('#hari').html(date);
    setTimeout(displayDate, 1000);
}

function displayTime() {
    var time = moment().format('HH:mm:ss');
    $('#waktu').html(time);
    setTimeout(displayTime, 1000);
}

$(document).ready(function() {
	displayDate();
    displayTime();
});
</script>

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