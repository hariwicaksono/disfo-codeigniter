<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if($data_mengajar->num_rows()>0){
	$noguru=0;
	foreach($data_mengajar->result() as $guru){
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
					<h3 class="media-heading" style="color:#fff!important;">Jam Ke : <?=$guru->jam_ke; ?></h3>
					<h3 class="media-heading" style="color:#fff!important;">Kelas : <?=$guru->nm_kelas; ?></h3>
					<h3 class="media-heading" style="color:#fff!important;"><?=$guru->ket; ?></h3>
				</div>
			</div>					
		</div>
	</div>							
<?php
	}
}else{
	echo "Tidak ada kegiatan belajar mengajar pada jam ini.";
}
?>