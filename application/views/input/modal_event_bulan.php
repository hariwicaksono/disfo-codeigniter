<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$event=$data->row();
		$id_event=$event->id;
		$nm_event=$event->nama_event;
		$tgl_event=$event->tgl_event;
		$tempat=$event->tmp_event;
		$waktu=$event->waktu;
		$status=$event->status;
	}
}
?>
<div class="modal fade" id="modal-event">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/event/simpan_event_bulan',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_event)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_event; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label class="col-sm-2">Nama Event</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nama_event" value="<?=isset($nm_event) ? $nm_event : '';?>" required>
					</div>
				</div>			
				<div class="form-group">
					<label class="col-sm-2">Tanggal</label>
					<div class="col-sm-4">
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>					
							<input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tgl_event" value="<?=isset($tgl_event) ? $tgl_event : '';?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2">Tempat</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tmp_event" value="<?=isset($tempat) ? $tempat : '';?>" required>
					</div>
				</div>					
				<div class="form-group">
					<label class="col-sm-2">Waktu</label>
					<div class="col-sm-4">
						<div class="input-group" class="col-sm-3">
							<input type="text" class="form-control timepicker" name="waktu" value="<?=isset($waktu_mulai) ? $waktu_mulai : '';?>" required />
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>				
				</div>	
				<div class="form-group">
					<label class="col-sm-2">Status</label>
					<div class="col-sm-4">
						<select name="status" class="form-control">
							<option value="1" <?php echo(isset($status) && $status==1 ? "selected" : "");?>>Aktif</option>
							<option value="0" <?php echo(isset($status) && $status==0 ? "selected" : "");?>>Tidak Aktif</option>
						</select>
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
$(document).ready(function(){
	$('.datepicker').datepicker({
		todayBtn:true,
		todayHighlight:true
	});
    $('.timepicker').timepicker({
	  showMeridian:false,
      showInputs: false
    });		
});
</script>