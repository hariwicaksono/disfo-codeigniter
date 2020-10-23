<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$event=$data->row();
		$id_event=$event->id;
		$tgl_event=$event->tanggal;
		$waktu_mulai=$event->waktu_mulai;
		$waktu_akhir=$event->waktu_akhir;
		$nm_event=$event->nm_event;
		$tempat=$event->tempat;
	}
}
?>
<div class="modal fade" id="modal-event">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/event/simpan',array('class' => 'form-horizontal')); ?>
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
					<label class="col-sm-2">Tanggal</label>
					<div class="col-sm-4">
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>					
							<input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tanggal" value="" required />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2">Waktu Mulai</label>
					<div class="col-sm-4">
						<div class="input-group" class="col-sm-3">
							<input type="text" class="form-control timepicker" name="waktu_mulai" value="<?=isset($waktu_mulai) ? $waktu_mulai : '';?>" required />
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>
					<label class="col-sm-2">Berakhir</label>
					<div class="col-sm-4">
						<div class="input-group">
							<input type="text" class="form-control timepicker" name="waktu_akhir" value="<?=isset($waktu_akhir) ? $waktu_akhir : '';?>" required />
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>					
				</div>
				<div class="form-group">
					<label class="col-sm-2">Nama Event</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nm_event" value="<?=isset($nm_event) ? $nm_event : '';?>" required>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2">Tempat</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tempat" value="<?=isset($tempat) ? $tempat : '';?>" required>
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