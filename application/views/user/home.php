<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-9" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-user"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('user/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <!--<div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-user"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>-->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<div class="table-responsive">
		<table id="list-data" class="table table-bordered table-striped">
		  <thead>
			<tr>
			  <th>Username</th>
			  <th>Nama Lengkap</th>
			  <th style="text-align: center;">Aksi</th>
			</tr>
		  </thead>
		  <tbody id="data-user">
			
		  </tbody>
		</table>
	</div>
  </div>
</div>

<?php echo $modal_tambah_user; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-datauser', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'user';
  $data['url'] = 'user/import';
  echo show_my_modal('modals/modal_import', 'import-user', $data);
?>
