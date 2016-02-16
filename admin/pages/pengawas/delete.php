<?php
	include("../../inc/config.php");
	$idp = $_GET['id'];
	$sql = mysql_query("SELECT * FROM pengawas where id_pengawas=$idp");
	$data =  mysql_fetch_array($sql);
	$idjp = $data['id_jad_prak'];
	$sql = mysql_query("delete from pengawas where id_pengawas='$idp'");
	if ($sql){
		header("location:./?jp=$idjp&q=1");
	}
	else { 
		header("location:./?jp=$idjp&q=0&msg=".mysql_error());
	}
?>