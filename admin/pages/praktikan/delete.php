<?php
	include("../../inc/config.php");
	$idpt = $_GET['id'];
	$sql = mysql_query("SELECT * FROM praktikan where id_praktikan=$idpt");
	$data =  mysql_fetch_array($sql);
	$idjp = $data['id_jad_prak'];
	$kuota = mysql_query("select * from jadwal_praktikum where id_jad_prak=$idjp");
	$dkuota = mysql_fetch_array($kuota);
	$newkuota = $dkuota['kuota'] + 1;
	$sql = mysql_query("delete from praktikan where id_praktikan='$idpt'");
	if ($sql){
		mysql_query("UPDATE jadwal_praktikum SET kuota='$newkuota' WHERE id_jad_prak='$idjp'");
		header("location:./?jp=$idjp&q=1");
	}
	else {
		header("location:./?jp=$idjp&q=0&msg=".mysql_error());
	}
?>