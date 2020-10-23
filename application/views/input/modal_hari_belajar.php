<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
if(isset($data)){
	if($data->num_rows()>0){
		$hari=$data->row();
		$id_hari=$hari->id;
		$id_jam_pelajaran=$hari->id_jam_pelajaran;
		$senin=$hari->senin;
		$selasa=$hari->selasa;
		$rabu=$hari->rabu;
		$kamis=$hari->kamis;
		$jumat=$hari->jumat;
		$sabtu=$hari->sabtu;
	}else{
		$id_jam_pelajaran=$id_jam_pelajaran_x;
	}
}
?>
<div class="modal fade" id="modal-hari-belajar">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('input/hari_belajar/simpan',array('class' => 'form-horizontal')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<?=$modal_title; ?>
					<?php
					if($jam_pelajaran->num_rows()>0){
						$jampel=$jam_pelajaran->row();
						echo " Jam Ke " . $jampel->jam_ke . " | " . $jampel->awal . "-" . $jampel->akhir;
					}
					?>					
				</h4>
			</div>
			<div class="modal-body">

			<?php if(isset($id_hari)){ ?>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$id_hari; ?>"/>
				</div>
			<?php } ?>
				<div class="form-group">
					<input type="hidden" name="id_jam_pelajaran" value="<?=$id_jam_pelajaran; ?>"/>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Senin</label>
					<div class="col-sm-4">
						<select class="form-control" name="senin">
							<option value="0" <?php echo (isset($senin) ? ($senin==0 ? "selected" : "") : ""); ?> >Not Set</option>
							<option value="1" <?php echo (isset($senin) ? ($senin==1 ? "selected" : "") : ""); ?> >KBM</option>
							<option value="2" <?php echo (isset($senin) ? ($senin==2 ? "selected" : "") : ""); ?> >Upacara</option>
							<option value="3" <?php echo (isset($senin) ? ($senin==3 ? "selected" : "") : ""); ?> >Istirahat</option>
							<option value="4" <?php echo (isset($senin) ? ($senin==4 ? "selected" : "") : ""); ?> >Imtaq</option>
							<option value="5" <?php echo (isset($senin) ? ($senin==5 ? "selected" : "") : ""); ?> >Senam</option>
							<option value="6" <?php echo (isset($senin) ? ($senin==6 ? "selected" : "") : ""); ?> >Bersih-bersih</option>
							<option value="7" <?php echo (isset($senin) ? ($senin==7 ? "selected" : "") : ""); ?> >Kegiatan Lainnya</option>					
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Selasa</label>
					<div class="col-sm-4">
						<select class="form-control" name="selasa">
							<option value="0" <?php echo (isset($selasa) ? ($selasa==0 ? "selected" : "") : ""); ?> >Not Set</option>
							<option value="1" <?php echo (isset($selasa) ? ($selasa==1 ? "selected" : "") : ""); ?> >KBM</option>
							<option value="2" <?php echo (isset($selasa) ? ($selasa==2 ? "selected" : "") : ""); ?> >Upacara</option>
							<option value="3" <?php echo (isset($selasa) ? ($selasa==3 ? "selected" : "") : ""); ?> >Istirahat</option>
							<option value="4" <?php echo (isset($selasa) ? ($selasa==4 ? "selected" : "") : ""); ?> >Imtaq</option>
							<option value="5" <?php echo (isset($selasa) ? ($selasa==5 ? "selected" : "") : ""); ?> >Senam</option>
							<option value="6" <?php echo (isset($selasa) ? ($selasa==6 ? "selected" : "") : ""); ?> >Bersih-bersih</option>
							<option value="7" <?php echo (isset($selasa) ? ($selasa==7 ? "selected" : "") : ""); ?> >Kegiatan Lainnya</option>					
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Rabu</label>
					<div class="col-sm-4">
						<select class="form-control" name="rabu">
							<option value="0" <?php echo (isset($rabu) ? ($rabu==0 ? "selected" : "") : ""); ?> >Not Set</option>
							<option value="1" <?php echo (isset($rabu) ? ($rabu==1 ? "selected" : "") : ""); ?> >KBM</option>
							<option value="2" <?php echo (isset($rabu) ? ($rabu==2 ? "selected" : "") : ""); ?> >Upacara</option>
							<option value="3" <?php echo (isset($rabu) ? ($rabu==3 ? "selected" : "") : ""); ?> >Istirahat</option>
							<option value="4" <?php echo (isset($rabu) ? ($rabu==4 ? "selected" : "") : ""); ?> >Imtaq</option>
							<option value="5" <?php echo (isset($rabu) ? ($rabu==5 ? "selected" : "") : ""); ?> >Senam</option>
							<option value="6" <?php echo (isset($rabu) ? ($rabu==6 ? "selected" : "") : ""); ?> >Bersih-bersih</option>
							<option value="7" <?php echo (isset($rabu) ? ($rabu==7 ? "selected" : "") : ""); ?> >Kegiatan Lainnya</option>					
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Kamis</label>
					<div class="col-sm-4">
						<select class="form-control" name="kamis">
							<option value="0" <?php echo (isset($kamis) ? ($kamis==0 ? "selected" : "") : ""); ?> >Not Set</option>
							<option value="1" <?php echo (isset($kamis) ? ($kamis==1 ? "selected" : "") : ""); ?> >KBM</option>
							<option value="2" <?php echo (isset($kamis) ? ($kamis==2 ? "selected" : "") : ""); ?> >Upacara</option>
							<option value="3" <?php echo (isset($kamis) ? ($kamis==3 ? "selected" : "") : ""); ?> >Istirahat</option>
							<option value="4" <?php echo (isset($kamis) ? ($kamis==4 ? "selected" : "") : ""); ?> >Imtaq</option>
							<option value="5" <?php echo (isset($kamis) ? ($kamis==5 ? "selected" : "") : ""); ?> >Senam</option>
							<option value="6" <?php echo (isset($kamis) ? ($kamis==6 ? "selected" : "") : ""); ?> >Bersih-bersih</option>
							<option value="7" <?php echo (isset($kamis) ? ($kamis==7 ? "selected" : "") : ""); ?> >Kegiatan Lainnya</option>					
						</select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-3">Jum'at</label>
					<div class="col-sm-4">
						<select class="form-control" name="jumat">
							<option value="0" <?php echo (isset($jumat) ? ($jumat==0 ? "selected" : "") : ""); ?> >Not Set</option>
							<option value="1" <?php echo (isset($jumat) ? ($jumat==1 ? "selected" : "") : ""); ?> >KBM</option>
							<option value="2" <?php echo (isset($jumat) ? ($jumat==2 ? "selected" : "") : ""); ?> >Upacara</option>
							<option value="3" <?php echo (isset($jumat) ? ($jumat==3 ? "selected" : "") : ""); ?> >Istirahat</option>
							<option value="4" <?php echo (isset($jumat) ? ($jumat==4 ? "selected" : "") : ""); ?> >Imtaq</option>
							<option value="5" <?php echo (isset($jumat) ? ($jumat==5 ? "selected" : "") : ""); ?> >Senam</option>
							<option value="6" <?php echo (isset($jumat) ? ($jumat==6 ? "selected" : "") : ""); ?> >Bersih-bersih</option>
							<option value="7" <?php echo (isset($jumat) ? ($jumat==7 ? "selected" : "") : ""); ?> >Kegiatan Lainnya</option>					
						</select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-3">Sabtu</label>
					<div class="col-sm-4">
						<select class="form-control" name="sabtu">
							<option value="0" <?php echo (isset($sabtu) ? ($sabtu==0 ? "selected" : "") : ""); ?> >Not Set</option>
							<option value="1" <?php echo (isset($sabtu) ? ($sabtu==1 ? "selected" : "") : ""); ?> >KBM</option>
							<option value="2" <?php echo (isset($sabtu) ? ($sabtu==2 ? "selected" : "") : ""); ?> >Upacara</option>
							<option value="3" <?php echo (isset($sabtu) ? ($sabtu==3 ? "selected" : "") : ""); ?> >Istirahat</option>
							<option value="4" <?php echo (isset($sabtu) ? ($sabtu==4 ? "selected" : "") : ""); ?> >Imtaq</option>
							<option value="5" <?php echo (isset($sabtu) ? ($sabtu==5 ? "selected" : "") : ""); ?> >Senam</option>
							<option value="6" <?php echo (isset($sabtu) ? ($sabtu==6 ? "selected" : "") : ""); ?> >Bersih-bersih</option>
							<option value="7" <?php echo (isset($sabtu) ? ($sabtu==7 ? "selected" : "") : ""); ?> >Kegiatan Lainnya</option>					
						</select>
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

</script>