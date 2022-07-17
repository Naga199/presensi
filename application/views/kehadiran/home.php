<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-5">
        <button class="form-control btn btn-success" data-toggle="modal" data-id="check In" data-target="#tambah-kehadiran"><i class="glyphicon glyphicon-arrow-right"></i> Check In</button>
    </div>
    <div class="col-md-5">
        <button class="form-control btn btn-warning" data-toggle="modal" data-id="check Out" data-target="#tambah-kehadiran"><i class="glyphicon glyphicon-arrow-left"></i> Check Out</button>
    </div>
    <div class="col-md-2">
        <a href="<?php echo base_url('kehadiran/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Excel</a>
    </div>
    <!--<div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-kehadiran"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>-->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<div class="table-responsive">
		<table id="list-data" class="table table-bordered table-striped">
		  <thead>
			<tr>
			  <th>Nama</th>
			  <th>Masuk</th>
			  <th>Pulang</th>
			  <!--<th style="text-align: center;">Aksi</th>-->
			</tr>
		  </thead>
		  <tbody id="data-kehadiran">
			
		  </tbody>
		</table>
	</div>
  </div>
</div>

<?php echo $modal_tambah_kehadiran; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-datakehadiran', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'kehadiran';
  $data['url'] = 'kehadiran/import';
  echo show_my_modal('modals/modal_import', 'import-kehadiran', $data);
?>
