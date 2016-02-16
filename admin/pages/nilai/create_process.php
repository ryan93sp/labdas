<?php
	include("../../inc/config.php");

	$idn = $_POST['idn'];
	$idjp = $_POST['idjp'];
	$modul = $_POST['modul'];
	$praktikan = $_POST['praktikan'];
	$awal = $_POST['awal'];
	$npraktik = $_POST['praktik'];
	$akhir = $_POST['akhir'];
	$sql = mysql_query("insert into nilai values ('$idn', '$modul', '$praktikan', '$awal', '$npraktik', '$akhir')");
	if ($sql){
		header("location:./?m=$modul&p=$idjp&q=1");
	}
	else {
		header("location:./?m=$modul&p=$idjp&q=0&msg=".mysql_error());
	}
?>