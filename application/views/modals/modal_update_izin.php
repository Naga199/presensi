<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Izin</h3>

  <form id="form-update-izin" method="POST">
    <input type="hidden" class="form-control" placeholder="id_izin" name="id_izin" value="<?= $dataizin->id_izin; ?>" aria-describedby="sizing-addon2">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <select class="form-control" name="type_izin" aria-describedby="sizing-addon2">
			<option value="Izin" <?= $dataizin->type_izin == 'Izin' ? 'selected' : ''; ?>>Izin</option>
			<option value="Sakit" <?= $dataizin->type_izin == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
	  </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="date" class="form-control" placeholder="awal" name="tgl_izin_awal" value="<?= $dataizin->tgl_izin_awal; ?>" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="date" class="form-control" placeholder="akhir" name="tgl_izin_akhir" value="<?= $dataizin->tgl_izin_akhir; ?>" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-road"></i>
      </span>
      <textarea type="text" class="form-control" placeholder="Keterangan" name="keterangan" aria-describedby="sizing-addon2"><?= $dataizin->keterangan; ?></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
