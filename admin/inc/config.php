<?PHP
//untuk pengaturan koneksi database
date_default_timezone_set("Asia/Jakarta") ;//pengaturan zona waktu
$host = "localhost";//nama host dari database
$user = "root";//username host dari database
$pass = ""; //password database
$db = "labdas"; //nama database
$koneksi = mysql_connect($host, $user, $pass); //melakukan koneksi ke host
	if (!$koneksi){ //jika konesi ke database gagal maka munculkan pesan error
	echo "Couldn't connect to host $host because <b> ".mysql_error()."</b>";
	}else{//sebaliknya jika koneksi berhasil
	$select_db = mysql_select_db($db);//melakukan pemilihan database berdasarkan value dari $db
		if (!$select_db){//jika pemilihan database gagal maka munculkan pesan error
			echo "Couldn't select database $db because <b>".mysql_error()."</b>";
		}
	}
?>