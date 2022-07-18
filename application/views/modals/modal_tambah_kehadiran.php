<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 id="title" style="display:block; text-align:center;">Form Kehadiran</h3>

  <form id="form-tambah-kehadiran" method="GET" style="width: 50%;margin: 0 auto;float: none;">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2" style="border: 0">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="hidden" class="form-control" placeholder="Nama" id="enkripsi" name="enkripsi" value="<?= $enkripsi; ?>" aria-describedby="sizing-addon2" style="border: 0" readOnly>
      <input type="hidden" class="form-control" placeholder="Nama" id="keychipher" name="keychipher" value="<?= $keychipher; ?>" aria-describedby="sizing-addon2" style="border: 0" readOnly>
      <input type="hidden" class="form-control" placeholder="Nama" id="id_guru" name="id_guru" value="<?= $userdata->userid; ?>" aria-describedby="sizing-addon2" style="border: 0" readOnly>
      <input type="hidden" class="form-control" placeholder="Nama" id="tipe" name="tipe" value="1" aria-describedby="sizing-addon2" style="border: 0" readOnly>
      <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?= $userdata->nama; ?>" aria-describedby="sizing-addon2" style="border: 0" readOnly>
    </div>
    <!--<div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2" style="border: 0">
        <i class="glyphicon glyphicon-list-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="NUPTK" name="nuptk" aria-describedby="sizing-addon2" style="border: 0" readOnly>
    </div>-->
    <div id="qrcodeholder" align="center"> </div>
    <div class="form-group">
      <div class="col-md-12">
          <button id="btn" type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> CheckIn </button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript" src="<?= base_url(); ?>assets/dist/js/jquery.qrcode.min.js"></script>
<script type="text/javascript">
$(function () {
	$("#tambah-kehadiran").on("show.bs.modal", function (event) {
		const myVal = $(event.relatedTarget).data('id');
		const action = (myVal.toLowerCase().trim() === 'check in') ? 1 : 2;
		// alert(myVal+action);
		$('#btn').text(myVal);
		$('#btn').prepend('<i class="glyphicon glyphicon-ok"></i>');
		$('#tipe').val(action);
		$('#qrcodeholder').empty();
		$('#qrcodeholder').qrcode({
			text    : "<?= base_url() ?>auth/addPresence?enkripsi="+$('#enkripsi').val()+"&key="+$('#keychipher').val(), //original code auth/addPresence?id_guru="+$('#id_guru').val()+"&tipe="+$('#tipe').val()
			render  : "canvas", // 'canvas' or 'table'. Default value is 'canvas'
			background : "#ffffff",
			foreground : "#000000",
			width : 150,
			height: 150
		});
	});
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>
