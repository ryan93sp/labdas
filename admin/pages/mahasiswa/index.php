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
            Mahasiswa
            <small>Tabel Mahasiswa</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="#">Mahasiswa</a></li>
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
                  <h3 class="box-title">Arsip Mahasiswa</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NIM</th>
						<th>Nama Mahasiswa</th>
						<th>Jurusan</th>
						<th>Fakultas</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$sql = mysql_query("SELECT * FROM mahasiswa join jurusan on jurusan.id_jurusan = mahasiswa.id_jurusan join fakultas on fakultas.id_fakultas=jurusan.id_fakultas ORDER BY nim and mahasiswa.id_jurusan");
					while($data =  mysql_fetch_array($sql)){
					$nim = $data['nim'];
					$nama = $data['nama'];
					$jurusan = $data['nama_jurusan'];
					$fakultas = $data['nama_fakultas'];
					?>	
					
                      <tr>
                        <td><?php echo "$nim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						<td><?php echo "$jurusan"; ?></td>
						<td><?php echo "$fakultas"; ?></td>
						<td><div class="btn-group">
							<a href="form.php?nim=<?php echo $nim; ?>" class="btn btn-sm btn-default" title='Ubah data'><i class="fa fa-edit"></i></a>
							<!-- <a href="delete.php?nim=<?php echo $nim; ?>" class="btn btn-sm btn-default" title='Hapus' onclick="return confirm('Anda yakin menghapus asisten<?php echo " $nama" ?>?')" ><i class="fa fa-remove"></i></a> --></div>
						</td>
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