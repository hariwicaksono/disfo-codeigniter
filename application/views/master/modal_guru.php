<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$guru=$data->row();
		$id_guru=$guru->id;
		$nip=$guru->nip;
		$nama_lengkap=$guru->nama_lengkap;
		$tmp_lahir=$guru->tmp_lahir;
		$tgl_lahir=$guru->tgl_lahir;
		$ket=$guru->ket;
		$foto=$guru->foto;
		$kode_guru=$guru->kode_guru;
	}
}
?>
<div class="modal fade" id="modal-guru">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('master/guru/simpan',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?=$modal_title; ?></h4>
			</div>
			<div class="modal-body">
			<?php if(isset($id_guru)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_guru; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<label class="col-sm-4">NIP / PEG-ID</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nip" value="<?php echo (isset($nip) ? $nip : ""); ?>" required />
					</div>
				</div>			
				<div class="form-group">
					<label class="col-sm-4">Nama Lengkap</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nama_lengkap" value="<?php echo (isset($nama_lengkap) ? $nama_lengkap : ""); ?>" required />
					</div>
				</div>		
				<div class="form-group">
					<label class="col-sm-4">Tempat Lahir</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="tmp_lahir" value="<?php echo (isset($tmp_lahir) ? $tmp_lahir : ""); ?>" required />
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-4">Tanggal Lahir</label>
					<div class="col-sm-6">
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>					
							<input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tgl_lahir" value="<?=isset($tgl_lahir) ? $tgl_lahir : '';?>" required>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-4">Keterangan</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="ket" value="<?php echo (isset($ket) ? $ket : ""); ?>" required />
						<span class="help-block">Contoh : Guru Mapel IPA</span>
					</div>
				</div>					
				<div class="form-group">
					<label class="col-sm-4">Kode Guru</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="kode_guru" value="<?php echo (isset($kode_guru) ? $kode_guru : ""); ?>" required />
						<span class="help-block">Isi dengan angka contoh : 31</span>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
		todayBtn:true,
		todayHighlight:true
	});	
});
</script>