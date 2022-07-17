<?php
$index = 0;
foreach ($dataguru as $key => $guru) {
	
$end = $end->modify( '+1 day' ); 
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($start, $interval ,$end);

	foreach($daterange as $i) {
	//for($i = $awal; $i <= $end; $i->modify('+1 day')) {
		echo '<tr><td style="min-width:230px;">'.$guru->nama_guru.'</td>';
		$status = 'Alpha';
		$tdAksi = '<td></td>';
		$in = '';
		$out = '';
		echo '<td>'.$i->format("Y-m-d").'</td>';
		foreach ($datakehadiran as $kehadiran) {
		  if($guru->id_guru === $kehadiran->id_guru && $i->format("Y-m-d") == $kehadiran->date) {
			  $status = 'Hadir';
			  $id = $kehadiran->id_presensi ? $kehadiran->id_presensi : 0;
			  $in = $kehadiran->masuk_guru;
			  $out = $kehadiran->pulang_guru;
			  $tdAksi = '<td class="text-center">
				<button class="btn btn-primary detail-kehadiran" data-id='.$id.'><i class="glyphicon glyphicon-info-sign"></i></button>
			  </td>';
			  //$img_in = $kehadiran->image_masuk_guru;
			  //$img_out = $kehadiran->image_pulang_guru;
		?>
			  <!--<td class="text-center" style="min-width:230px;">
				<button class="btn btn-warning update-datakehadiran" data-id="<?php echo $kehadiran->id_presensi; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
				<button class="btn btn-danger konfirmasiHapus-kehadiran" data-id="<?php echo $kehadiran->id_presensi; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i></button>
			  </td>-->
<?php
		  }
		}
		
		foreach ($dataizin as $izin) {
		  if($guru->id_guru === $izin->id_guru && $izin->status == 'Disetujui' && ($i->format("Y-m-d") >= $izin->tgl_izin_awal && $i->format("Y-m-d") <= $izin->tgl_izin_akhir)) {
			  $status = $izin->type_izin;
		  }
	    }
	    
	    
		echo '<td>'.$in.'</td>';
		echo '<td>'.$out.'</td>';
		echo '<td>'.$status.'</td>';
		echo $tdAksi.'</tr>';
	}
}
?>
