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
if (isset($_GET['p'])){
$idp = $_GET['p'];
$jur = $_GET['jurusan'];
}
else {header("location:pilih_praktikum.php");}?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laboratorium Dasar Fisika</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
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
            Daftar Nilai
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li><a href="#">Nilai</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header clearfix">
					<div class="btn-group pull-right">
						<a target="_blank" href="cetak_a.php?p=<?php echo $idp ?>&jurusan=<?php echo $jur ?>" class="btn btn-default">Cetak <i class="fa fa-print"></i></a>
					</div>
					<h3 class="box-title">Nilai Akhir Praktikum</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th>NIM</th>
                        <th>Nama Praktikan</th>
						<th>Jurusan</th>
						<th>Nilai Akhir Praktikum</th>
						<th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$sql = mysql_query("select * from praktikan left join (select sum(nilai_lap_awal) as total_lap_awal ,sum(nilai_prak) as total_nilai_prak, sum(nilai_laporan) as total_nilai_laporan,id_praktikan from nilai group by id_praktikan) nilainya on praktikan.id_praktikan=nilainya.id_praktikan join mahasiswa on mahasiswa.nim=praktikan.nim join jurusan on jurusan.id_jurusan=mahasiswa.id_jurusan where id_prak=$idp and mahasiswa.id_jurusan='$jur' ORDER BY praktikan.id_praktikan ASC");
					
					$sql_m = mysql_query("SELECT count(*) as banyak_modul from modul join mata_kuliah on mata_kuliah.id_mk=modul.id_mk join praktikum on praktikum.id_mk=mata_kuliah.id_mk where id_prak='$idp' and status='1'");
					$dtm =  mysql_fetch_array($sql_m);
					$bmod = $dtm['banyak_modul'];
					while($data =  mysql_fetch_array($sql)){
					$nim = $data['nim'];
					$nama = $data['nama'];
					$jur = $data['nama_jurusan'];
					$awal = $data['total_lap_awal'];
					$praktik = $data['total_nilai_prak'];
					$laporan = $data['total_nilai_laporan'];
					$na = ($awal+$praktik+$laporan)/3/$bmod;
					
					?>	
                      <tr>
                        <td><?php echo "$nim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						<td><?php echo "$jur"; ?></td>
						<td><?php echo round ($na,2);; ?></td>
						<td><?php if ($na>=50) {echo "LULUS";} else {echo "TIDAK LULUS";} ?></td>
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