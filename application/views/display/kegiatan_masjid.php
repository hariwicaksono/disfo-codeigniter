<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
	<?php
	if($data_kegiatan->num_rows()>0){
		$no_agenda=0;
		foreach($data_kegiatan->result() as $kegiatan){
			$no_agenda++;
	?>
		<div class="item <?php echo ($no_agenda==1 ? "active" : ""); ?>">
			<div class="body bg-red" style="padding:2px 5px 2px 15px;">
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
	}
	?>
	</div>
</div>