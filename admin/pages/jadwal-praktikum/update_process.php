<?php
	include("../../inc/config.php");
	$idjp = $_POST['idjp'];
	$prak = $_POST['prak'];
	$kuota = $_POST['kuota'];
	
	$sql = mysql_query("update jadwal_praktikum set kuota='$kuota' where id_jad_prak='$idjp'");
	if ($sql){
		header("location:./?p=$prak&q=1");
	}
	else {
		header("location:./?p=$prak&q=0&msg=".mysql_error());
	}
?>