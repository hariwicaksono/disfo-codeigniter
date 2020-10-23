<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal fade" id="modal_settings">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"><?=$item_setting->deskripsi_setting; ?></h4>
	  </div>
	  <div class="modal-body">
			<?php echo form_open_multipart($action,array('id' => 'frm-upload')); ?>
			<input type="hidden" class="form-control" name="id" value="<?=$item_setting->id; ?>" />
			<div class="form-group">
				<label for="exampleInputFile">Ganti Image</label>
				<input type="file" id="exampleInputFile" name="userfile" required>

				<p class="margin">Format File .jpg | .jpeg | maks size. 2 Mb</p>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Upload</button>
			</div>
			<?php echo form_close(); ?>
	  </div>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
function simpan(){
	var items = $('#frm-general').serialize();
	$("#modal_settings").LoadingOverlay('show');
	$.post(_BASE_URL + 'all_settings/save',items,function(f){
		$("#modal_settings").LoadingOverlay('hide');
		pesan(f.type,pesanstr(f.message));
		if(f.type=="success"){
			$("#modal_settings").modal('hide');
			load_table();
		}
	});
	
}
function load_table(){
	$.post(_BASE_URL + 'all_settings/load_table',function(f){
		$("#tb-setting").html(f);
	},'html');	
}
</script>