<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
	});

	window.onload = function() {
		tampilUser();
		tampilGuru();
		tampilIzin();
		tampilKehadiran();
		tampilPosisi();
		tampilKota();
		tampilLaporan();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	//User
	function tampilUser() {
		$.get('<?php echo base_url('user/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-user').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-user", function() {
		id_pegawai = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-datauser", function() {
		var id = id_pegawai;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('user/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilUser();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-datauser", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('user/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-user').modal('show');
		})
	})

	$('#form-tambah-user').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('user/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilUser();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-user").reset();
				$('#tambah-user').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-user', function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('user/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilUser();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-user").reset();
				$('#update-user').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-user, #update-user').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	});

	//Guru
	function tampilGuru() {
		$.get('<?php echo base_url('guru/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-guru').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-guru", function() {
		id_pegawai = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataguru", function() {
		var id = id_pegawai;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('guru/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilGuru();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataguru", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('guru/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-guru').modal('show');
		})
	})

	$('#form-tambah-guru').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('guru/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilGuru();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-guru").reset();
				$('#tambah-guru').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-guru', function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('guru/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilGuru();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-guru").reset();
				$('#update-guru').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-guru, #update-guru').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	});

	//Kota
	function tampilKota() {
		$.get('<?php echo base_url('Kota/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kota').html(data);
			refresh();
		});
	}

	var id_kota;
	$(document).on("click", ".konfirmasiHapus-kota", function() {
		id_kota = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKota", function() {
		var id = id_kota;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilKota();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kota').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-kota').modal('show');
		})
	})

	$('#form-tambah-kota').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kota").reset();
				$('#tambah-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kota', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kota").reset();
				$('#update-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Posisi
	function tampilPosisi() {
		$.get('<?php echo base_url('Posisi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-posisi').html(data);
			refresh();
		});
	}

	var id_posisi;
	$(document).on("click", ".konfirmasiHapus-posisi", function() {
		id_posisi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPosisi", function() {
		var id = id_posisi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPosisi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-posisi').modal('show');
		})
	})

	$(document).on("click", ".detail-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-posisi').modal('show');
		})
	})

	$('#form-tambah-posisi').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-posisi").reset();
				$('#tambah-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-posisi', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-posisi").reset();
				$('#update-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Izin
	function tampilIzin() {
		$.get('<?php echo base_url('izin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-izin').html(data);
			refresh();
		});
	}

	$('#form-tambah-izin').submit(function(e) {
		const data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('izin/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilIzin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-izin").reset();
				$('#tambah-izin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	
	$(document).on("click", ".update-dataizin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('izin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-izin').modal('show');
		})
	})
	
	$(document).on('submit', '#form-update-izin', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('izin/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilIzin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-izin").reset();
				$('#update-izin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-izin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-izin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Presensi
	function tampilKehadiran() {
		$.get('<?php echo base_url('kehadiran/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kehadiran').html(data);
			refresh();
		});
	}

	$('#form-tambah-kehadiran').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'GET',
			url: '<?php echo base_url('kehadiran/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKehadiran();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kehadiran").reset();
				$('#tambah-kehadiran').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	
	$(document).on("click", ".detail-kehadiran", function() {
		var id = $(this).attr("data-id");
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Laporan/detail'); ?>",
			data: "id=" +id,
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-kehadiran').modal('show');
		})
	});
	
	//laporan
	function tampilLaporan(start="<?= date('Y-m-01'); ?>", end="<?= date('Y-m-t'); ?>") {
	  var reportTable = $('#exportTable').dataTable({});
		$.get('<?php echo base_url('laporan/tampil'); ?>', { start: start, end: end }, function(data) {
			reportTable.fnDestroy();
			$('#data-laporan').html(data);
			reportTable = $('#exportTable').dataTable({
				bSort: true,
				dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
				  "<'row'<'col-sm-12'tr>>" +
				  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
				//"dom": 'Blfrtip',
				/*"lengthChange": false,
				"lengthMenu": [
				  [50, 100, 1000, -1],
				  [50, 100, 1000, "All"]
				],*/
				"initComplete": function() {
				  $("#exportTable").show();
				},
				buttons: [ /*'copy',*/ 'excel', 'pdf' /*, 'print' , 'colvis'*/ ]
			});
			$('.buttons-excel').addClass("btn btn-success");
		});
	}
</script>
