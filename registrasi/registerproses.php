<?php

include ('../admin/inc/config.php');

if(isset($_POST['submit']))
{
	$nama=$_POST["nama"];
	$nim=$_POST["nim"];
	$jurusan=$_POST["jurusan"];
	$prak=$_POST["prak"];
	$jadwal=$_POST["jadwal"];
	// upload krs
	$target_dir = "uploads/";
	$newname=$nim."-".Date("Ymd")."-".Date("His");
	$target_file = $target_dir . $newname.basename($_FILES["krs"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
   
    if((($_FILES["krs"]["type"])=='application/pdf') || ($_FILES["krs"]["type"] == "image/jpeg") || ($_FILES["krs"]["type"] == "image/pjpeg")) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
				if (move_uploaded_file($_FILES["krs"]["tmp_name"], $target_file)){	
					//echo "The file ". basename( $_FILES["krs"]["name"]). " has been uploaded.";
					} 
				else {
						echo "Sorry, there was an error uploading your file.";
					}
	}
	else{
			echo "File yang anda upload salah";
			$uploadOk = 0;
	}
//register
	$krs="uploads/".$newname.basename($_FILES["krs"]["name"]);
	$sql1=mysql_query("SELECT * FROM jadwal_praktikum WHERE id_jad_prak='$jadwal'" );
	$query=mysql_fetch_array($sql1);
	$check=mysql_query("SELECT * FROM praktikan WHERE nim=$nim and id_prak='$prak'");

	if($query)
		{
			if (mysql_num_rows($check)>0) //check Jadwal
				{
		
	
					?>				
					<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/bootstrap.css">
  
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
					<div class="container">
 
  </br><div class="alert alert-info">
   
	<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> <strong>Info!</strong> Anda telah terdaftar.
  </div>
  <a href="../" class="btn btn-info">Home</a>
  </div>
  
</div>
					<?php
				}
			else if ($query['kuota'] >= 1)//batas jumlah maksimal per kelas
				{
					$sql = mysql_query("select * from mahasiswa where nim=$nim");
					$query2 = mysql_fetch_array($sql);
					$jadwalkuota = $query['kuota'] - 1;
	
					mysql_query("UPDATE jadwal_praktikum SET kuota='$jadwalkuota' WHERE id_jad_prak='$jadwal' ");


					if ($query2['nim']==$nim)
						{
							$queryp = mysql_query("INSERT INTO praktikan (id_praktikan,nim,id_jad_prak,id_prak,krs,status_pr) VALUES ('','$nim','$jadwal','$prak','$krs','0')");
		
							if($queryp)
								{
									
									?>				
					<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/bootstrap.css">
  
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
					<div class="container">
 
  </br><div class="alert alert-success">
   
	<a href="../index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> <strong>sukses!</strong> Silahkan Cek Status Pendaftaran
  </div>
  <a href="../" class="btn btn-info">Home</a>
  </div>
  
</div>
					<?php
			
								}
							else
								{echo "Error: ccd1".mysql_error();}
						}
	
					else
						{
							$sql1= ("INSERT INTO mahasiswa(nim,nama,id_jurusan) VALUES($nim,'$nama','$jurusan')");
							//echo $sql1;
							$sql2=("INSERT INTO praktikan (id_praktikan,nim,id_jad_prak,id_prak,krs,status_pr) VALUES ('',$nim,'$jadwal','$prak','$krs','0')");
							$query1=mysql_query($sql1);
							$query2=mysql_query($sql2);
							if($query1 && $query2)
								{
												?>				
					<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/bootstrap.css">
  
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
					<div class="container">
 
  </br><div class="alert alert-success">
	<a href="../index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong> <strong>sukses!</strong> Silahkan Cek Status Pendaftaran
  </div>
  <a href="../" class="btn btn-info">Home</a>
  </div>
  
</div>
					<?php
								}
							else
								{echo "Error: ccd2".mysql_error();}
						}
				}
		
			else
				{
								?>				
					<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/bootstrap.css">
  
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
					<div class="container">
 
  </br><div class="alert alert-warning">
   
	<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> <strong>Warning!</strong>Jadwal yang anda pilih sudah penuh, silahkan pilih jadwal lain.
  </div>
  </div>
  
</div>
					<?php
				}
		}
}
?>