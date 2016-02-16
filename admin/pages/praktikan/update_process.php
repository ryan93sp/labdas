<?php
	include("../../inc/config.php");
	$idjp = $_POST['idjp'];
	$jadwal = $_POST['jadwal'];
	$stat = $_POST['stat'];
	
	$sql = mysql_query("update praktikan set id_jad_prak='$jadwal', status_pr='$stat' where id_praktikan='$idjp'");
	if ($sql){
		header("location:./?jp=$jadwal&q=1");
	}
	else {
		header("location:./?jp=$jadwal&q=0&msg=".mysql_error());
	}
?>