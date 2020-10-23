<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
if($data_mengajar->num_rows()>0){
	foreach($data_mengajar->result() as $ajar){
?>
	<tr style="border-bottom: 1px solid white;">
		<td style="padding: 7px;"><b><?=$ajar->nama_lengkap; ?></b></td>
		<td style="padding: 7px;" class="text-center"><?=$ajar->nm_kelas; ?></td>
	</tr>
<?php
	}
}else{
	echo "Tidak ada kegiatan belajar mengajar pada jam ini.";
}
?>
<script type="text/javascript">

function upward() {
  var table = document.getElementsByTagName('table');
  var table = table[0];
  var rows = table.getElementsByTagName('tr');
  var shifted = rows[0];
  rows[0].parentNode.removeChild(rows[0]);
  table.appendChild(shifted);
}
</script>