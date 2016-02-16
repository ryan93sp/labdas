<?php
include("../../inc/config.php");

$passwordlama = $_POST["passlama"];
$passlama = md5($passwordlama);
$passwordbaru = $_POST["passbaru"];
$passbaru = md5($passwordbaru);
$konfirmasipassword = $_POST["konfirm"];
$username = $_POST["user"];

	$querycek = mysql_query("select * from userlogin where username = '$username' and password = '$passlama'");
	$count = mysql_num_rows($querycek);
	
	if ($count >= 1 && $passwordbaru==$konfirmasipassword){
	$queryupdate = mysql_query("update userlogin set password = '$passbaru' where username = '$username'");
		if($queryupdate){
		 header("location:./?q=1");
		}
	}
	else {
		header("location:./?q=0");
	}
?>