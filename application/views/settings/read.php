<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
		<div class="col-xs-7">
			<h3 style="margin:0;"><span class="table-header"><?=$title; ?></span></h3>
		</div>
		<div class="col-xs-5">
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
			<div class="box box-default" >
				<div class="box-body" id="settings-content">
					<?php if(isset($type)){ ?>
					<div class="alert <?=$type; ?> alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?=$message; ?>
					</div>
					<?php } ?>								
					<?php $this->load->view('settings/table_settings'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">

</script>