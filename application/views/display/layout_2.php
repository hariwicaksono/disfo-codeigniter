<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$hijri= GregorianToHijri(time());
?>
<div class="wrapper" style="background:url('<?=base_url('images/'.$this->settings->info['background']);?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
	<div class="row" id="atas">
		<div class="col-sm-4">
			<div class="card time-card">
				<div class="body bg-green up-card">
					<div class="row" id="display-waktu">
						<div class="col-sm-6 text-center">
							<span id="hari"><?=strtoupper(hari(date("D"))); ?></span><br />
							<span id="tanggal"><?=date('d F Y'); ?></span><br />
							<span id="tanggal"><?php echo $hijri[1] . " " . monthName($hijri[0]) . " " . $hijri[2]; ?></span>
						</div>
						<div class="col-sm-6 number text-center" id="waktu">
						
						</div>						
					</div>
				</div>
			</div>			
		</div>
		<div class="col-sm-8 up-card">
			<div class="row time-card">
				<div class="col-sm-3 up-card" style="margin:auto;">
					<img id="logo" class="img-responsive" src="<?php echo base_url('images/'.($this->settings->info['logo']=="" ? 'logo.png' : $this->settings->info['logo'])); ?>" width="130" height="130" />
				</div>
				<div class="col-sm-9 up-card" id="judul_parent">
					<span id="judul_1">DISPLAY INFORMASI</span><br />
					<span id="judul_2"><?=$this->settings->info['nama_instansi']; ?></span><br />
					<span id="judul_3"><?=$this->settings->info['alamat']; ?></span>
				</div>				
			</div>
		</div>
	</div>
	<div class="row" id="tengah">
		<div class="col-sm-4">
			<?php
			$str_tema="";
			$str_sub_tema="";			
			$query_tema=$this->db->get('tema');
			if($query_tema->num_rows()>0){
				foreach($query_tema->result() as $tema){
					$start_date=strtotime($tema->start_date);
					$end_date=strtotime($tema->end_date);
					$now_date=strtotime(date("Y-m-d"));
					if(($now_date>=$start_date) && ($now_date<=$end_date)){
						$str_tema=$tema->tema;
						$str_sub_tema=$tema->sub_tema;
					}
				}
			}
			?>

			<div class="card left-card">
				<div class="body bg-blue-grey text-center tema">
					<span class="judul-utama">PENGUMUMAN:</span><br />
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
			<div class="card left-card" id="bulan-ini">
				<div class="body bg-orange text-center up-card">
					<span class="judul-utama-2">EVENT BULAN INI</span>
				</div>				  
				<div class="body bg-pink" style="padding:2px 5px 2px 15px;">
					<h4 class="number" style="line-height:0.6;" id="nama-event"><?=$event_bulan_ini['nama_event']; ?></h4>
					<p>
						<span id="tgl-event" style="font-size:14pt;"><?=$event_bulan_ini['tgl_event']; ?></span><br />
						<span id="tmp-event"><?=$event_bulan_ini['tmp_event']; ?></span><br />
						<span><h4 style="line-height:0.6;" id="waktu-event"><?=$event_bulan_ini['waktu_event']; ?></h4></span>
					</p>
				</div>		  
			</div>			
			<div id="carousel-example-generic" class="carousel slide left-card" data-ride="carousel">
				<div class="body bg-orange text-center up-card">
					<span class="judul-utama-2">GALLERY PHOTOS</span>
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
				<div id="slide-container">
					<div id="first-content">
						<span class="header-text">
							<?=$news; ?>
						</span>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
<!--first slide-->

<script type="text/javascript">

var intervalID = setInterval( function(){
	cek_tema();
	cek_event_bulan();
}, 3000);

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
	$.post(_BASE_URL + 'display/cek_event_bulan',function(f){
		$('#nama-event').html(f.nama_event);
		$('#tgl-event').html(f.tgl_event);
		$('#tmp-event').html(f.tmp_event);
		$('#waktu-event').html(f.waktu_event);
	},'json');
}
function cek_tema(){
	$.post(_BASE_URL + 'display/cek_tema',function(f){
		$('.sub-judul').html(f.tema);
		$('.sub-tema').html(f.sub_tema);
	},'json');
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