<?php
	include("../../inc/config.php");
	$idjp = $_POST['idjp'];
	$prak = $_POST['prak'];
	$jadwal = $_POST['jadwal'];
	$kuota = $_POST['kuota'];
	
	$query1 = mysql_query("select * from praktikum where id_prak='$prak'");
	$dtq1 = mysql_fetch_array($query1);
	$sem = $dtq1['semester'];
	$ta = $dtq1['tahun_ajaran'];
	
	$query2 = mysql_query("select * from jadwal_praktikum join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak where id_jadwal='$jadwal' and semester='$sem' and tahun_ajaran='$ta'");
	$dtq2 = mysql_fetch_array($query2);
	$idmk = $dtq2['id_mk'];
	
	$query3 = mysql_query("select * from mata_kuliah where id_mk='$idmk'");
	$dtq3 = mysql_fetch_array($query3);
	$num = mysql_num_rows($query2);
	
	if($num==1){
		//echo "Jadwal yang di input sudah ada";
		header("location:./?p=$prak&q=0&msg=Jadwal yang di input sudah digunakan praktikum ".$dtq3['nama_mk']);
		}
	else{
		$sql = mysql_query("insert into jadwal_praktikum values('$idjp', '$prak', '$jadwal', '$kuota')");
		if ($sql){
			header("location:./?p=$prak&q=1");
		}
		else {
			header("location:./?p=$prak&q=0&msg=".mysql_error());
		}
	}
?>