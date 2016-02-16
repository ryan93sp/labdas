<?php
	include("../../inc/config.php");
	$idjp = $_POST['idjp'];
	$prak = $_POST['prak'];
	$ta = $_POST['ta'];
	$sem = $_POST['sem'];
	$stat = $_POST['stat'];
	
	$sql = mysql_query("insert into praktikum values('$idjp', '$prak', '$sem', '$ta', '$stat')");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>