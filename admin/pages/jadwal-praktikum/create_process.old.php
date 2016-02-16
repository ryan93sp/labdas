<?php
	include("../../inc/config.php");
	$idjp = $_POST['idjp'];
	$prak = $_POST['prak'];
	$jadwal = $_POST['jadwal'];
	$kuota = $_POST['kuota'];
	
	$sql = mysql_query("insert into jadwal_praktikum values('$idjp', '$prak', '$jadwal', '$kuota')");
	if ($sql){
		header("location:./?p=$prak&q=1");
	}
	else {
		header("location:./?p=$prak&q=0&msg=".mysql_error());
	}
?>