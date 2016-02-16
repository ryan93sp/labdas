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
include("../../inc/config.php"); ?>
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
            Update Nilai Praktikum Mahasiswa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard active"></i>Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="box box-primary">
                <div class="box-header">
                  <!-- <h3 class="box-title">Tambah Praktikum</h3> -->
                </div><!-- /.box-header -->
                <!-- form start -->
				<?php if (isset($_GET['id'])){
					$idn=$_GET['id'];
					$sql = mysql_query("SELECT * FROM nilai 
					join praktikan on nilai.id_praktikan = praktikan.id_praktikan
					join mahasiswa on praktikan.nim = mahasiswa.nim
					join jadwal_praktikum on jadwal_praktikum.id_jad_prak=praktikan.id_jad_prak 
					join praktikum on praktikum.id_prak = jadwal_praktikum.id_prak 
					join jadwal on jadwal_praktikum.id_jadwal = jadwal.id_jadwal 
					join shift on jadwal.id_shift = shift.id_shift 
					join hari on jadwal.id_hari = hari.id_hari 
					join mata_kuliah on praktikum.id_mk = mata_kuliah.id_mk
					where id_nilai = $idn");
					$data =  mysql_fetch_array($sql);
					$idn = $data['id_nilai'];
					$nim = $data['nim'];
					$nama = $data['nama'];
					$prak = $data['nama_mk'];
					$awal = $data['nilai_lap_awal'];
					$praktik = $data['nilai_prak'];
					$akhir = $data['nilai_laporan'];
					$idmodul = $data['id_modul'];
					$idjadwal = $data['id_jad_prak'];
					?>
					<form role="form" action="update_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
					<label for="idn">ID Nilai</label>
                      <input type="text" class="form-control" name="idn" value="<?php echo $idn ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="nim">NIM</label>
						<input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="prak">Praktikum</label>
						<input type="text" class="form-control" name="prak" value="<?php echo $prak ?>" readonly>
					</div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Nilai Laporan Awal</label>
                      <input type="text" class="form-control" name="awal" value="<?php echo $awal ?>">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Nilai Praktikum</label>
                      <input type="text" class="form-control" name="praktik" value="<?php echo $praktik ?>">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Nilai Laporan Akhir</label>
                      <input type="text" class="form-control" name="akhir" value="<?php echo $akhir ?>">
                    </div>
					<div class="form-group">
						
						<input type="text" class="form-control hidden" name="idmodul" value="<?php echo $idmodul ?>" readonly>
					</div>
					<div class="form-group">
						
						<input type="text" class="form-control hidden" name="idjadwal" value="<?php echo $idjadwal ?>" readonly>
					</div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
				<?php } ?>
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