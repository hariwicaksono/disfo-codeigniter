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
				<a href="<?=site_url('input/keuangan_masjid/form/add'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                <p>Bagian ini khusus untuk layout 4</p>
            </div>	
			<div class="box box-default" >
				<div class="box-body table-responsive ipad">
					<table class ="table" id="tb-keuangan">
						<thead class="bg-black">
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Uraian</th>
								<th class="text-center">Pemasukan</th>
								<th class="text-center">Pengeluaran</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($data->num_rows() > 0){
							$no=0;
							$jml_pemasukan=0;
							$jml_pengeluaran=0;
							foreach($data->result() as $row){
								$no++;
								$jml_pemasukan=$jml_pemasukan + $row->pemasukan;
								$jml_pengeluaran=$jml_pengeluaran + $row->pengeluaran;
						?>
							<tr>
								<td class="text-center"><?=$no; ?></td>
								<td class="text-center"><?=$row->tanggal; ?></td>
								<td><?=$row->uraian; ?></td>
								<td class="text-right">
								<?php 
									if($row->jenis==1){ 
										echo "Rp. " . number_format($row->pemasukan,0,"",".");
									}
								?>
								</td>
								<td class="text-right">
								<?php 
									if($row->jenis==2){ 
										echo "Rp. " . number_format($row->pengeluaran,0,"",".");
									}
								?>
								</td>								
								<td class="center">
									<div class="box-tools btn-group btn-grid">
										<a href="<?=site_url('input/keuangan_masjid/form/edit/'.$row->id) ?>" class="btn btn-primary btn-sm">
											<i class="fa fa-edit"></i>
										</a>
										<a href="<?=site_url('input/keuangan_masjid/hapus/'.$row->id) ?>" class="btn btn-danger btn-sm">
											<i class="fa fa-trash"></i>
										</a>										
									</div>
								</td>
							</tr>
						<?php
							}
							$saldo =$jml_pemasukan - $jml_pengeluaran;
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
				<?php echo (isset($saldo) ? "Saldo saat ini : Rp. " . number_format($saldo,0,"",".") : ""); ?>
				</div>
			</div>			
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(document).ready(function(){
	$('#tb-keuangan').DataTable();
});
</script>