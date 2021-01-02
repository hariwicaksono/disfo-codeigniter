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
				<a href="<?=site_url('input/jumatan'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
				<?php echo form_open('input/jumatan/save/'.$mode . $param2); ?>
					<div class="form-group">
						<label>Tanggal</label>
						<div class="input-group date col-sm-4">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>					
							<input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tanggal" value="<?=isset($data) ? $data->tanggal : '';?>" required>
						</div>
					</div>
					<div class="form-group">
						<label>Imam</label>
						<input type="text" class="form-control" name="imam" id="imam" value="<?=isset($data) ? $data->imam : '';?>" required />
					</div>		
					<div class="form-group">
						<label>Khotib</label>
						<input type="text" class="form-control" name="khotib" id="khotib" value="<?=isset($data) ? $data->khotib : '';?>" required />
					</div>	
					<div class="form-group">
						<label>Muazin</label>
						<input type="text" class="form-control" name="muazin" id="muazin" value="<?=isset($data) ? $data->muazin : '';?>" required />
					</div>		
					<div class="form-group">
						<label>Judul Khotbah</label>
						<input type="text" class="form-control" name="judul_khotbah" id="judul_khotbah" value="<?=isset($data) ? $data->judul_khotbah : '';?>" required />
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
					Informasi imam, khotib, muazin ini akan ditampilkan ada text berjalan di display, setelah
					menambahkan/mengubah data anda dapat mengaktifkannya untuk ditampilan di display.
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
});
</script>