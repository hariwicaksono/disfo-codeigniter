<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
			<h4 class="number" style="line-height:1;" id="nama-event"><?=$nama_event; ?></h4>
			<p>
				<span id="tgl-event" style="font-size:14pt;"><?=$tgl_event; ?></span><br />
				<span id="tmp-event" style="font-size:14pt;"><?=$tmp_event; ?></span><br />
				<span><h3 style="line-height:0.6;" id="waktu-event"><?=$waktu_event; ?></h3></span>
			</p>
		</div>
	</div>						
<?php	
	}
}
?>