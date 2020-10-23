<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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