<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal fade" id="modal-bulan">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/jadwal_solat/show',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					Jadwal Sholat				
				</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3">Pilih Bulan</label>
					<div class="col-sm-6">
						<select class="form-control" name="bulan">
						<?php 
						for($m=1; $m<=12; ++$m){
						?>
							<option value="<?=$m; ?>"><?=str_bulan($m); ?></option>
						<?php
						}						
						?>
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