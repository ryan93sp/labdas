<?php 
session_start();
if(!isset($_SESSION['ADMIN_LBD'])){
	echo"<script language='JavaScript'>document.location='../../login.php'</script>";
	  exit();
}else{
	if(!$_SESSION['ADMIN_LBD']){
	echo"<script language='JavaScript'>document.location='../../login.php'</script>";
	exit();
	}
}
include("../../inc/config.php");?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laboratorium Dasar Fisika</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="../../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script>
	function mod(modul){
		$.ajax({
		url: "getmodul.php?p="+modul,
		success: function(msg){
		$('#modul').html(msg);
		},
		dataType: "html"
		});
	}
	</script>
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">
      <?PHP include("../../inc/header.php"); ?>
	  </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
			<?PHP include("../../inc/sidebar.php"); ?>
          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Modul Praktikum
            <small>Upload</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li><a href="../modul">Modul</a></li>
			<li class="active"><a href="#">Upload</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Upload modul praktikum</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="upload.php" enctype="multipart/form-data" method="post">
                  <div class="box-body">
					<?php if (!isset($_GET['id'])){ ?>
                    <div class="form-group">
                      <label for="prak">Praktikum</label>
                      <select id="prak" name="prak" class="form-control" onchange='mod($(this).val())' required>
						<option selected disabled>--Praktikum--</option>
							<?php
								$sql = mysql_query("select * from mata_kuliah");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_mk]\">$dt[nama_mk]</option>";}
							?>
						</select>
                    </div>
                    <div class="form-group">
                      <label for="judul">Modul</label>
					  <select id="modul" name="modul" class="form-control" required>
					  <option selected disabled>--Modul--</option>
							<?php
							/* 	$sql = mysql_query("select * from modul");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_modul]\">$dt[id_modul] - $dt[judul_modul]</option>";} */
							?>
					 </select>
                    </div>
					<?php ;} ?>
					<?php
						if (isset($_GET['id'])){
						$idm=$_GET['id'];
						$sql_m = mysql_query("SELECT * FROM modul where id_modul='$idm'");
						$data =  mysql_fetch_array($sql_m);
						$judul = $data['judul_modul'];
						$idmk = $data['id_mk'];
					?>
					<div class="form-group">
                      <label for="prak">Praktikum</label>
                      <select id="prak" name="prak" class="form-control" readonly>
						<?php
							$sql = mysql_query("select * from mata_kuliah where id_mk='$idmk'");
							$dt = mysql_fetch_array($sql);
							echo "<option value=\"$dt[id_mk]\">$dt[nama_mk]</option>";
						?>
						</select>
                    </div>
                    <div class="form-group">
                      <label for="judul">Modul</label>
					  <select id="modul" name="modul" class="form-control" readonly>
						<?php
							$sql = mysql_query("select * from modul where id_modul='$idm'");
							$dt = mysql_fetch_array($sql);
							echo "<option value=\"$dt[id_modul]\">$dt[id_modul] - $dt[judul_modul]</option>";
						?>
					 </select>
                    </div>
					<?php ;} ?>
                    <div class="form-group">
                      <label for="file">File input</label>
                      <input type="file" name="file">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                  </div>
                </form>
            </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="#">Laboratorium Dasar Fisika.</a></strong>
      </footer>

    </div>
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
	<script src="../../dist/js/notif.js" type="text/javascript"></script>
  </body>
</html>