<div class="modal fade" id="modal-upload" data-backdrop="static">
  <div class="modal-dialog">
	<div class="modal-content">
	<?php echo form_open_multipart('input/video/upload',array('id' => 'frm-upload','class' => 'form-horizontal')); ?>
	  <div class="modal-header">
		<h4 class="modal-title"><?=$modal_title; ?></h4>
	  </div>
	  <div class="modal-body">
			<div class="form-group">
				<label class="col-sm-3">Judul Video</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="judul" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="exampleInputFile">Video</label>
				<div class="col-sm-6">
					<input type="file" id="exampleInputFile" name="file" required>

					<p class="margin">Format File .mp4 </p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Status</label>
				<div class="col-sm-6">
					<select class="form-control" name="status">
						<option value="0">Tidak Aktif</option>
						<option value="1">Aktif</option>
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