<div class="modal fade" id="modal-import">
  <div class="modal-dialog">
	<div class="modal-content">
	<?php echo form_open_multipart('input/jadwal_solat/import',array('id' => 'frm-upload','class' => 'form-horizontal')); ?>
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"><?=$modal_title; ?></h4>
	  </div>
	  <div class="modal-body">
			<div class="form-group">
				<input type="hidden" name="id_bulan" value="<?=$id_bulan; ?>">
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="exampleInputFile">Import</label>
				<div class="col-sm-6">
					<input type="file" id="exampleInputFile" name="file" required>

					<p class="margin">Format File .xls | .xlsx | maks size. 2 Mb</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<p class="text-center">
						Sebelum memulai upload ada baiknya anda menggunakan blanko Excel
						dari system.<br /> 
						<a href="<?=base_url('assets/blanko/jadwal_solat.xlsx'); ?>" class="btn btn-success btn-md">
							<i class="fa fa-download"> Download Blanko</i>
						</a>
					</p>
				</div>
			</div>			
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			<button type="submit" class="btn btn-primary">Import</button>
		</div>	 
		<?php echo form_close(); ?>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->