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
		<div class="col-sm-12">
			<?php if(isset($type)){ ?>
			<div class="alert <?=$type; ?> alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?=$message; ?>
			</div>
			<?php } ?>			
		</div>
	</div>
	<div class="row">
		<?php 
		if($data->num_rows()>0){
			$profile=$data->row();
			$username=$profile->username;
			$foto=$profile->foto;
			$nama=$profile->fullname;
			$tgl_daftar=$profile->tgl_daftar;
			$ip_address=$profile->ip_address;
			$email=$profile->email;
		}
		?>
        <div class="col-md-3">
			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('images/photo/'.($this->session->foto=="" ? 'default.jpeg' : $this->session->foto)); ?>" alt="User profile picture">

					<h3 class="profile-username text-center"><?php echo (isset($nama) ? $nama : ""); ?></h3>

					<p class="text-muted text-center"><?=$this->session->jenis_str; ?></p>

					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Registered</b> <a class="pull-right"><?php echo (isset($tgl_daftar) ? $tgl_daftar : ""); ?></a>
						</li>
						<li class="list-group-item">
							<b>IP Address</b> <a class="pull-right"><?php echo (isset($ip_address) ? $ip_address : ""); ?></a>
						</li>
					</ul>

					<a href="javascript:void(0);" OnClick="upload();" class="btn btn-primary btn-block">
						<i class="fa fa-edit" ></i> Ganti Foto
					</a>
				</div>
			<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#data-pribadi" data-toggle="tab">Data Pribadi</a></li>
					<li><a href="#password" data-toggle="tab">Password</a></li>
				</ul>	
				<div class="tab-content">
					<div class="active tab-pane" id="data-pribadi">
					<?php echo form_open('admin/profile/simpan',array('class' => 'form-horizontal','id' => 'frm-pribadi')); ?>
						<div class="form-group">
							<label class="col-sm-3">Username</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="username" value="<?php echo (isset($username) ? $username : ""); ?>" required >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3">Nama Lengkap</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="fullname" value="<?php echo (isset($nama) ? $nama : ""); ?>" required >
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-3">Email</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" name="email" value="<?php echo (isset($email) ? $email : ""); ?>" required >
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3 col-sm-offset-3">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-save"></i> Simpan
								</button>
							</div>
						</div>
					<?php echo form_close(); ?>
					</div>
					<div class="tab-pane" id="password">
					<?php echo form_open('admin/profile/ubah_pw',array('class' => 'form-horizontal','id' => 'frm-password')); ?>
						<div class="form-group">
							<label class="col-sm-3">Password Lama</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="pass_lama" value="" required >
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-3">Password Baru</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="pass_baru" value="" required >
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-3">Konfirmasi Password Baru</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="konf_pass" value="" required >
							</div>
						</div>	
						<div class="form-group">
							<div class="col-sm-3 col-sm-offset-3">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-save"></i> Ganti Password
								</button>
							</div>
						</div>						
					<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<script type="text/javascript">
function upload(){
	$('.content-wrapper').LoadingOverlay('show');
	$.post(_BASE_URL + 'admin/profile/add_foto',function(f){
		$('#modalku').html(f);
		$('.content-wrapper').LoadingOverlay('hide');
		$('#modal-upload').modal('show');
	},'html');
}
</script>