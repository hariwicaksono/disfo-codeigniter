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
				<a href="<?=site_url('input/keuangan_masjid'); ?>" class="btn btn-flat btn-xs btn-primary">Back</a>
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
				<?php echo form_open('input/keuangan_masjid/save/'.$mode . $param2); ?>
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
						<label>Uraian</label>
						<input type="text" class="form-control" name="uraian" value="<?=isset($data) ? $data->uraian : '';?>" required />
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<select name="jenis" class="form-control">
							<option value="1" <?php echo (isset($data) ? ($data->jenis==1 ? "selected" : "") : ""); ?>>Pemasukan</option>
							<option value="2" <?php echo (isset($data) ? ($data->jenis==2 ? "selected" : "") : ""); ?>>Pengeluaran</option>
						</select>
					</div>					
					<div class="form-group">
						<label>Jumlah</label>
						<input type="text" class="form-control" name="jumlah" placeholder="ex. 20000000 only numeric" value="<?=isset($data) ? ($data->jenis==1 ? number_format($data->pemasukan,0,"","") : number_format($data->pengeluaran,0,"","")) : '';?>" required />
					</div>
					<button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>						
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
					Informasi keuangan masjid isi sesuai dengan jenis transaksi (pemasukan / pengeluaran),
					infromasi yang di tampilkan di display adalah jumlah total pemasukan / jumlah total pengeluaran, saldo
					perbulan aktif.
					Untuk uraian pemasukan dan pengeluaran ditampilkan di teks berjalan.
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