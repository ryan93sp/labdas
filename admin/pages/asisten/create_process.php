<?php
	include("../../inc/config.php");
	$idas = $_POST['idas'];
	$nama = $_POST['nama'];
		
	$sql = mysql_query("insert into asisten values('$idas', '$nama')");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
	
?>