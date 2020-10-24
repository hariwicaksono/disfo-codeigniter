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
				<a href="<?=site_url('input/jumatan/form/add'); ?>" class="btn btn-flat btn-xs btn-primary">Tambah</a>
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
		<div class="col-sm-12" >
		<div class="callout callout-info">
                <p>Bagian ini khusus untuk layout 2</p>
            </div>	
			<div class="box box-default" >
				<div class="box-body table-responsive ipad">
					<table class ="table" id="tb-jumatan">
						<thead class="bg-black">
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Imam</th>
								<th class="text-center">Khotib</th>
								<th class="text-center">Muazin</th>
								<th class="text-center">Judul Khotbah</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows() > 0){
							$no=0;
							foreach($data->result() as $row){
								$no++;
						?>
							<tr>
								<td class="text-center"><?=$no; ?></td>
								<td class="text-center"><?=$row->tanggal; ?></td>
								<td><?=$row->imam; ?></td>
								<td><?=$row->khotib; ?></td>
								<td><?=$row->muazin; ?></td>
								<td><?=$row->judul_khotbah; ?></td>
								<td class="text-center">
								<?php if($row->status==0){ ?>
									<a href="<?=site_url('input/jumatan/aktifkan/'.$row->id) ?>" class="btn btn-success btn-flat btn-xs">Aktifkan</a>
								<?php }else{ ?>
									Jadwal Aktif
								<?php } ?>
								</td>
								<td class="center">
									<div class="box-tools btn-group btn-grid">
										<a href="<?=site_url('input/jumatan/form/edit/'.$row->id) ?>" class="btn btn-primary btn-flat btn-xs">
											<i class="fa fa-edit"></i>
										</a>
										<a href="<?=site_url('input/jumatan/hapus/'.$row->id) ?>" class="btn btn-primary btn-flat btn-xs">
											<i class="fa fa-trash"></i>
										</a>										
									</div>
								</td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready(function(){
	$('#tb-jumatan').DataTable();
});
</script>