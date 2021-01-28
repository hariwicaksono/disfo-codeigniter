<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper">
		<div class="col-sm-2" id="box-logo">
			<img style="margin:0 auto;margin-top: 10px;" id="logo" class="img-responsive" src="<?php echo base_url('images/'.($this->settings->info['logo']=="" ? 'logo.png' : $this->settings->info['logo'])); ?>" width="100" />
		</div>
		<div class="col-sm-6" id="judul_parent">
			<span id="judul_1"><strong><?=$this->settings->info['nama_instansi']; ?></strong></span><br />
			<span id="judul_2"><?=$this->settings->info['alamat']; ?></span>
		</div>	
		<div class="col-sm-4">
		
	                <div class="row listdata">
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
						<h4>Not Connected to Internet</h4>
					<?php } ?>
	                </div>
		</div>
	</div>	
	<div class="row-fluid justify-content-center">
		<div class="col-sm-8">
			<div class="embed-responsive embed-responsive-4by3">
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
		<div class="col-sm-4">
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
								<h4 class="number" id="nama-event"><?=$nama_event; ?></h4>
								<p>
									<span><h4 id="tgl-event"><?=$tgl_event; ?></h4></span>
									<span><h5 id="tmp-event"><?=$tmp_event; ?></h5></span>
									<span><h5 id="waktu-event"><?=$waktu_event; ?> - Selesai</h5></span>
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
			<br/>
			<div id="carousel-example-generic" class="carousel slide right-card " data-ride="carousel">
				<div class="body bg-orange text-center up-card">
					<span class="header-agenda">FOTO GALERI</span>
				</div>				
				<div class="carousel-inner" role="listbox" id="slide-photos">
				<?php 
				if($data_gallery->num_rows()>0){
					$i=0;
					foreach($data_gallery->result() as $gallery){
						$i++;
				?>
					<div class="item <?php echo ($i==1 ? 'active' : ''); ?>">
						<img src="<?php echo base_url('images/gallery/'.($gallery->image_url=="" ? 'no_thumbnail.jpg' : $gallery->image_url)); ?>" >
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

	<div id="info-sholat">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-lg-3 pull-right transparan-abu text-center">
				<span id="count-solat" class="jelang"></span>
			</div>			
		</div>
	<?php if($this->settings->info['jadwal_sholat']=="api") {?>

<?php if($sock = @fsockopen('www.google.com', 80)) { ?>
	<?php
	foreach($jadwal_solat["results"]["datetime"] as $value){
		$imsak = $value['times']['Imsak'];
		$subuh = $value['times']['Fajr'];
		$dzuhur=$value['times']['Dhuhr'];
		$ashar=$value['times']['Asr'];
		$magrib=$value['times']['Maghrib'];
		$isya=$value['times']['Isha'];
	}

	?>
	<div class="row no-gutters">
	
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-red text-center">
					<h2 class="nama-solat">Imsak</h2>
					<span class="waktu-solat" id="imsak"><?php echo (isset($imsak) ? $imsak : "-"); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-blue-grey text-center">
					<h2 class="nama-solat" style=>Subuh</h2>
					<span class="waktu-solat" id="subuh"><?php echo (isset($subuh) ? $subuh : "-"); ?></span>
				</div>
			</div>
		</div>			
		
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-cyan text-center">
					<h2 class="nama-solat">Dzuhur</h2>
					<span class="waktu-solat" id="dzuhur"><?php echo (isset($dzuhur) ? $dzuhur : "-"); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-green text-center">
					<h2 class="nama-solat">Ashar</h2>
					<span class="waktu-solat" id="ashar"><?php echo (isset($ashar) ? $ashar : "-"); ?></span>
				</div>
			</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-orange text-center">
					<h2 class="nama-solat">Magrib</h2>
					<span class="waktu-solat" id="magrib"><?php echo (isset($magrib) ? $magrib : "-"); ?></span>
				</div>
			</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-pink text-center">
					<h2 class="nama-solat">Isya</h2>
					<span class="waktu-solat" id="isya"><?php echo (isset($isya) ? $isya : "-"); ?></span>
				</div>
			</div>
		</div>
								
	</div>

	<?php } else { ?>
		<div class="card">
				<div class="card-body bg-red text-center" style="padding: 7px 0">
		<i class="fa fa-exclamation-triangle"></i> Perhatian! Anda tidak terhubung ke Internet atau Ganti pengaturan jadwal sholat menjadi mode Manual Excel.
		</div>
		</div>
	<div class="row no-gutters">
						
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-red text-center">
					<h2 class="nama-solat">Imsak</h2>
					<span class="waktu-solat" id="imsak">-</span>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-blue-grey text-center">
					<h2 class="nama-solat" style=>Subuh</h2>
					<span class="waktu-solat" id="subuh">-</span>
				</div>
			</div>
		</div>			
		
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-cyan text-center">
					<h2 class="nama-solat">Dzuhur</h2>
					<span class="waktu-solat" id="dzuhur">-</span>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-green text-center">
					<h2 class="nama-solat">Ashar</h2>
					<span class="waktu-solat" id="ashar">-</span>
				</div>
			</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-orange text-center">
					<h2 class="nama-solat">Magrib</h2>
					<span class="waktu-solat" id="magrib">-</span>
				</div>
			</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-pink text-center">
					<h2 class="nama-solat">Isya</h2>
					<span class="waktu-solat" id="isya">-</span>
				</div>
			</div>
		</div>
								
	</div>
	
	<?php } ?>	
	<?php } else { ?>
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
	<div class="row no-gutters">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-blue-grey text-center">
					<h2 class="nama-solat" style=>Subuh</h2>
					<span class="waktu-solat" id="subuh"><?php echo (isset($subuh) ? $subuh : "-"); ?></span>
				</div>
			</div>
		</div>			
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-red text-center">
					<h2 class="nama-solat">Duha</h2>
					<span class="waktu-solat" id="duha"><?php echo (isset($duha) ? $duha : "-"); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-cyan text-center">
					<h2 class="nama-solat">Dzuhur</h2>
					<span class="waktu-solat" id="dzuhur"><?php echo (isset($dzuhur) ? $dzuhur : "-"); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-green text-center">
					<h2 class="nama-solat">Ashar</h2>
					<span class="waktu-solat" id="ashar"><?php echo (isset($ashar) ? $ashar : "-"); ?></span>
				</div>
			</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-orange text-center">
					<h2 class="nama-solat">Magrib</h2>
					<span class="waktu-solat" id="magrib"><?php echo (isset($magrib) ? $magrib : "-"); ?></span>
				</div>
			</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="card">
				<div class="card-body bg-pink text-center">
					<h2 class="nama-solat">Isya</h2>
					<span class="waktu-solat" id="isya"><?php echo (isset($isya) ? $isya : "-"); ?></span>
				</div>
			</div>
		</div>							
	</div>


	<?php }?>	

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
	cek_agenda();
}, <?=$this->settings->info['agenda_refresh']; ?> * 1000);

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
function cek_sholat(){
	$.post(_BASE_URL + 'display/cek_sholat',function(f){
		$('#subuh').html(f.subuh);
		$('#dzuhur').html(f.dzuhur);
		$('#ashar').html(f.ashar);
		$('#magrib').html(f.magrib);
		$('#isya').html(f.isya);
	},'json');	
}

</script>