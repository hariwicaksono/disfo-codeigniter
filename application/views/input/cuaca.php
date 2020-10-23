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
				<a href="<?=site_url('dashboard'); ?>" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-home"></i></a>
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
			<div class="box box-default" >
				<div class="box-body">
				<?php echo form_open('input/cuaca/load_xml'); ?>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<label class="control-label">BMKG XML File URL Area Anda</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<?php if($this->session->has_userdata('url')){ ?>
								<input type="text" class="form-control" name="url" id='url' value="<?=$this->session->flashdata('url') ?>" placeholder="ex. http://data.bmkg.go.id/datamkg/MEWS/DigitalForecast/DigitalForecast-Lampung.xml" required />
								<?php }else{ ?>
								<input type="text" class="form-control" name="url" id='url' value="<?=$data->url_area; ?>" placeholder="ex. http://data.bmkg.go.id/datamkg/MEWS/DigitalForecast/DigitalForecast-Lampung.xml" required />
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary btn-md">SET</button>
							</div>
						</div>
					</div>
				<?php echo form_close(); ?>
				</div>
			</div>
			<div class="box box-default" >
				<div class="box-body">
				<?php echo form_open('input/cuaca/load_xml'); ?>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<label class="control-label">Pilih Area Anda</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
							<?php if($this->session->has_userdata('area')){ ?>
								<select class="form-control" name="area">
								<?php echo $this->session->flashdata('area'); ?>
								</select>
							<?php }else{ ?>
								<select class="form-control" name="area">
								<?php echo $opsi; ?>
								</select>							
							<?php } ?>
							</div>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary btn-md">SET</button>
							</div>
						</div>
					</div>
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
					<ol>
						<li>
							Akses halaman prakiraan cuaca dari website resmi 
							<a href="http://data.bmkg.go.id/prakiraan-cuaca/">BMKG</a>
						</li>
						<li>Pilih Provinsi tempat anda tinggal</li>
						<li>Klik nama file hingga terbuka tab baru dari browser anda</li>
						<li>Copy paste url halaman tersebut ke BMKG XML File URL Area</li>
						<li>Klik tombol SET</li>
						<li>Pilih Area anda</li>
						<li>Klik tombol save</li>
					</ol>
				</div>
				<!-- /.box-body -->
			</div>		
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">

</script>