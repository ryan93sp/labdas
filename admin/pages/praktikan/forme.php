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
	if (isset($_GET['id'])){
		$idpt=$_GET['id'];
		$sql = mysql_query("SELECT * FROM praktikan join mahasiswa on mahasiswa.nim=praktikan.nim join jadwal_praktikum on jadwal_praktikum.id_jad_prak=praktikan.id_jad_prak join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal join shift on shift.id_shift=jadwal.id_shift join hari on hari.id_hari=jadwal.id_hari where id_praktikan=$idpt");
		$data =  mysql_fetch_array($sql);
		$idjp = $data['id_jad_prak'];
		$idpr = $data['id_prak'];
		$nim = $data['nim'];
		$nama = $data['nama'];
		$prak = $data['nama_mk'];
		$stat = $data['status_pr'];
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
            Form Praktikan
            <small>Ubah Status</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li><a href="../praktikan/?jp=<?php echo $idjp ?>">Praktikan</a></li>
			<li class="active"><a href="#">Form</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="box box-primary">
                <div class="box-header">
                  <!-- <h3 class="box-title">Tambah Praktikum</h3> -->
                </div><!-- /.box-header -->
                <!-- form start -->
				<form role="form" action="update_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
                      <input type="text" class="form-control" name="idjp" value="<?php echo $idpt ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="nim">NIM</label>
						<input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="prak">Praktikum</label>
						<input type="text" class="form-control" name="prak" value="<?php echo $prak ?>" readonly>
					</div>
					<div class="form-group">
						<label for="jadwal">Jadwal</label>
						<select id="jadwal" name="jadwal" class="form-control" required>
							<?php
								$sql = mysql_query("SELECT * FROM jadwal_praktikum JOIN praktikum ON praktikum.id_prak = jadwal_praktikum.id_prak JOIN jadwal ON jadwal.id_jadwal = jadwal_praktikum.id_jadwal JOIN hari ON hari.id_hari = jadwal.id_hari JOIN shift ON shift.id_shift = jadwal.id_shift where jadwal_praktikum.id_prak=$idpr order by jadwal.id_hari, jadwal.id_shift");
								while($dt = mysql_fetch_array($sql)){
								if ($data['id_jadwal']==$dt['id_jadwal']){
									echo "<option value=\"$dt[id_jad_prak]\" selected>$dt[nama_hari] / $dt[ket_shift]</option>";}
								else {
									echo "<option value=\"$dt[id_jad_prak]\">$dt[nama_hari] / $dt[ket_shift]</option>";}}
								
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="stat">Status</label>
						<select id="stat" name="stat" class="form-control">
							<?php if ($stat==1) { ?>
							<option value="1" selected>Approved</option>
							<option value="0">Pending</option>
							<option value="-1">Denied</option>
							<?php ;} if ($stat==0) { ?>
							<option value="1">Approved</option>
							<option value="0" selected>Pending</option>
							<option value="-1">Denied</option>
							<?php ;}  if ($stat==-1) { ?>
							<option value="1">Approved</option>
							<option value="0">Pending</option>
							<option value="-1" selected>Denied</option>
							<?php ;} ?>
						</select>
					</div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
				<?php } ?>
            </div>
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