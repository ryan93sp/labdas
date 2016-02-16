<?php
	/* session_start(); */
	include("../../inc/config.php");
	$idm = $_GET['id'];
	$sql = mysql_query("delete from modul where id_modul='$idm'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>