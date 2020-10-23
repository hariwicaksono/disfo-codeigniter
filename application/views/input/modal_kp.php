<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$kp=$data->row();
		$id_kp=$kp->id;
		$npm=$kp->npm;
		$nama_mhs=$kp->nama_mhs;
		$txt_kp=$kp->txt_kp;
		$tgl_kp=$kp->tgl_kp;
		$waktu=$kp->waktu;
		$ruang=$kp->ruang;
	}
}
?>
<div class="modal fade" id="modal-kp">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/kp/simpan'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_kp)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_kp; ?>"/>
				</div>
			<?php } ?> 
				<div class="form-group">
					<label>NPM</label>
					<input type="text" class="form-control" name="npm" value="<?php echo (isset($npm) ? $npm : ""); ?>" required />
				</div>
				<div class="form-group">
					<label>Nama Mahasiswa</label>
					<input type="text" class="form-control" name="nama_mhs" value="<?php echo (isset($nama_mhs) ? $nama_mhs : ""); ?>" required />
				</div>
				<div class="form-group">
					<label>Judul kp</label>
					<textarea class="form-control" name="txt_kp" rows="2" required><?php echo (isset($txt_kp) ? $txt_kp : ""); ?></textarea>
				</div>
				<div class="form-group">
					<label>Start Date</label>
					<div class="input-group date">
						<input type="text" class="form-control datepicker" name="tgl_kp" value="<?php echo (isset($tgl_kp) ? $tgl_kp : ""); ?>" required>
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
				<div class="form-group">
					<label>Ruang</label>
					<input type="text" class="form-control" name="ruang" value="<?php echo (isset($ruang) ? $ruang : ""); ?>" required />
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