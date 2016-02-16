<?php 
session_start();
include("../../inc/config.php");
$idm = $_POST['modul'];
$idmk = $_POST['prak'];
	
	if(($_FILES["file"]["type"])!='application/pdf'){
		$re=$_FILES["file"]["type"];
		echo "Jenis file yang anda kirim salah! ".$re;
	}
	else{
		$newname=$idmk."-".$idm."-".Date("Ymd")."-".Date("His");
		$file="../../../file/".$newname.$_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],$file);
		$fileloc="file/".$newname.$_FILES["file"]["name"];
		$sql = mysql_query("update modul set file='$fileloc' where id_modul='$idm'");
		if($sql){
			header("location:./");
		}
	}
?>