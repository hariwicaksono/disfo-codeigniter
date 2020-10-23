<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
if($data_gallery->num_rows()>0){
	$i=0;
	foreach($data_gallery->result() as $gallery){
		$i++;
?>
	<div class="item <?php echo ($i==1 ? 'active' : ''); ?>">
		<img src="<?php echo base_url('images/gallery/'.($gallery->image_url=="" ? 'no_thumbnail.jpg' : $gallery->image_url)); ?>">
		<div class="carousel-caption">
			<h3><?=$gallery->label; ?></h3>
			<p><?=$gallery->deskripsi; ?></p>
		</div>
	</div>					

<?php
	}
}
?>
			