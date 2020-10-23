<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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