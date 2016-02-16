<?php
include ('admin/inc/config.php');
	if (isset($_POST['submit']))
		{
							
			$nim=$_POST['nim'];
			$prak=$_POST['praktikum'];
								
			$check=mysql_query("SELECT * FROM praktikan WHERE nim='$nim' and id_prak='$prak'");

			$data= mysql_fetch_array($check);
			
			if ($data['nim'] != $nim & $data['id_prak']!= $prak)
			{
				?>				
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="./css/bootstrap.min.css">
					<link rel="stylesheet" href="./css/bootstrap.css">
					<script src="./js/jquery.easing.min.js"></script>
					<script src="./js/bootstrap.min.js"></script>
					<div class="container">
						</br><div class="alert alert-info">
								<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong> <strong>Info!</strong> anda belum terdaftar..
							</div>
					</div>
  
					<?php
			}
	
			else if ($data['status_pr']==0) //check Jadwal
			
				{
					?>				
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="./css/bootstrap.min.css">
					<link rel="stylesheet" href="./css/bootstrap.css">
					<script src="./js/jquery.easing.min.js"></script>
					<script src="./js/bootstrap.min.js"></script>
					<div class="container">
						</br><div class="alert alert-info">
								<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong> <strong>Info!</strong> sedang proses konfirmasi pendaftaran..
							</div>
					</div>
  
					<?php
				}
			else if ($data['status_pr']==1)
				{
					?>				
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="./css/bootstrap.min.css">
					<link rel="stylesheet" href="./css/bootstrap.css">
					<script src="./js/jquery.easing.min.js"></script>
					<script src="./js/bootstrap.min.js"></script>
					
					<?php
						$jad=mysql_query("SELECT * FROM jadwal_praktikum join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal join hari on hari.id_hari=jadwal.id_hari join shift on shift.id_shift=jadwal.id_shift WHERE id_prak='$prak'");
						$dtj=mysql_fetch_array($jad);
						$mk=mysql_query("SELECT * FROM praktikum join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk WHERE id_prak='$prak'");
						$dtmk=mysql_fetch_array($mk);
					?>
					<div class="container">	</br><div class="alert alert-success">
								<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong> <strong>Info!</strong> Anda telah terdaftar sebagai praktikan
							</div>
							<div>Praktikum : <?php echo $dtmk['nama_mk']; ?><br>
							Jadwal : <?php echo $dtj['nama_hari'].' | '.$dtj['ket_shift']; ?></div>
					</div>
  
					<?php
				}
			else 
				{ 
					?>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="./css/bootstrap.min.css">
					<link rel="stylesheet" href="./css/bootstrap.css">
					<script src="./js/jquery.easing.min.js"></script>
					<script src="./js/bootstrap.min.js"></script>
					<div class="container">
						</br><div class="alert alert-info">
								<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong> <strong>Info!</strong> Data belum Valid, segera hubungi ADMIN..
							</div>
					</div>
  
					<?php
				}
		}
					
					?>
					
				 
								
								