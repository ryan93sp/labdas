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
if (isset($_GET['c'])){
$idm=$_GET['c']; }
else {header("location:praktikum.php");}?>


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
    <link href="../../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />


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
            Praktikum Modul 1
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header clearfix">
					<a href="form.php" class="btn btn-default pull-right">Tambah Praktikum <i class="fa fa-plus"></i></a>
					
                  <h3 class="box-title">Tabel Daftar Nilai Praktikum</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Judul Modul</th>
						<th>NIM</th>
                        <th>Nama Praktikan</th>
						<th>Laporan Awal</th>
						<th>Praktikum</th>
						<th>Laporan Akhir</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$sql = mysql_query("SELECT * FROM nilai 
					JOIN modul ON modul.id_modul = nilai.id_modul 
					JOIN praktikan ON praktikan.id_praktikan = nilai.id_praktikan
					JOIN mahasiswa ON mahasiswa.nim = praktikan.nim
					where id_jad_prak = '1' and modul.id_modul = 'm1'
					ORDER BY mahasiswa.nim");
					while($data =  mysql_fetch_array($sql)){
					$idn = $data['id_nilai'];
					$idm = $data['judul_modul'];
					$idmo = $data['id_modul'];
					$idnim = $data['nim'];
					$nama = $data['nama'];
					$awal = $data['nilai_lap_awal'];
					$prak = $data['nilai_prak'];
					$akhir = $data['nilai_laporan'];
					?>	
					
                      <tr>
						<td><?php echo "$idm"; ?></td>
                        <td><?php echo "$idnim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						<td><?php echo "$awal"; ?></td>
                        <td><?php echo "$prak"; ?></td>
						<td><?php echo "$akhir"; ?></td>
						<td><a href="form.php?id=<?PHP echo $idjp; ?>" class="btn btn-mini btn-default" title='Ubah data jadwal'><i class="fa fa-edit"></i></a></td>
                      </tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="#">Laboratorium Dasar Fisika.</a></strong>
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script src="../../dist/js/app.min.js" type="text/javascript"></script>
	<script src="../../dist/js/notif.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

  </body>
</html>