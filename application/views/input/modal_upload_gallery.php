<?php
if(isset($data)){
	if($data->num_rows()>0){
		$images=$data->row();
		$id_images=$images->id;
		$label=$images->label;
		$deskripsi=$images->deskripsi;
		$image_url=$images->image_url;;
		$status=$images->status;
	}
}
?>

<div class="modal fade" id="modal-upload" data-backdrop="static">
  <div class="modal-dialog">
	<div class="modal-content">
	<?php
		if(!isset($data)){
			echo form_open_multipart('input/gallery/upload',array('id' => 'frm-upload','class' => 'form-horizontal')); 
		}else{
			echo form_open('input/gallery/simpan',array('id' => 'frm-gallery','class' => 'form-horizontal'));
		}
	?>
	  <div class="modal-header">
		<h4 class="modal-title"><?=$modal_title; ?></h4>
	  </div>
	  <div class="modal-body">
			<input type="hidden" name="id" value="<?=(isset($id_images) ? $id_images : "") ;?>" />
			<div class="form-group">
				<label class="col-sm-3">Image Label</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="label" value="<?=(isset($label) ? $label : "") ;?>" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Description Image</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="deskripsi" value="<?=(isset($deskripsi) ? $deskripsi : "") ;?>" required>
				</div>
			</div>
			<?php if(!isset($data)){ ?>
			<div class="form-group">
				<label class="col-sm-3" for="exampleInputFile">Image</label>
				<div class="col-sm-6">
					<input type="file" id="exampleInputFile" name="file" required>

					<p class="margin">Format File .jpg | .png </p>
				</div>
			</div>
			<?php } ?>
			<div class="form-group">
				<label class="col-sm-3">Status</label>
				<div class="col-sm-6">
					<select name="status" class="form-control">
						<option value="1" <?php echo(isset($status) && $status==1 ? "selected" : "");?>>Aktif</option>
						<option value="0" <?php echo(isset($status) && $status==0 ? "selected" : "");?>>Tidak Aktif</option>
					</select>
				</div>
			</div>		
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" id="submit">Upload</button>
		</div>	 
		<?php echo form_close(); ?>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->