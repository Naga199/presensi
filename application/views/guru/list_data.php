<?php
foreach ($dataguru as $guru) {
?>
  <tr>
    <td style="min-width:230px;"><?php echo $guru["kode_guru"]; ?></td>
    <td><?php echo $guru["nama_guru"]; ?></td>
    <td><?php echo $guru["nuptk_guru"]; ?></td>
    <td><?php echo $guru["jk_guru"] === 1 ? 'Laki-laki' : 'Perempuan'; ?></td>
    <td><?php echo $guru["ttl_guru"]; ?></td>
    <td><?php echo $guru["kota"]; ?></td>
    <td><?php echo $guru["telp_guru"]; ?></td>
    <td><?php echo $guru["email_guru"]; ?></td>
    <td><?php echo $guru["posisi"]; ?></td>
    <td><?php echo $guru["statuskepegawaian_guru"]; ?></td>
    <td><?php echo $guru["alamat_guru"]; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataguru" data-id="<?php echo $guru["id_guru"]; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
      <?php if ($this->userdata->type === 'admin') { ?>
        <button class="btn btn-danger konfirmasiHapus-guru" data-id="<?php echo $guru["id_guru"]; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i></button>
      <?php } ?>
    </td>
  </tr>
<?php
}
?>