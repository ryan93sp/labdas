<?php
	include("../../inc/config.php");
	$idas = $_POST['idas'];
	$nama = $_POST['nama'];
	
	$sql = mysql_query("update asisten set id_asisten='$idas', nama_asisten='$nama' where id_asisten='$idas'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>