<?php
	include("../../inc/config.php");
	$idjp = $_POST['idjp'];
	$jadwal = $_POST['jadwal'];
	$stat = $_POST['stat'];
	
	$sql = mysql_query("update praktikan set id_jad_prak='$jadwal', status_pr='$stat' where id_praktikan='$idjp'");
	if ($sql){
		header("location:./");
	}
	else {
		header("location:./".mysql_error());
	}
?>