<?php
	include("../../inc/config.php");
	$nim = $_GET['nim'];
	$sql = mysql_query("delete from mahasiswa where nim='$nim'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>