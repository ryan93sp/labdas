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
if (isset($_GET['q'])){
$cari=$_GET['q']; }
else {header("location:../");}
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
            Pencarian
            <small>Hasil Pencarian</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="#">Pencarian</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header clearfix">
                  <h3 class="box-title">Hasil Pencarian "<?php echo $cari?>"</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NIM</th>
						<th>Nama Mahasiswa</th>
						<th>Fakultas</th>
						<th>Jurusan</th>
						<th>Praktikum</th>
						<th>Jadwal</th>
						<th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$sql = mysql_query("SELECT * FROM praktikan
									join mahasiswa on mahasiswa.nim=praktikan.nim
									join jurusan on jurusan.id_jurusan = mahasiswa.id_jurusan
									join fakultas on fakultas.id_fakultas=jurusan.id_fakultas
									join jadwal_praktikum on jadwal_praktikum.id_jad_prak=praktikan.id_jad_prak
									join praktikum ON praktikum.id_prak = jadwal_praktikum.id_prak
									join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk
									join jadwal ON jadwal.id_jadwal = jadwal_praktikum.id_jadwal
									join hari ON hari.id_hari = jadwal.id_hari
									join shift ON shift.id_shift = jadwal.id_shift
									where praktikan.nim like '%$cari%' or nama like '%$cari%' and status=1");
					while($data =  mysql_fetch_array($sql)){
					$nim = $data['nim'];
					$nama = $data['nama'];
					$mk = $data['nama_mk'];
					$shift = $data['ket_shift'];
					$hari = $data['nama_hari'];
					$jurusan = $data['nama_jurusan'];
					$fakultas = $data['nama_fakultas'];
					$idjp = $data['id_jad_prak'];
					$idpr = $data['id_prak'];
					$stat = $data['status_pr'];
					?>	
					
                      <tr>
                        <td><?php echo "$nim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						<td><?php echo "$fakultas"; ?></td>
						<td><?php echo "$jurusan"; ?></td>
						<td><?php echo "<a href='../jadwal-praktikum/?p=$idpr'>$mk</a>"; ?></td>
						<td><?php echo "<a href='../praktikan/?jp=$idjp'>$hari - $shift</a>"; ?></td>
						<td><?php
								if ($stat==0) {echo '<span class="label label-warning">Pending</span>';}
								elseif ($stat==1) {echo '<span class="label label-success">Approve</span>';}
								else {echo '<span class="label label-danger">Denied</span>';}
							?></td>
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
  </body>
</html>