<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
		<div class="col-xs-8">
			<h3 style="margin:0;"><span class="table-header"><?=$title; ?></span></h3>
		</div>
		<div class="col-xs-4">
			<!--for button tools-->
			<div class="box-tools btn-group btn-grid pull-right">
				<a href="<?=site_url('input/kegiatan_masjid'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
			</div>				
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-12" >
		<?php if($this->session->has_userdata('message')){ ?>
			<div class="alert alert-<?=$this->session->flashdata('type'); ?> alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?=$this->session->flashdata('message'); ?>
			</div>	
		<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8" >
			<div class="box box-solid" >
				<div class="box-body">
				<?php $param2=isset($data) ? "/" . $data->id : "" ; ?>
				<?php echo form_open('input/kegiatan_masjid/save/'.$mode . $param2); ?>
					<div class="form-group">
						<label>Nama Kegiatan</label>
						<input type="text" class="form-control" name="nama_kegiatan" value="<?=isset($data) ? $data->nama_kegiatan : '';?>" required />
					</div>
					<div class="form-group">
						<label>Deskripsi Kegiatan</label>
						<textarea class="textarea" placeholder="Place some text here" name="deskripsi_kegiatan"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
							<?=isset($data) ? $data->deskripsi_kegiatan : '';?>
						</textarea>
					</div>
					<div class="form-group">
						<label>Tempat Kegiatan</label>
						<input type="text" class="form-control" name="tmp_kegiatan" value="<?=isset($data) ? $data->tmp_kegiatan : '';?>" required />
					</div>					
					<div class="form-group">
						<label>Tanggal</label>
						<div class="input-group date col-sm-4">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>					
							<input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tgl_kegiatan" value="<?=isset($data) ? $data->tgl_kegiatan : '';?>" required>
						</div>
					</div>

					<div class="form-group">
						<label>Waktu</label>
						<input type="text" class="form-control" name="waktu" placeholder="ex. 08.00 WIB s.d Selesai" value="<?=isset($data) ? $data->waktu : '';?>" required />
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>						
				<?php echo form_close(); ?>
				</div>
			</div>				
		</div>
		<div class="col-sm-4">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Petunjuk</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					Informasi kegiatan masjid ini akan ditampilkan pada slider kegiatan, buatlah agenda kegiatan
					yang ingin ditampilkan pada display Masjid.
				</div>
				<!-- /.box-body -->
			</div>		
		</div>		
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
		todayBtn:true,
		todayHighlight:true
	});	
	$('.textarea').wysihtml5();
});
</script>