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
if (isset($_GET['jp'])){
$idjp=$_GET['jp']; }
else {header("location:./pilih.php");} ?>

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
            Pengawas
            <small>Tabel Pengawas</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active"><a href="#">Pengawas</a></li>
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
					<?php if($_SESSION['akses']==1){?><a href="form.php?jp=<?php echo $idjp; ?>" class="btn btn-default">Tambah Pengawas <i class="fa fa-plus"></i></a><?php }?>
					<a href="../praktikan/?jp=<?php echo $idjp; ?>" class="btn btn-default">Praktikan <i class="fa fa-eye"></i></a>
					</div>
					<h3 class="box-title">Daftar Pengawas</h3>
				  
				  <?php
					$sql_p = mysql_query("select * from jadwal_praktikum join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal join shift on shift.id_shift=jadwal.id_shift join hari on hari.id_hari=jadwal.id_hari where id_jad_prak='$idjp'");
					$d =  mysql_fetch_array($sql_p)?>
					
				  <table>
					<tr><td>Nama Praktikum</td><td>: <?php echo $d['nama_mk'] ?></td></tr>
					<tr><td>Jadwal</td><td>: <?php echo $d['nama_hari'].' / shift : '.$d['ket_shift'] ?></td></tr>
					<tr><td>Semester</td><td>: <?php if ($d['semester']==1) {echo "Ganjil";} else {echo "Genap";} ?></td></tr>
					<tr><td>Tahun Ajaran</td><td>: <?php echo $d['tahun_ajaran'] ?></td></tr>
				  </table>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
						<th>ID Asisten</th>
                        <th>Nama Asisten</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					
					
					<?php
					$sql = mysql_query("SELECT * FROM pengawas JOIN asisten ON asisten.id_asisten = pengawas.id_asisten JOIN jadwal_praktikum ON pengawas.id_jad_prak = jadwal_praktikum.id_jad_prak WHERE pengawas.id_jad_prak = '$idjp'");
					while($data =  mysql_fetch_array($sql)){
					$idp = $data['id_pengawas'];
					$idas = $data['id_asisten'];
					$nama = $data['nama_asisten'];
					?>	
                      <tr>                      
                        <td><?php echo "$idas"; ?></td>
                        <td><?php echo "$nama"; ?></td>
						<td><?php if($_SESSION['akses']==1){?><a href="delete.php?id=<?php echo $idp ?>" class="btn btn-sm btn-danger" title='Hapus' onclick="return confirm('Anda yakin menghapus pengawas<?php echo " $nama" ?>?')" ><i class="fa fa-remove"></i></a><?php }?></td>
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