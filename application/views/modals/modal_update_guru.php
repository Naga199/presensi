<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Guru</h3>
      <form method="POST" id="form-update-guru">
        <input type="hidden" name="id" value="<?php echo $dataguru->id_guru; ?>">
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Nama" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataguru->nama_guru; ?>">
        </div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="sizing-addon2">
			<i class="glyphicon glyphicon-list-alt"></i>
		  </span>
		  <input type="text" class="form-control" placeholder="NUPTK" name="nuptk" aria-describedby="sizing-addon2" value="<?php echo $dataguru->nuptk_guru; ?>">
		</div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-briefcase"></i>
          </span>
          <select name="ptk" class="form-control select2"  aria-describedby="sizing-addon2" style="width: 100%">
            <?php
            foreach ($dataPosisi as $posisi) {
              ?>
              <option value="<?php echo $posisi->id; ?>" <?php if($posisi->id == $dataguru->ptk_guru){echo "selected='selected'";} ?>><?php echo $posisi->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="input-group form-group" style="display: inline-block;">
          <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-tag"></i>
          </span>
          <span class="input-group-addon">
              <input type="radio" name="jk" value="1" id="laki" class="minimal" <?php if($dataguru->jk_guru == 1){echo "checked='checked'";} ?>>
          <label for="laki">Laki-laki</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="jk" value="2" id="perempuan" class="minimal" <?php if($dataguru->jk_guru == 2){echo "checked='checked'";} ?>> 
          <label for="perempuan">Perempuan</label>
            </span>
        </div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="sizing-addon2">
			<i class="glyphicon glyphicon-calendar"></i>
		  </span>
		  <input type="date" class="form-control" placeholder="TTL" name="ttl" aria-describedby="sizing-addon2" value="<?= $dataguru->ttl_guru; ?>">
		</div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-home"></i>
          </span>
          <select name="kota" class="form-control select2"  aria-describedby="sizing-addon2" style="width: 100%">
            <?php
            foreach ($dataKota as $kota) {
              ?>
              <option value="<?php echo $kota->id; ?>" <?= ($kota->id == $dataguru->asal_kota) ? "selected='selected'" : ''; ?>><?php echo $kota->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="sizing-addon2">
			<i class="glyphicon glyphicon-stats"></i>
		  </span>
		  <select name="status" class="form-control select2" aria-describedby="sizing-addon2" style="width: 100%">
			  <option value="gty/pty" <?= ($dataguru->statuskepegawaian_guru === 'gty/pty') ? 'selected' : ''; ?>>GTY/PTY</option>
			  <option value="honorer" <?= ($dataguru->statuskepegawaian_guru === 'honorer') ? 'selected' : ''; ?>>Guru Honorer Sekolah</option>
			  <option value="tenaga" <?= ($dataguru->statuskepegawaian_guru === 'tenaga') ? 'selected' : ''; ?>>Tenaga Honorer Sekolah</option>
		  </select>
		</div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-phone-alt"></i>
          </span>
          <input type="text" class="form-control" placeholder="Nomor Telepon" name="telp" aria-describedby="sizing-addon2" value="<?php echo $dataguru->telp_guru; ?>">
        </div>
        <div class="input-group form-group">
		  <span class="input-group-addon" id="sizing-addon2">
			<i class="glyphicon glyphicon-book"></i>
		  </span>
		  <input type="text" class="form-control" placeholder="Email" name="email" aria-describedby="sizing-addon2" value="<?php echo $dataguru->email_guru; ?>">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="sizing-addon2">
			<i class="glyphicon glyphicon-road"></i>
		  </span>
		  <textarea type="text" class="form-control" placeholder="Alamat" name="alamat" aria-describedby="sizing-addon2"><?php echo $dataguru->alamat_guru; ?></textarea>
		</div>
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
          </div>
        </div>
      </form>
</div>

<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>
