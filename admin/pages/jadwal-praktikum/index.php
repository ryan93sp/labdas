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
$idpt=$_GET['p']; }
else { header("location:../praktikum"); }
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
            Jadwal Praktikum
            <small>Tabel Jadwal Praktikum</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li><a href="../praktikum">Praktikum</a></li>
			<li class="active"><a href="#">Jadwal Praktikum</a></li>
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
					<?php if($_SESSION['akses']==1){?><a href="form.php?p=<?php echo $idpt ?>" class="btn btn-default pull-right">Jadwal Baru <i class="fa fa-plus"></i></a><?php }?>
					<h3 class="box-title">Tabel Daftar Jadwal Praktikum</h3>
				  <?php
					$sql = mysql_query("SELECT * FROM praktikum JOIN mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk where id_prak=$idpt");
					$d =  mysql_fetch_array($sql)
				  ?>
					<table>
					<tr><td>Nama Praktikum</td><td>: <?php echo $d['nama_mk'] ?></td></tr>
					<tr><td>Semester</td><td>: <?php if ($d['semester']==1) {echo "Ganjil";} else {echo "Genap";} ?></td></tr>
					<tr><td>Tahun Ajaran</td><td>: <?php echo $d['tahun_ajaran'] ?></td></tr>
					<tr><td>Status</td><td>: <?php if ($d['status']==0) {echo '<span class="label label-danger">Tidak Aktif</span>';} else {echo '<span class="label label-success">Aktif</span>';} ?></td></tr>
				  </table>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Jadwal</th>
						<th>Jumlah Praktikan</th>
						<th>Kuota sisa</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$sql = mysql_query("SELECT * FROM jadwal_praktikum JOIN praktikum ON praktikum.id_prak = jadwal_praktikum.id_prak JOIN mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk JOIN jadwal ON jadwal.id_jadwal = jadwal_praktikum.id_jadwal JOIN hari ON hari.id_hari = jadwal.id_hari JOIN shift ON shift.id_shift = jadwal.id_shift where jadwal_praktikum.id_prak=$idpt ORDER BY id_jad_prak");
					while($data =  mysql_fetch_array($sql)){
					$idjp = $data['id_jad_prak'];
					$shift = $data['ket_shift'];
					$hari = $data['nama_hari'];
					$kuota = $data['kuota'];
					?>
					
                      <tr>
                        <td><?php echo "<b><a href='../praktikan/?jp=$idjp'>$hari - $shift</a></b>"; ?></td>
						<td>
							<?php
								$app = mysql_query("SELECT count(*) from praktikan where id_jad_prak='$idjp' and status_pr='1'");
								$pen = mysql_query("SELECT count(*) from praktikan where id_jad_prak='$idjp' and status_pr='0'");
								$den = mysql_query("SELECT count(*) from praktikan where id_jad_prak='$idjp' and status_pr='-1'");
									echo "<span class='label label-success'>Approve</span> = ".mysql_result($app, 0)." | <span class='label label-warning'>Pending</span> = ".mysql_result($pen, 0)." | <span class='label label-danger'>Denied</span> = ".mysql_result($den, 0);
							?>
						</td>
						<td><?php echo "$kuota"; ?></td>
						<td><div class="btn-group"><?php if($_SESSION['akses']==1){?><a href="formu.php?id=<?php echo $idjp; ?>&p=<?php echo $idpt ?>" class="btn btn-sm btn-default" title='Ubah Kuota'><i class="fa fa-edit"></i></a><a href="delete.php?id=<?php echo $idjp; ?>" class="btn btn-sm btn-default" title='Hapus jadwal' onclick="return confirm('Anda yakin menghapus jadwal?')"><i class="fa fa-remove"></i></a><?php }?></div></td>
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