<?php include ('../admin/inc/config.php'); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Administrator | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../admin/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="../admin/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script>
	/* $(document).ready(function(){
	}); */
	function jad(prak){
		$.ajax({
		url: "getjad.php?p="+prak,
		success: function(msg){
		$('#jadwal').html(msg);
		},
		dataType: "html"
		});
	}
	function pilihjur(fak){
		$.ajax({
		url: "getjur.php?p="+fak,
		success: function(msg){
		$('#jurusan').html(msg);
		},
		dataType: "html"
		});
	}
	</script>
  </head>
  <body class="skin-blue" style="background: #D2D6DE none repeat scroll 0% 0%;">
  
		<nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button> -->
                <a class="navbar-brand" href="../">
                    <i class="fa fa-play-circle"></i><span> Home</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<div class="container">
       <!-- Main content -->
        <section class="content" style="padding:0">
			<div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Form Pendaftaran </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="registerproses.php" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nim">NIM</label>
                      <input type="number" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" value="" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
						<label for="prak">Fakultas</label>
						<select id="fak" name="fak" class="form-control" onchange='pilihjur($(this).val())' required>
						<option selected disabled>--Fakultas--</option>
							<?php
								$sql = mysql_query("select * from  fakultas");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_fakultas]\">$dt[nama_fakultas]</option>";}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="jurusan">Jurusan</label>
						<select id="jurusan" class="form-control" name="jurusan">
							<option>--Pilih Jurusan--</option>
						   </select>
					</div>
                    
					<div class="form-group">
						<label for="prak">Praktikum</label>
						<select id="prak" name="prak" class="form-control" onchange='jad($(this).val())' required>
						<option selected disabled>--Praktikum--</option>
							<?php
								$sql = mysql_query("select * from  praktikum join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk where status=1");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_prak]\">$dt[nama_mk] - Semester $dt[semester] / $dt[tahun_ajaran]</option>";}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="jadwal">Jadwal</label>
						<select id="jadwal" name="jadwal" class="form-control" required>
							<option selected disabled>--Pilih Jadwal--</option>
						</select>
					</div>
					<div class="form-group">
					 <label for="InputFile">Upload KRS</label>
                      <input type="file" id="InputFile" name="krs" required>
                     </div>
                     <div class="checkbox">
						<label>
							<input type="checkbox" required>Saya berjanji akan mematuhi segala peraturan yang berlaku
						</label>
					</div>
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
                  </div>
                </form>
            </div>
        </section><!-- /.content -->
	</div>

    <script src="../admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../admin/dist/js/app.min.js" type="text/javascript"></script>

  </body>
</html>