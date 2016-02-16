<?php
	include("../../inc/config.php");
	$idpr = $_GET['id'];
	$sql = mysql_query("delete from praktikum where id_prak='$idpr'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>