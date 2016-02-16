<?php
	include("../../inc/config.php");
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$jur = $_POST['jur'];
	
	$sql = mysql_query("update mahasiswa set nama='$nama', id_jurusan='$jur' where nim='$nim'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>