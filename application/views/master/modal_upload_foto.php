<div class="modal fade" id="modal-upload">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"><?=$modal_title; ?></h4>
	  </div>
	  <?php echo form_open_multipart('master/guru/upload_foto',array('id' => 'frm-upload')); ?>
	  <div class="modal-body">
			
			<input type="hidden" name="id" value="<?=$id; ?>" />
			<div class="form-group">
				<label for="exampleInputFile">Upload Foto</label>
				<input type="file" id="exampleInputFile" name="userfile" required>

				<p class="margin">Format File .jpg | maks size. 2 Mb</p>
			</div>
			<div class="form-group">
				
			</div>
			
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Upload</button>
		</div>	
		<?php echo form_close(); ?>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->