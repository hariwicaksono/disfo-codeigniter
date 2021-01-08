<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="transparan" id="judul-atas">
	<div class="row">
		<div class="col-md-3 col-lg-3" id="calendar">
			<div id="hari"><?=hari(date("D")); ?></div>
			<div id="tanggal"><?=date("d M Y"); ?></div>
		</div>
		<div class="col-md-6 col-lg-6" id="instansi">
			<div id="nama-instansi" class="text-center"><?=$this->settings->info['nama_instansi']; ?></div>
			<div id="alamat-instansi" class="text-center"><?=$this->settings->info['alamat']; ?></div>
			<div id="alamat-lain" class="text-center">No. Telp / HP : <?=$this->settings->info['phone_instansi']; ?> Email : <?=$this->settings->info['mail']; ?></div>
		</div>	
		<div class="col-md-3 col-lg-3" id="jam">
			<div class="number text-center" id="waktu"></div>
		</div>		
	</div>
</div>
<div id="judul-atas-2">
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="card">
				<div class="body bg-red" id="isi-jumatan">
				<?php 
				if($data_jumat->num_rows()>0){
					$jumat=$data_jumat->row();
				?>
					JADWAL JUMAT
					<table class="table table-condensed">
						<tr>
							<th>IMAM</th>
							<td><?=$jumat->imam; ?></td>
						</tr>
						<tr>
							<th>KHOTIB</th>
							<td><?=$jumat->khotib; ?></td>
						</tr>
						<tr>
							<th>MUADZIN</th>
							<td><?=$jumat->muazin; ?></td>
						</tr>
						<tr>
							<th>TEMA KHOTBAH</th>
							<td><?=$jumat->judul_khotbah; ?></td>
						</tr>						
					</table>
				<?php } ?>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div class="card">
				<div class="body bg-red" id="isi-kegiatan">
				KEGIATAN BULAN INI
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
						<?php
						if($data_kegiatan->num_rows()>0){
							$no_agenda=0;
							foreach($data_kegiatan->result() as $kegiatan){
								$no_agenda++;
						?>
							<div class="item <?php echo ($no_agenda==1 ? "active" : ""); ?>">
								<div style="padding:2px 5px 2px 15px;">
									<h4 id="nama-event"><?=$kegiatan->nama_kegiatan; ?></h4>
									<p>
										<span id="tgl-event" style="font-size:14pt;"><?=$kegiatan->tmp_kegiatan; ?></span><br />
										<span id="tgl-event" style="font-size:12pt;">
											<?=hari(date("D",strtotime($kegiatan->tgl_kegiatan))); ?>, <?=date_format(date_create($kegiatan->tgl_kegiatan),"d F Y"); ?>											
											<?=$kegiatan->waktu; ?>
										</span>
									</p>
								</div>
							</div>					
							<?php
						  }
					  }else{
					  ?>
						  <div class="item active">
							<p>
								Tidak ada event / kegiatan untuk bulan ini, yang tercatat di sistem
							</p>
						  </div>			  
					  <?php
					  }
					  ?>	
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>
<div class="wrapper" style="background:url('<?=base_url('images/'.$this->settings->info['background']);?>') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
	<div class="row" id="info-sholat">
		<div class="col-md-12 col-lg-12">
			<div class="row" id="row-keuangan">
				<div class="col-md-8 col-lg-8" id="info-keuangan">
					
				</div>
				<div class="col-md-4 col-lg-4" id="info-transaksi">
					Transaksi Keuangan: <br />
					<span class="rotate"><?=$data_transaksi; ?></span>
				</div>
			</div>		
			<div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4 pull-right transparan-abu text-center" style="margin-bottom:5px;">
					<span id="count-solat" class="jelang"></span>
				</div>			
			</div>
			<div class="row">
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
				<div class="col-md-12 col-lg-12 transparan" style="padding-top:20px;">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="card">
							<div class="body bg-blue-grey text-center">
								<span class="nm-solat">Subuh</span><br />
								<span class="waktu-solat" id="subuh"><?php echo (isset($subuh) ? $subuh : "-"); ?></span>
							</div>
						</div>
					</div>			
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="card">
							<div class="body bg-red text-center">
								<span class="nm-solat">Duha</span><br />
								<span class="waktu-solat" id="duha"><?php echo (isset($duha) ? $duha : "-"); ?></span>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="card">
							<div class="body bg-cyan text-center">
								<span class="nm-solat">Dzuhur</span><br />
								<span class="waktu-solat" id="dzuhur"><?php echo (isset($dzuhur) ? $dzuhur : "-"); ?></span>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="card">
							<div class="body bg-green text-center">
								<span class="nm-solat">Ashar</span><br />
								<span class="waktu-solat" id="ashar"><?php echo (isset($ashar) ? $ashar : "-"); ?></span>
							</div>
						</div>
					</div>	
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="card">
							<div class="body bg-orange text-center">
								<span class="nm-solat">Magrib</span><br />
								<span class="waktu-solat" id="magrib"><?php echo (isset($magrib) ? $magrib : "-"); ?></span>
							</div>
						</div>
					</div>	
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="card">
							<div class="body bg-pink text-center">
								<span class="nm-solat">Isya</span><br />
								<span class="waktu-solat" id="isya"><?php echo (isset($isya) ? $isya : "-"); ?></span>
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
		<div class="header-text">
			<marquee scrollamount="8" id="teks-berjalan"><?=$news; ?></marquee>
		</div>
	</div> 
</div>
<script type="text/javascript">
var intervalKeuangan = setInterval( function(){
	cek_keuangan();
},1000);

var intervalSolat = setInterval( function(){
	cek_waktu_solat();
}, 1000);

var intervalDay = setInterval( function(){
	cek_date();
}, 3000);

var intervalCekSholat = setInterval( function(){
	cek_sholat()
}, 4000);

var intervalNewsTicker = setInterval(function(){
	cek_news();
}, <?=$this->settings->info['news_refresh']; ?> * 1000);

var intervalCekTransaksi = setInterval(function(){
	cek_transaksi();
	cek_jumatan();
	cek_kegiatan();
}, 120000);
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
		$('#teks-berjalan').html(f);
	},'text');
}
function cek_date(){
	$.post(_BASE_URL + 'display/cek_date',function(f){
		$('#hari').html(f.hari);
		$('#tanggal').html(f.tanggal);
	},'json');
}
function cek_keuangan(){
	$.post(_BASE_URL + 'display/cek_keuangan',function(f){
		$('#info-keuangan').html(f);
	},'text');
}
function cek_sholat(){
	$.post(_BASE_URL + 'display/cek_sholat',function(f){
		$('#subuh').html(f.subuh);
		$('#duha').html(f.duha);
		$('#dzuhur').html(f.dzuhur);
		$('#ashar').html(f.ashar);
		$('#magrib').html(f.magrib);
		$('#isya').html(f.isya);
	},'json');	
}
function cek_transaksi(){
	$.post(_BASE_URL + 'display/cek_transaksi/text',function(f){
		$('.rotate').html(f);
	},'text');	
}
function cek_jumatan(){
	$.post(_BASE_URL + 'display/jumatan',function(f){
		$('#isi-jumatan').html(f);
	},'html');	
}
function cek_kegiatan(){
	$.post(_BASE_URL + 'display/kegiatan_masjid',function(f){
		$('#isi-kegiatan').html(f);
	},'html');	
}
$(".rotate").textrotator({
	animation: "flipUp", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
	separator: "|", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
	speed: 5000 // How many milliseconds until the next word show.
});
</script>