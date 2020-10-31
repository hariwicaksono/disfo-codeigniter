<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal fade" id="modal-settings">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open_multipart('settings/all_settings/simpan'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
				<?php 
				if($data->num_rows() > 0 ) {
					$setitem=$data->row();
					$group_setting=$setitem->group_setting;
				?>
						<div class="form-group">
							<input type="hidden" class="form-control" name="id" value="<?=$setitem->id ?>" />
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" name="group" value="<?=$group_setting; ?>" />
						</div>					
						<div class="form-group">
							<label class="control-label">Deskripsi Setting</label>
							<input type="text" class="form-control" name="deskripsi" value="<?=$setitem->deskripsi_setting ?>" readonly/>
						</div>
				<?php if($setitem->variable_setting=="site_maintenance"){ ?>
						<div class="form-group">
							<label class="control-label">Value</label>
							<select class="form-control" name="value_setting">
								<option value="FALSE" <?php echo ($setitem->value_setting=="FALSE" ? "selected" : "");?>>FALSE</option>
								<option value="TRUE" <?php echo ($setitem->value_setting=="TRUE" ? "selected" : "");?>>TRUE</option>
							</select>
						</div>
				<?php }elseif($setitem->variable_setting=="layout"){ ?>
						<div class="form-group">
							<label class="control-label">Value</label>
							<select class="form-control" name="value_setting">
								<option value="layout_1" <?php echo ($setitem->value_setting=="layout_1" ? "selected" : "");?>>Layout 1</option>
								<option value="layout_2" <?php echo ($setitem->value_setting=="layout_2" ? "selected" : "");?>>Layout 2 (Masjid)</option>
								<option value="layout_3" <?php echo ($setitem->value_setting=="layout_3" ? "selected" : "");?>>Layout 3</option>
								
							</select>
						</div>
				<?php }elseif($setitem->variable_setting=="background"){ ?>
						<div class="form-group">
							<label for="exampleInputFile">Background Image</label>
							<input type="file" id="exampleInputFile" name="file" required>
							<p class="margin">Format File .jpg</p>
							<span class="help-block">Refresh your Display after upload image success </span>
						</div>	
				<?php }elseif($setitem->variable_setting=="logo"){ ?>
						<div class="form-group">
							<label for="exampleInputFile">Logo</label>
							<input type="file" id="exampleInputFile" name="file" required>
							<p class="margin">Format File .jpg</p>
							<span class="help-block">Refresh your Display after upload image success </span>
						</div>						
				<?php }else{ ?>
						<div class="form-group">
							<label class="control-label">Value</label>
							<input type="text" class="form-control" name="value_setting" value="<?=$setitem->value_setting; ?>" />
							<?php if($setitem->variable_setting=="news_refresh" || $setitem->variable_setting=="slide_refresh"){ ?>
							<span class="help-block">Input with numeric in seconds (Detik)</span>
							<?php } ?>
						</div>			
				<?php
					}
				}
				?>
				<?php if($setitem->variable_setting=="layout"){ ?>
									
				<?php } ?>
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
$(document).ready(function() {
    $('.select2').select2();
});
$('#datepicker').datepicker({
	format: 'mm/dd/yyyy',
	autoclose: true
});
</script>