<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$kelas=$data->row();
		$id_kelas=$kelas->id;
		$tingkat=$kelas->tingkat;
		$nm_kelas=$kelas->nm_kelas;
	}
}
?>
<div class="modal fade" id="modal-kelas">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('master/kelas/simpan',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_kelas)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_kelas; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label class="col-sm-4">Tingkat</label>
					<div class="col-sm-3">
						<select name="tingkat" class="form-control">
						<?php 
						for($i=1;$i<=13;$i++){
						?>
							<option value="<?=$i; ?>" <?php echo (isset($tingkat) ? $tingkat==$i ? "selected" : "" : ""); ?> >Kelas <?=$i; ?></option>
						<?php
						}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4">Nama Kelas</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="nm_kelas" value="<?php echo (isset($nm_kelas) ? $nm_kelas : ""); ?>" required />
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

</script>