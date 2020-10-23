<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="modal fade" id="modal-isi">
  <div class="modal-dialog modal-lg"">
	<div class="modal-content">
	<?php echo form_open_multipart('input/jadwal_pelajaran/simpan',array('id' => 'frm-jadwal', 'class' => 'form-horizontal')); ?>
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"><?=$modal_title; ?></h4>
	  </div>
	  <div class="modal-body">
			<div class="row">
				<div class="col-sm-6">
					<input type="hidden" name="hari" value="<?=$hari; ?>" />
					<input type="hidden" name="jam_ke" value="<?=$jam_ke; ?>" />
					<div class="form-group">
			  <?php 
			  if($data_kelas->num_rows()>0){
				  foreach($data_kelas->result() as $kls){
					  $qjadwal=$this->db->get_where('jadwal_pelajaran',array('id_kelas' => $kls->id, 'jam_ke' => $jam_ke, 'hari' => $hari));
					  $kode_guru="";
					  if($qjadwal->num_rows()>0){
						  $jadwal=$qjadwal->row();
						  $kode_guru=$jadwal->kode_guru;
					  }
			  ?>
					
						
						<div class="col-sm-2 text-center">
							<label><?=$kls->nm_kelas; ?></label>
							<input type="hidden" name="id_kelas[]" value="<?=$kls->id; ?>" />
							<input type="text" class="form-control" name="kode_guru[]" value="<?=$kode_guru; ?>" required />
						</div>
					
			  <?php
				  }
			  }
			  ?>
					</div>
				</div>
				<div class="col-sm-6">
					<table class="table" id="tb-guru">
						<thead class="bg-gray">
							<tr>
								<th>Nama Guru</th>
								<th>Kode</th>
							</tr>
						</thead>
						<tbody class="bg-aqua">
						<?php 
						if($data_guru->num_rows()>0){
							foreach($data_guru->result() as $guru){
						?>
							<tr>
								<td><?=$guru->nama_lengkap; ?></td>
								<td><?=$guru->kode_guru; ?></td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>	 
		<?php echo form_close(); ?>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
$(document).ready( function () {
    $('#tb-guru').DataTable();
});
</script>