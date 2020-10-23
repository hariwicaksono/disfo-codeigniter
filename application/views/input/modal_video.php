<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$video=$data->row();
		$id_video=$video->id;
		$judul=$video->judul;
		$status=$video->status;
	}
}
?>
<div class="modal fade" id="modal-video">
	<div class="modal-dialog">
		<div class="modal-content">
		<?php echo form_open('input/video/simpan',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" name="id" value="<?=isset($id_video) ? $id_video : '';?>"/>
				</div>	
				<div class="form-group">
					<label class="col-sm-3">Judul</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="judul" value="<?=isset($judul) ? $judul : '';?>" required>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-3">Status</label>
					<div class="col-sm-6">
						<select class="form-control" name="status">
							<option value="0" <?php echo (isset($status) ? $status==0 ? "selected" : "" : '');?>>Tidak Aktif</option>
							<option value="1" <?php echo (isset($status) ? $status==1 ? "selected" : "" : '');?>>Aktif</option>
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

</script>