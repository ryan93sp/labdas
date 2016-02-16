<?php
	include("../../inc/config.php");
	$idjp = $_GET['id'];
	$sql = mysql_query("SELECT * FROM jadwal_praktikum where id_jad_prak=$idjp");
	$data =  mysql_fetch_array($sql);
	$prak = $data['id_prak'];
	$sql = mysql_query("delete from jadwal_praktikum where id_jad_prak='$idjp'");
 	if ($sql){
		header("location:./?p=$prak&q=1");
	}
	else {
		header("location:./?p=$prak&q=0&msg=".mysql_error());
	}
?>