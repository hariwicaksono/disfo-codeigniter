<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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