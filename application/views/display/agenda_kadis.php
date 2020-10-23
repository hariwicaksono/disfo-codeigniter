<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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