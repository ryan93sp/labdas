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
$idjp = $_GET['p'];
$idm = $_GET['m'];

	$sql_p = mysql_query("select * from jadwal_praktikum 
	join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak
	JOIN mata_kuliah ON praktikum.id_mk = mata_kuliah.id_mk
	join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal 
	join shift on shift.id_shift=jadwal.id_shift 
	join hari on hari.id_hari=jadwal.id_hari 
	where id_jad_prak='$idjp'");
	$d =  mysql_fetch_array($sql_p)?>


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
            Tambah Nilai Praktikum Mahasiswa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard active"></i>Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="box box-primary">
                <!-- form start -->
				<?php if (isset($_GET['p'])){
					$query = mysql_query("SELECT MAX(id_nilai) AS id_nilai FROM nilai");
					$idn = mysql_fetch_array($query);
					$idmax = $idn['id_nilai'];
						if ($idmax==null)
							{$idmax=1;}
						else 
							{$idmax++;}
						}
				?>
                <form role="form" action="create_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
						<label for="nim">ID Nilai</label>
						<input type="text" class="form-control" name="idn" value="<?php echo $idmax; ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="prak">Praktikum</label>
						<input type="text" class="form-control" name="prak" value="<?php echo $d['nama_mk']; ?>" readonly>
						<input type="text" class="form-control hidden" name="idjp" value="<?php echo $idjp; ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="modul">Modul</label>
						<input type="text" class="form-control" name="modul" value="<?php echo $idm; ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="praktikan">Praktikan</label>
						<select id="praktikan" name="praktikan" class="form-control" required>
						<option selected disabled>--Praktikan--</option>
							<?php
								$sql = mysql_query("select * from praktikan join mahasiswa on mahasiswa.nim=praktikan.nim where id_jad_prak=$idjp and status_pr=1 order by praktikan.nim");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_praktikan]\">$dt[nim] - $dt[nama]</option>";}
							?>
						</select>
                    </div>
					<div class="form-group">
						<label for="awal">Nilai Laporan Awal</label>
						<input type="text" class="form-control" name="awal" required>
                    </div>
					<div class="form-group">
						<label for="praktik">Nilai Praktikum</label>
						<input type="text" class="form-control" name="praktik" required>
                    </div>
					<div class="form-group">
						<label for="akhir">Nilai Laporan Akhir</label>
						<input type="text" class="form-control" name="akhir" required>
                    </div>                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
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