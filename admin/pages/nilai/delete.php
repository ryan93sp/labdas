<?php
	include("../../inc/config.php");
	$idn = $_GET['id'];
	$sql_s = mysql_query("select * from nilai join praktikan on praktikan.id_praktikan=nilai.id_praktikan where id_nilai='$idn'");
	$data =  mysql_fetch_array($sql_s);
	$idm = $data['id_modul'];
	$idjp = $data['id_jad_prak'];
	$sql = mysql_query("delete from nilai where id_nilai='$idn'");
	if ($sql){
		header("location:./?m=$idm&p=$idjp&q=1");
	}
	else {
		header("location:./?m=$idmodul&p=$idjadwal&q=0&msg=".mysql_error());
	}
?>