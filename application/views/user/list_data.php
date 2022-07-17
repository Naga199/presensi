<?php
  foreach ($datauser as $user) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $user->username_admin; ?></td>
      <td><?php echo $user->nama_admin; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-datauser" data-id="<?php echo $user->id_admin; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-danger konfirmasiHapus-user" data-id="<?php echo $user->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i></button>
      </td>
    </tr>
    <?php
  }
?>
