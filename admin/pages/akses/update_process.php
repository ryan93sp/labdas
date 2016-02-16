<?php
	include("../../inc/config.php");
	$user = $_POST['user'];
	$password = $_POST['password'];
	$pass = md5($password);
	$akses = $_POST['akses'];
	
	$sql = mysql_query("update userlogin set password='$pass', akses='$akses' where username='$user'");
	if ($sql){
		header("location:./?q=1");
	}
	else {
		header("location:./?q=0&msg=".mysql_error());
	}
?>