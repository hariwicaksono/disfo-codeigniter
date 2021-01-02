<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$news=$data->row();
		$id_news=$news->id;
		$txt_news=$news->txt_news;
	}
}
?>
<div class="modal fade" id="modal-news">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/news/simpan'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_news)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_news; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label>Isi Berita</label>
					<textarea class="form-control" name="txt_news" rows="2" required><?php echo (isset($txt_news) ? $txt_news : ""); ?></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
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