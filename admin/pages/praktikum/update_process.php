<?php
	include("../../inc/config.php");
	$idpr = $_POST['idpr'];
	$stat = $_POST['stat'];
	
	$sql = mysql_query("update praktikum set status='$stat' where id_prak='$idpr'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>