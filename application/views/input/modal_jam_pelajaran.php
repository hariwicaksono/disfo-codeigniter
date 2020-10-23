<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$jam=$data->row();
		$id_jam=$jam->id;
		$jam_ke=$jam->jam_ke;
		$awal=$jam->awal;
		$akhir=$jam->akhir;
	}
}
?>
<div class="modal fade" id="modal-jam-pelajaran">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		<?php echo form_open('input/jam_pelajaran/simpan',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_jam)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_jam; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label class="col-sm-3">Jam Ke</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="jam_ke" value="<?=isset($jam_ke) ? $jam_ke : "";?>" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Start</label>
					<div class="col-sm-6">
						<div class="input-group" class="col-sm-3">
							<input type="text" class="form-control timepicker" name="awal" value="<?=isset($awal) ? $awal : "";?>" required />
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>	
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Akhir</label>
					<div class="col-sm-6">
						<div class="input-group">
							<input type="text" class="form-control timepicker" name="akhir" value="<?=isset($akhir) ? $akhir : "";?>" required />
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
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
    $('.timepicker').timepicker({
	  showMeridian:false,
      showInputs: false
    });	
});
</script>