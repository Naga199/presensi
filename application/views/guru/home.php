<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
	  <?php if($this->userdata->type === 'admin') {?>
    <div class="col-md-9" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-guru"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <?php } ?>
    <div class="col-md-3">
        <a href="<?php echo base_url('guru/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <!--<div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-guru"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>-->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<div class="table-responsive">
		<table id="list-data" class="table table-bordered table-striped">
		  <thead>
			<tr>
			  <th>Kode</th>
			  <th>Nama</th>
			  <th>NUPTK</th>
			  <th>Jenis Kelamin</th>
			  <th>Tanggal Lahir</th>
			  <th>Asal Kota</th>
			  <th>No Telp</th>
			  <th>Email</th>
			  <th>Jenis PTK</th>
			  <th>Status</th>
			  <th>Alamat</th>
			  <th style="text-align: center;">Aksi</th>
			</tr>
		  </thead>
		  <tbody id="data-guru">
		  </tbody>
		</table>
	</div>
  </div>
</div>

<?php echo $modal_tambah_guru; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataguru', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'guru';
  $data['url'] = 'guru/import';
  echo show_my_modal('modals/modal_import', 'import-guru', $data);
?>
