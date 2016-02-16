<?php
	include("../../inc/config.php");
	$idn = $_POST['idn'];
	$awal = $_POST['awal'];
	$praktik = $_POST['praktik'];
	$akhir = $_POST['akhir'];
	$idmodul = $_POST['idmodul'];
	$idjadwal = $_POST['idjadwal'];
	$sql = mysql_query("update nilai set nilai_lap_awal='$awal', nilai_prak='$praktik', nilai_laporan='$akhir' where id_nilai='$idn'");
	if ($sql){
		header("location:./?m=$idmodul&p=$idjadwal&q=1");
	}
	else {
		header("location:./?m=$idmodul&p=$idjadwal&q=0&msg=".mysql_error());
	}
?>