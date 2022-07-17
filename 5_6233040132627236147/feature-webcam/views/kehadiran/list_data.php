<?php
  foreach ($datakehadiran as $kehadiran) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $kehadiran->guru; ?></td>
      <td><?php echo $kehadiran->masuk_guru; ?></td>
      <td><?php echo $kehadiran->pulang_guru; ?></td>
      <!--<td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-datakehadiran" data-id="<?php echo $kehadiran->id_presensi; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-danger konfirmasiHapus-kehadiran" data-id="<?php echo $kehadiran->id_presensi; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i></button>
      </td>-->
    </tr>
    <?php
  }
?>
