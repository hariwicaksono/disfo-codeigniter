<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<table class="table">
	<thead class="bg-black">
		<tr>
			<th>No</th>
			<th><i class="fa fa-gear"></i></td>
			<th>Deskripsi</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		if($data->num_rows() > 0){
			$no=0;
			foreach($data->result() as $settings){
				$no++;
	?>
		<tr>
			<td><?=$no; ?></td>
			<td><a href="javascript:void(0);" OnClick="edit(<?=$settings->id; ?>)"><i class="fa fa-edit fa-lg"></i></a></td>
			<td><?=$settings->deskripsi_setting; ?></td>
			<td>
			<?php 
			if($settings->variable_setting=="tp_aktif") {
				$query=$this->db->get_where('tahun_pelajaran',array('idtp' => $settings->value_setting));
				$tp=$query->row();
				$value="Semester " . $tp->semester . " " . $tp->nama_tp;
			}else{
				$value=$settings->value_setting;
			}
			echo $value;
			?>
			</td>
		</tr>
	<?php
			}
		}else{ 
	?>
		<tr>
			<td>
			Tidak ada data yang tersedia
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
function edit(x){
	var l ={
		id : x
	};
	$('.content').LoadingOverlay('show');
	$.post(_BASE_URL + 'settings/general/edit',l,function(f){
		$('.content').LoadingOverlay('hide');
		$('#modalku').html(f);
		$('#modal-settings').modal('show');
	},'html');
}
</script>