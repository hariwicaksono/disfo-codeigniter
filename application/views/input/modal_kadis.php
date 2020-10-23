<?php defined('BASEPATH') OR exit('No direct script access allowed');  ?>
<?php 
	if(isset($data_kadis)){
		if($data_kadis->num_rows()>0){
			$kadis=$data_kadis->row();
			$id_kadis=$kadis->id;
			$nama_agenda=$kadis->nama_agenda;
			$tmp_agenda=$kadis->tmp_agenda;
			$tgl_agenda=$kadis->tgl_agenda;
			$waktu=$kadis->waktu;
		}
	}
?>
<div class="modal fade" id="modal-kadis">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/kadis/simpan'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_kadis)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_kadis; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label>Nama Agenda</label>
					<input type="text" class="form-control" name="nama_agenda" value="<?php echo (isset($nama_agenda) ? $nama_agenda : ""); ?>" required />
				</div>
				<div class="form-group">
					<label>Tempat</label>
					<input type="text" class="form-control" name="tmp_agenda" value="<?php echo (isset($tmp_agenda) ? $tmp_agenda : ""); ?>" required />
				</div>	
				<div class="form-group">
					<label>Start Date</label>
					<div class="input-group date">
						<input type="text" class="form-control datepicker" name="tgl_agenda" value="<?php echo (isset($tgl_agenda) ? $tgl_agenda : ""); ?>" required>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>				
				</div>
				<div class="form-group">
					<label>Waktu</label>
					<div class="input-group">
						<input type="text" class="form-control timepicker" name="waktu" value="<?=isset($waktu) ? $waktu : '';?>" required />
						<div class="input-group-addon">
							<i class="fa fa-clock-o"></i>
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
$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		todayBtn:true,
		todayHighlight:true
	});
    $('.timepicker').timepicker({
	  showMeridian:false,
      showInputs: false
    });		
});
</script>