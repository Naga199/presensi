<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
	<?php if($this->userdata->type == 'guru') { ?>
		<div class="col-md-9" style="padding: 0;">
			<button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-izin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
		</div>
	<?php } ?>
    <div class="col-md-3">
        <a href="<?php echo base_url('izin/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <!--<div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-izin"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>-->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<div class="table-responsive">
		<table id="list-data" class="table table-bordered table-striped">
		  <thead>
			<tr>
			  <th>Nama</th>
			  <!--<th>NUPTK</th>-->
			  <th>Type Izin</th>
			  <th>Tanggal Awal</th>
			  <th>Tanggal Akhir</th>
			  <th>Keterangan</th>
			  <th>Status</th>
			  <th>Tanggal Pengajuan</th>
			  <th>Tanggal Approval</th>
			  <!--<th>Catatan</th>-->
			  <th>Pemroses</th>
			  <th style="text-align: center;">Aksi</th>
			</tr>
		  </thead>
		  <tbody id="data-izin">
			
		  </tbody>
		</table>
	</div>
  </div>
</div>

<?php echo $modal_tambah_izin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataizin', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'izin';
  $data['url'] = 'izin/import';
  echo show_my_modal('modals/modal_import', 'import-izin', $data);
?>
