<?php
	/* session_start(); */
	include("../../inc/config.php");
	$idm = $_POST['idm'];
	$judul = $_POST['judul'];
	$idmk = $_POST['mk'];
	$nomor = $_POST['nomor'];

	$sql = mysql_query("insert into modul values('$idm', '$judul', '$idmk', '$nomor', '')");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>