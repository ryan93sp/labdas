<?php
	include("../../inc/config.php");
	
	$idp = $_POST['idp'];
	$pengawas = $_POST['pengawas'];
	$idjp = $_POST['jadwal'];

	$sql = mysql_query("insert into pengawas values('$idp', '$idjp', '$pengawas')");
	if ($sql){
		header("location:./?jp=$idjp&q=1");
	}
	else { 
		header("location:./?jp=$idjp&q=0&msg=".mysql_error());
	}
		
?>