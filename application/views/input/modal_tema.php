<?php defined('BASEPATH') OR exit('No direct script access allowed');  ?>
<?php 
	if(isset($data_tema)){
		if($data_tema->num_rows()>0){
			$display_tema=$data_tema->row();
			$id_tema=$display_tema->id;
			$tema=$display_tema->tema;
			$sub_tema=$display_tema->sub_tema;
			$start_date=$display_tema->start_date;
		}
	}
?>
<div class="modal fade" id="modal-tema">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/tema/simpan'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_tema)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_tema; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label>Tema</label>
					<input type="text" class="form-control" name="tema" value="<?php echo (isset($tema) ? $tema : ""); ?>" required />
				</div>
				<div class="form-group">
					<label>Sub Tema</label>
					<input type="text" class="form-control" name="sub_tema" value="<?php echo (isset($sub_tema) ? $sub_tema : ""); ?>" required />
				</div>	
				<div class="form-group">
					<label>Start Date</label>
					<div class="input-group date">
						<input type="text" class="form-control datepicker" name="start_date" value="<?php echo (isset($start_date) ? $start_date : ""); ?>" required>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
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
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});
</script>