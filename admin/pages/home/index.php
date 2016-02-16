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
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laboratorium Dasar Fisika</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../../plugins/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
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
            WELCOME
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard active"></i>Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<center>
                <h1>Selamat Datang di Halaman Admin<br>Laboratorium Dasar Fisika</h1>
            </center>
			<?php if($_SESSION['akses']==1){?>
			<div class="row">
				
				<div class="col-lg-3 col-xs-3">
					<div class="row">
					<div class="col-lg-12 col-xs-3">
				  <!-- small box -->
				  <div class="small-box bg-yellow">
					<div class="inner">
					<?php $pending = mysql_query("SELECT count(*) from praktikan where status_pr='0'");
						echo "<h3>".mysql_result($pending, 0)."</h3>";
					?>
					  <p>Praktikan pending</p>
					</div>
					<div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
					<a href="../praktikan/pending.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				  </div>
				  <div class="col-lg-12 col-xs-3">
				  <!-- small box -->
				  <div class="small-box bg-green">
					<div class="inner">
					<?php $aktif = mysql_query("SELECT count(*) from praktikum where status='1'");
						echo "<h3>".mysql_result($aktif, 0)."</h3>";
					?>
					  <p>Praktikum Aktif</p>
					</div>
					<div class="icon">
					  <i class="ion ion-ios-flask"></i>
					</div>
					<a href="../praktikum/aktif.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				  </div>
				  </div>
				</div>
			
				
				<div class="col-md-9">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Data pendaftar terakhir</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Nim</th>
                          <th>Nama</th>
                          <th>Status</th>
						  <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $sql = mysql_query("SELECT * FROM praktikan 
						JOIN mahasiswa ON mahasiswa.nim = praktikan.nim 
						JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan 
						JOIN jadwal_praktikum ON praktikan.id_jad_prak = jadwal_praktikum.id_jad_prak
						JOIN jadwal on jadwal.id_jadwal = jadwal_praktikum.id_jadwal
						JOIN shift on shift.id_shift = jadwal.id_shift
						JOIN hari on hari.id_hari = jadwal.id_hari
						JOIN praktikum on praktikum.id_prak = jadwal_praktikum.id_prak
						JOIN mata_kuliah on mata_kuliah.id_mk = praktikum.id_mk
						WHERE status=1 order by id_praktikan desc limit 10");
						while($data =  mysql_fetch_array($sql)){
						$idjp = $data['id_jad_prak'];
						$idp = $data['id_prak'];
						$nim = $data['nim'];
						$nama = $data['nama'];
						$jur = $data['nama_jurusan'];
						$mk = $data['nama_mk'];
						$shift = $data['ket_shift'];
						$hari = $data['nama_hari'];
						$stat = $data['status_pr'];
					  ?>
                        <tr>
                          <td><?php echo "$nim"; ?></td>
                          <td><?php echo "$nama"; ?></td>
                          <td><?php
							if ($stat==0) {echo '<span class="label label-warning">Pending</span>';}
							elseif ($stat==1) {echo '<span class="label label-success">Approve</span>';}
							else {echo '<span class="label label-danger">Denied</span>';}
							?></td>
						  <td><a href="forme.php?id=<?php echo $data['id_praktikan']; ?>" class="btn btn-sm btn-default" title='Ubah'><i class="fa fa-edit"></i></a></td>
                        </tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="../praktikan/form.php" class="btn btn-sm btn-info btn-flat pull-left">Daftarkan praktikan</a>
                  <a href="../praktikan/all.php" class="btn btn-sm btn-default btn-flat pull-right">Tampilkan semua praktikan</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div>
			</div>
			<?php } ?>
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