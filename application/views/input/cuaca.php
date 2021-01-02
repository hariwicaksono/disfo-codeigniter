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
				<a href="<?=site_url('dashboard'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-home"></i></a>
			</div>				
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-12" >
		<?php if(isset($type)){ ?>
					<div class="alert <?=$type; ?>">
						<?=$message; ?>
					</div>
					<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8" >
			<div class="box box-default" >
				<div class="box-body">
				<?php echo form_open('input/cuaca/simpan'); ?>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<label class="control-label"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<input type="hidden" name="id" value="<?=$data->id; ?>"/>
								<input type="text" class="form-control" name="area" id='area' value="<?=$data->area; ?>" placeholder="" />
								
							</div>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary btn-md">Simpan</button>
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
						<li>Masukkan Nama Kota anda</li>
						<li>Klik tombol Simpan</li>
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