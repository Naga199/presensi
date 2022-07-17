<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
	  <div class="col-md-4">
		  <input type="date" class="form-control" placeholder="Start" id="start" name="start" value="<?= date('Y-m-01'); ?>" aria-describedby="sizing-addon2">
	  </div>
	  <div class="col-md-4">
		  <input type="date" class="form-control" placeholder="End" id="end" name="end" value="<?= date('Y-m-t'); ?>" aria-describedby="sizing-addon2">
	  </div>
	  <div class="col-md-4">
		  <button id="btnGo" type="submit" class="form-control btn btn-primary">Go!</button>
	  </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<div class="table-responsive">
		<table id="exportTable" class="table table-bordered table-striped">
		  <thead>
			<tr>
			  <th>Nama</th>
			  <th>Tanggal</th>
			  <th>Masuk</th>
			  <th>Pulang</th>
			  <th>Status</th>
			  <th style="text-align: center;">Aksi</th>
			</tr>
		  </thead>
		  <tbody id="data-laporan">
			
		  </tbody>
		</table>
	</div>
  </div>
</div>
<div id="tempat-modal"></div>
<script>
	$('#btnGo').click(function() {
		if ( $.fn.DataTable.isDataTable('#exportTable') ) {
		  $('#exportTable').DataTable().destroy();
		}
		tampilLaporan($('#start').val(), $('#end').val());
	});
</script>
