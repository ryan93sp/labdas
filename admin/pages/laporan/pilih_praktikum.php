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
include("../../inc/config.php"); 
if (isset($_POST['prak'])){
	$prak=$_POST['prak'];
	$jur=$_POST['jur'];
	header("location:./nilai_akhir.php?p=$prak&jurusan=$jur");}
?>
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
	function jurusan(fak){
		$.ajax({
		url: "getjur.php?p="+fak,
		success: function(msg){
		$('#jur').html(msg);
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
            Praktikum
            <small>Pilih</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active"><a href="#">Laporan</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="box box-primary">
                <div class="box-header">
                  
				  
                </div><!-- /.box-header -->
                <!-- form start -->
				
                <form role="form" action="pilih_praktikum.php" method="post">
                  <div class="box-body">
					<div class="form-group">
                      <label for="prak">Praktikum</label>
                      <select id="prak" name="prak" class="form-control" required>
						<option selected disabled>--Praktikum--</option>
							<?php
								$sql = mysql_query("select * from praktikum join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk order by tahun_ajaran desc");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_prak]\">$dt[nama_mk] Tahun Ajaran $dt[tahun_ajaran] Semester $dt[semester]</option>";}
							?>
						</select>
                    </div>
					<div class="form-group">
						<label for="prak">Fakultas</label>
						<select id="fak" name="fak" class="form-control" onchange='jurusan($(this).val())' required>
						<option selected disabled>--Fakultas--</option>
							<?php
								$sql = mysql_query("select * from  fakultas");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_fakultas]\">$dt[nama_fakultas]</option>";}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="jur">Jurusan</label>
						<select id="jur" name="jur" class="form-control" required>
							<option selected disabled>--Jurusan--</option>
						</select>
					</div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Pilih</button>
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