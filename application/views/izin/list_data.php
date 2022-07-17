<?php
  foreach ($dataizin as $izin) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $izin->guru; ?></td>
      <td><?php echo $izin->type_izin; ?></td>
      <td><?php echo $izin->tgl_izin_awal; ?></td>
      <td><?php echo $izin->tgl_izin_akhir; ?></td>
      <td><?php echo $izin->keterangan; ?></td>
      <td><?php echo $izin->status; ?></td>
      <td><?php echo $izin->tgl_dibuat; ?></td>
      <td><?php echo $izin->tgl_diproses; ?></td>
      <!-- <td><?php echo $izin->catatan; ?></td> -->
      <td><?php echo $izin->admin; ?></td>
      <td class="text-center" style="min-width:230px;">
	  <?php if($izin->status == 'Baru' && $this->userdata->type == 'guru') {?>
		<button class="btn btn-warning update-dataizin" data-id="<?php echo $izin->id_izin; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
		<button class="btn btn-danger konfirmasiHapus-izin" data-id="<?php echo $izin->id_izin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i></button>
	 <?php } else if($izin->status == 'Baru' && $this->userdata->type == 'admin') {?>
        <button id="approveBtn" class="btn btn-success approve-izin" data-id="<?php echo $izin->id_izin; ?>"><i class="glyphicon glyphicon-check"></i></button>
        <button id="rejectBtn" class="btn btn-danger reject-izin" data-id="<?php echo $izin->id_izin; ?>"><i class="glyphicon glyphicon-remove-sign"></i></button>
	 <?php } ?>
      </td>
    </tr>
    <?php
  }
?>
<script>
	$('#approveBtn').click(function(e) {
		const myVal = $(this).data('id');
		const data = { id: myVal};

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('izin/prosesApprove'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilIzin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				$('.msg').html(out.msg);
				effect_msg();
			}
		});
		e.preventDefault();
	});

	$('#rejectBtn').click(function(e) {
		const myVal = $(this).data('id');
		const data = { id: myVal};
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('izin/prosesReject'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilIzin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				$('.msg').html(out.msg);
				effect_msg();
			}
		});
		e.preventDefault();
	});
</script>
