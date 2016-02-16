<?php
include ('../admin/inc/config.php');
session_start();
#jika ditekan tombol login
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5($password);
	$sql = mysql_query("SELECT * FROM userlogin WHERE username='$username' && password='$pass'");
	$num = mysql_num_rows($sql);
	$dt = mysql_fetch_array($sql);
	$akses = $dt['akses'];
	if($num==1){
			// login benar //
			$_SESSION['ADMIN_LBD'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['akses'] = $akses;
			$result = mysql_query("update userlogin set last_login = now() where username='$username'");
			?><script language="JavaScript">
				 document.location='index.php'</script>
			<?php
		} 
	else{
			// jika login salah //
			echo "<script>
			alert (' Maaf Login Gagal, Silahkan Isi Username dan Password Anda Dengan Benar');
			eval(\"parent.location='login.php '\");	
			</script>";
		}
	}
?>