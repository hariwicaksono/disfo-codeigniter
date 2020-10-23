<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$skripsi=$data->row();
		$id_skripsi=$skripsi->id;
		$npm=$skripsi->npm;
		$nama_mhs=$skripsi->nama_mhs;
		$txt_skripsi=$skripsi->txt_skripsi;
		$tgl_skripsi=$skripsi->tgl_skripsi;
		$waktu=$skripsi->waktu;
		$ruang=$skripsi->ruang;
	}
}
?>
<div class="modal fade" id="modal-skripsi">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/skripsi/simpan'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_skripsi)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_skripsi; ?>"/>
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
					<label>Judul Skripsi</label>
					<textarea class="form-control" name="txt_skripsi" rows="2" required><?php echo (isset($txt_skripsi) ? $txt_skripsi : ""); ?></textarea>
				</div>
				<div class="form-group">
					<label>Start Date</label>
					<div class="input-group date">
						<input type="text" class="form-control datepicker" name="tgl_skripsi" value="<?php echo (isset($tgl_skripsi) ? $tgl_skripsi : ""); ?>" required>
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