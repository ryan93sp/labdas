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
            Modul
            <small>Tabel Modul Praktikum</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active"><a href="#">Modul</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<?php if (!isset($_GET['p'])){ ?>
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
						<a href="form.php" class="btn btn-default">Tambah Modul <i class="fa fa-plus"></i></a>
						<a href="formu.php" class="btn btn-default">Upload Modul <i class="fa fa-upload"></i></a>
					</div>
					<h3 class="box-title">Daftar Modul</h3>
                </div><!-- /.box-header -->
				<div class="box-body">
                  <table id="example2" class="table table-hover table-bordered table-striped">
				  
                    <thead>
                      <tr>
						<th>Kode Modul</th>
						<th>Praktikum</th>
                        <th>Ket</th>
						<th>Judul Modul</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$sql = mysql_query("SELECT * FROM modul join mata_kuliah on mata_kuliah.id_mk=modul.id_mk ORDER BY modul.id_mk");
					while($data =  mysql_fetch_array($sql)){
					$idm = $data['id_modul'];
					$judul = $data['judul_modul'];
					$mk = $data['nama_mk'];
					$nomodul = $data['no_modul'];
					$file = $data['file'];
					?>
                      <tr>
						<td><?php echo "$idm"; ?></td>
						<td><?php echo "$mk"; ?></td>
						<td><?php echo "Modul $nomodul"; ?></td>
                        <td><?php echo "$judul"; ?></td>
						<td><div class="btn-group">
							<a href="form.php?id=<?php echo $idm ?>" class="btn btn-sm btn-default" title='Edit Modul'><i class="fa fa-edit"></i></a>
							<a download href="<?php if($file==null){echo "#";} else {echo '../../../'.$file;} ?>" class="btn btn-sm btn-default" title='Download Modul'><i class="fa fa-download"></i></a>
							<a href="formu.php?id=<?php echo $idm ?>" class="btn btn-sm btn-default" title='Upload Modul'><i class="fa fa-upload"></i></a>
							<a href="delete.php?id=<?php echo $idm ?>" class="btn btn-sm btn-default" title='Hapus Modul' onclick="return confirm('Anda yakin menghapus modul?')"><i class="fa fa-remove"></i></a></div>
						</td>
                      </tr>
					<?php } ?>
                    </tbody>
					
                  </table>
				</div><!-- /.box-body -->				
              </div><!-- /.box -->
			  <?php ;} ?>
			  
			  
				<?php if (isset($_GET['p'])){
						$idjp=$_GET['p'];
						$sql_p = mysql_query("select * from jadwal_praktikum 
					join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak
					JOIN mata_kuliah ON praktikum.id_mk = mata_kuliah.id_mk
					join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal 
					join shift on shift.id_shift=jadwal.id_shift 
					join hari on hari.id_hari=jadwal.id_hari 
					where id_jad_prak='$idjp'");
					$d =  mysql_fetch_array($sql_p)
				?>
			  <div class="box">
                <div class="box-header">				  
				  <?php
					$sql_p = mysql_query("select * from jadwal_praktikum 
					join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak
					JOIN mata_kuliah ON praktikum.id_mk = mata_kuliah.id_mk
					join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal 
					join shift on shift.id_shift=jadwal.id_shift 
					join hari on hari.id_hari=jadwal.id_hari 
					where id_jad_prak='$idjp'");
					$d =  mysql_fetch_array($sql_p)?>
					
				  <table>
					<tr><td>Nama Praktikum</td><td>: <?php echo $d['nama_mk'] ?></td></tr>
					<tr><td>Jadwal</td><td>: <?php echo $d['nama_hari'].' / shift : '.$d['ket_shift'] ?></td></tr>
					<tr><td>Semester</td><td>: <?php if ($d['semester']==1) {echo "Ganjil";} else {echo "Genap";} ?></td></tr>
					<tr><td>Tahun Ajaran</td><td>: <?php echo $d['tahun_ajaran'] ?></td></tr>
				  </table>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
						<th>ID Modul</th>
						<th>Nama Modul</th>
                      </tr>
                    </thead>
                    <tbody>
					
					
					<?php
					$sql = mysql_query("SELECT * FROM modul 
					JOIN mata_kuliah ON modul.id_mk = mata_kuliah.id_mk where modul.id_mk='$d[id_mk]'
					ORDER by id_modul");
					while($data =  mysql_fetch_array($sql)){
					$idm = $data['id_modul'];
					$idmatkul = $data['id_mk'];
					$judul = $data['judul_modul'];
					?>	
                      <tr>
						<td><?php echo "$idm"; ?></td>
                        <td><?php echo "<b><a href='../nilai/?m=$idm&p=$idjp'>$judul</a></b>"; ?></td>						
                      </tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
				<?php ;} ?>
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
          "bAutoWidth": false
        });
      });
    </script>

  </body>
</html>