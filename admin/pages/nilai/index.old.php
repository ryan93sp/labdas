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
if (isset($_GET['m'])){
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
						<a href="form.php?p=<?php echo $idjp ?>&m=<?php echo $idm ?>" class="btn btn-default">Tambah Nilai <i class="fa fa-plus"></i></a>
						<a target="_blank" href="cetaknilai.php?m=<?php echo $idm ?>&p=<?php echo $idjp ?>" class="btn btn-default">Cetak <i class="fa fa-print"></i></a>
					</div>
					<h3 class="box-title">Praktikum Modul</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th>Nama Modul</th>
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
					JOIN jadwal_praktikum ON praktikan.id_jad_prak = jadwal_praktikum.id_jad_prak
					where jadwal_praktikum.id_jad_prak = '$idjp' and modul.id_modul = '$idm'
					ORDER BY mahasiswa.nim");
					while($data =  mysql_fetch_array($sql)){
					$idjp = $data['id_jad_prak'];
					$idn = $data['id_nilai'];
					$idm = $data['judul_modul'];
					$idp = $data['id_praktikan'];
					$idmo = $data['id_modul'];
					$nim = $data['nim'];
					$nama = $data['nama'];
					$awal = $data['nilai_lap_awal'];
					$praktik = $data['nilai_prak'];
					$akhir = $data['nilai_laporan'];
					?>	
                      <tr>
						<td><?php echo "$idm"; ?></td>
                        <td><?php echo "$nim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						<td><?php echo "$awal"; ?></td>
                        <td><?php echo "$praktik"; ?></td>
						<td><?php echo "$akhir"; ?></td>
						<td><div class="btn-group"><a href="forme.php?id=<?php echo $data['id_nilai']; ?>" class="btn btn-sm btn-default" title='Ubah Nilai'><i class="fa fa-edit"></i></a><a href="delete.php?id=<?php echo $data['id_nilai']; ?>" class="btn btn-sm btn-default" title='Hapus' onclick="return confirm('Anda yakin menghapus nilai praktikan<?php echo " $nama" ?>?')" ><i class="fa fa-remove"></i></a></div></td>
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