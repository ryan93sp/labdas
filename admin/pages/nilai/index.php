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
/* $ambil_nilai_c = $_GET['c'];
$hitung = strlen($ambil_nilai_c);
$idm = substr($ambil_nilai_c,1,$hitung); // --> modulnya
$shift = substr($ambil_nilai_c,0,1); // --> id shift dan hari */
$idm = $_GET['m'];
$idjp = $_GET['p'];
}
else {header("location:praktikum.php");}?>

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
				<?php
					if (isset($_GET['q'])){
					$pesan = $_GET['q'];
						if ($pesan == 0){
						$isi = $_GET['msg'];
						echo '<div class="alert alert-warning alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="icon fa fa-warning"></i> <b>Gagal</b> | '.$isi.'
							</div>';
						}
						if ($pesan == 1){
						echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="icon fa fa-check"></i> <b>Sukses</b>
							</div>';
						}
					}
				?>
					<div class="btn-group pull-right">
						<?php if($_SESSION['akses']==1 || $_SESSION['akses']==2){?><a href="form.php?p=<?php echo $idjp ?>&m=<?php echo $idm ?>" class="btn btn-default">Masukkan Nilai <i class="fa fa-plus"></i></a><?php } ?>
						<a target="_blank" href="cetak.php?m=<?php echo $idm ?>&p=<?php echo $idjp ?>" class="btn btn-default">Cetak <i class="fa fa-print"></i></a>
					</div>
					<?php
					$sqlmod = mysql_query("select * from modul join mata_kuliah on modul.id_mk=mata_kuliah.id_mk where id_modul='$idm'");
					$dtm =  mysql_fetch_array($sqlmod);
					?>
					<h3 class="box-title"><?php echo "Praktikum ".$dtm['nama_mk']." - Modul".$dtm['no_modul']." - ".$dtm['judul_modul']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
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
					$sql = mysql_query("SELECT * FROM praktikan LEFT JOIN nilai ON nilai.id_praktikan = praktikan.id_praktikan JOIN mahasiswa ON mahasiswa.nim = praktikan.nim JOIN jadwal_praktikum ON praktikan.id_jad_prak = jadwal_praktikum.id_jad_prak WHERE praktikan.id_jad_prak = '$idjp' and (id_modul='$idm' or id_modul is null) and status_pr=1 ORDER BY mahasiswa.nim");
					while($data =  mysql_fetch_array($sql)){
					$idjp = $data['id_jad_prak'];
					$idn = $data['id_nilai'];
					$idp = $data['id_praktikan'];
					$idmo = $data['id_modul'];
					$nim = $data['nim'];
					$nama = $data['nama'];
					$awal = $data['nilai_lap_awal'];
					$praktik = $data['nilai_prak'];
					$akhir = $data['nilai_laporan'];
					?>	
                      <tr>
                        <td><?php echo "$nim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						<td><?php echo "$awal"; ?></td>
                        <td><?php echo "$praktik"; ?></td>
						<td><?php echo "$akhir"; ?></td>
						<td><?php if($_SESSION['akses']==1 || $_SESSION['akses']==2){?><?php if ($idmo==null){echo "<span class='label label-danger'>Nilai belum di input</span>";} else { ?><div class="btn-group"><a href="forme.php?id=<?php echo $data['id_nilai']; ?>" class="btn btn-sm btn-default" title='Ubah Nilai'><i class="fa fa-edit"></i></a><a href="delete.php?id=<?php echo $data['id_nilai']; ?>" class="btn btn-sm btn-default" title='Hapus' onclick="return confirm('Anda yakin menghapus nilai praktikan<?php echo " $nama" ?>?')" ><i class="fa fa-remove"></i></a></div><?php ;} ?><?php } ?></td>
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
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
      });
    </script>

  </body>
</html>