<div class="modal fade" id="modal-upload" data-backdrop="static">
  <div class="modal-dialog">
	<div class="modal-content">
	<?php echo form_open_multipart('admin/profile/upload',array('id' => 'frm-upload','class' => 'form-horizontal')); ?>
	  <div class="modal-header">
		<h4 class="modal-title"><?=$modal_title; ?></h4>
	  </div>
	  <div class="modal-body">
			<div class="form-group">
				<label class="col-sm-3" for="exampleInputFile">Foto</label>
				<div class="col-sm-6">
					<input type="file" id="exampleInputFile" name="file" required>

					<p class="margin">Format File Jpg | Png</p>
				</div>
			</div>		
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			<button type="submit" class="btn btn-primary" id="submit">Upload</button>
		</div>	 
		<?php echo form_close(); ?>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->