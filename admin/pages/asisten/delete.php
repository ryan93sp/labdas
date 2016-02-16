<?php
	include("../../inc/config.php");
	$idas = $_GET['id'];
	$sql = mysql_query("delete from asisten where id_asisten='$idas'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>