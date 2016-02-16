<?php
	include("../../inc/config.php");
	$idm = $_POST['idm'];
	$judul = $_POST['judul'];
	$mk = $_POST['mk'];
	$nomor = $_POST['nomor'];
	
	$sql = mysql_query("update modul set judul_modul='$judul', id_mk='$mk', no_modul='$nomor' where id_modul='$idm'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>