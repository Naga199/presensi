<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 id="title" style="display:block; text-align:center;">Info Kehadiran</h3>
	<div align="center">
		<h4 id="title" style="display:block; text-align:center;">CheckIn</h4>
		<?php if($datakehadiran->image_masuk_guru) : ?>
			<img id="imageIn" style="width: 50%" src="<?= base_url($datakehadiran->image_masuk_guru); ?>"/>
		<?php endif; ?>
	</div>
	<div align="center">
		<h4 id="title" style="display:block; text-align:center;">CheckOut</h4>
		<?php if($datakehadiran->image_pulang_guru) : ?>
			<img id="imageOut" style="width: 50%" src="<?= base_url($datakehadiran->image_pulang_guru); ?>"/>
		<?php endif; ?>
	</div>
</div>
