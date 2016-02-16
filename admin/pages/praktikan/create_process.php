<?php
	include("../../inc/config.php");
	
	$idpt = $_POST['idpt'];
	$idpr = $_POST['idpr'];
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$jur = $_POST['jur'];
	$jadwal = $_POST['jadwal'];
	$stat = $_POST['stat'];
	
	$select = mysql_query("select * from mahasiswa where nim=$nim");
	$kuota = mysql_query("select * from jadwal_praktikum where id_jad_prak=$jadwal");
	$dkuota = mysql_fetch_array($kuota);
	$newkuota = $dkuota['kuota'] - 1;
	$data =  mysql_fetch_array($select);
	$nimselect = $data['nim'];
if($dkuota['kuota']>=1){
	if ($nimselect==$nim){
		$sql = mysql_query("insert into praktikan values('$idpt', '$jadwal', '$idpr', '$nim', '', '$stat')");
		if ($sql){
			mysql_query("UPDATE jadwal_praktikum SET kuota='$newkuota' WHERE id_jad_prak='$jadwal'");
			header("location:./?jp=$jadwal&q=1");
		}
		else {
			header("location:./?jp=$jadwal&q=0&msg=".mysql_error());
		}
	}
	else{
		$sql1 = mysql_query("insert into mahasiswa values('$nim', '$nama', '$jur')");
		$sql2 = mysql_query("insert into praktikan values('$idpt', '$jadwal', '$idpr', '$nim', '', '$stat')");
		if ($sql1 && $sql2){
			mysql_query("UPDATE jadwal_praktikum SET kuota='$newkuota' WHERE id_jad_prak='$jadwal'");
			header("location:./?jp=$jadwal&q=1");
		}
		else {
			header("location:./?jp=$jadwal&q=0&msg=".mysql_error());
		}
	}
}
else {header("location:./?jp=$jadwal&q=0&msg=Jadwal sudah Penuh");}
?>