<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 id="title" style="display:block; text-align:center;">Form Kehadiran</h3>
  <p id="text-string">link sebelum dienkripsi : <?= base_url()."auth/addPresence?id_guru={$userdata->userid}&tipe=1" ?></p>
  <p id="text-ciper" >link sesudah dienkripsi : <?= base_url()."auth/addPresence?enkripsi={$enkripsi}&key={$keychipher}" ?></p>
  <p class="text-center">link ini di enkripsi ganda dengan qr code</p>
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
    let enkripsi = $('#enkripsi').val();

    // split string untuk enkripsi
    let tipe = enkripsi.substr(enkripsi.length - 1)
    tipe = tipe.replace(tipe,action);
    enkripsi = enkripsi.substr(0,enkripsi.length - 1) + tipe;

     // view hasil algoritma
    let text_string = $("#text-string").html();
    text_string = text_string.substr(0,text_string.length - 1) + tipe; //link sebelum dienkripsi : http://localhost/presensi/auth/addPresence?id_guru=2&tipe= trus digabung sama tipe => 1 / 2 
    $("#text-string").html(text_string);
    console.log(text_string);

    let text_ciper = $("#text-ciper").html();
    text_ciper_depan = text_ciper.substr(0,text_ciper.length - 14);
    text_ciper_belakang = text_ciper.substr(text_ciper.length - 13);
    text_ciper =  text_ciper_depan + tipe + text_ciper_belakang;
    $("#text-ciper").html(text_ciper);
    
    // console.log(action, enkripsi, tipe);
		$('#qrcodeholder').empty();
		$('#qrcodeholder').qrcode({
			text    : "<?= base_url() ?>auth/addPresence?enkripsi="+enkripsi+"&key="+$('#keychipher').val(), //original code auth/addPresence?id_guru="+$('#id_guru').val()+"&tipe="+$('#tipe').val()
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
