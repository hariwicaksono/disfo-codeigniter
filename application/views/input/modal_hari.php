<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

?>
<div class="modal fade" id="modal-hari">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/jadwal_pelajaran/show',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					Jadwal Pelajaran				
				</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3">Pilih Hari</label>
					<div class="col-sm-4">
						<select class="form-control" name="hari">
							<option value="senin">Senin</option>
							<option value="selasa">Selasa</option>
							<option value="rabu">Rabu</option>
							<option value="kamis">Kamis</option>
							<option value="jumat">Jumat</option>
							<option value="sabtu">Sabtu</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Lihat Jadwal</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">

</script>