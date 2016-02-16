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
include("../../inc/config.php"); ?>
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
            Form Praktikum
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
			<li><a href="../praktikum">Praktikum</a></li>
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
				<?php if (!isset($_GET['id'])){
					$query = mysql_query("SELECT MAX(id_prak) AS id_prak FROM praktikum");
					$jad = mysql_fetch_array($query);
					$idmax = $jad['id_prak'];
					if ($idmax==null) {$idmax=1;}
					else {$idmax++;}
				?>
                <form role="form" action="create_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
                      <input type="text" class="form-control" name="idjp" value="<?php echo $idmax; ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="prak">Mata Kuliah</label>
						<select id="prak" name="prak" class="form-control" required>
						<option selected disabled>--Mata Kuliah--</option>
							<?php
								$sql = mysql_query("select * from mata_kuliah");
								while($dt = mysql_fetch_array($sql)){
								echo "<option value=\"$dt[id_mk]\">$dt[nama_mk]</option>";}
							?>
						</select>
					</div>
                    <div class="form-group">
                      <label for="ta">Tahun Ajaran</label>
						<select id="" name="ta" class="form-control" required>
							<option selected disabled>--Tahun Ajaran--</option>
								<?php
									$sql = mysql_query("select * from tahun_ajaran");
									while($dt = mysql_fetch_array($sql)){
									echo "<option value=\"$dt[tahun_ajaran]\">$dt[tahun_ajaran]</option>";}
								?>
						</select>
                    </div>
                    <div class="form-group">
						<label for="sem">Semester</label>
						<select id="sem" name="sem" class="form-control">
							<option selected disabled>--semester--</option>
							<option value="1">Semester 1</option>
							<option value="2">Semester 2</option>
						</select>
					</div>
					<div class="form-group">
						<label for="stat">Status</label>
						<select id="stat" name="stat" class="form-control">
							<option selected disabled>--status--</option>
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </form>
				<?php ;} ?>
				<?php if (isset($_GET['id'])){
					$idpr=$_GET['id'];
					$sql = mysql_query("SELECT * FROM praktikum JOIN mata_kuliah ON mata_kuliah.id_mk = praktikum.id_mk where id_prak='$idpr'");
					$data =  mysql_fetch_array($sql);
					$idmk = $data['nama_mk'];
					$sem = $data['semester'];
					$ta = $data['tahun_ajaran'];
					$stat = $data['status'];?>
					<form role="form" action="update_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
                      <input type="text" class="form-control" name="idpr" value="<?php echo $idpr ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="prak">Praktikum</label>
						<select id="prak" name="prak" class="form-control" readonly>
						<?php
							$sql = mysql_query("select * from mata_kuliah");
							while($dt = mysql_fetch_array($sql)){
							if ($idpt==$dt['nama_mk']){
								echo "<option value=\"$dt[id_mk]\" selected>$dt[nama_mk]</option>";}
							else{
								echo "<option value=\"$dt[id_mk]\">$dt[nama_mk]</option>";}
							}
						?>
						</select>
					</div>
                    <div class="form-group">
                      <label for="ta">Tahun Ajaran</label>
						<select id="" name="ta" class="form-control" readonly>
							<?php
								$sql = mysql_query("select * from tahun_ajaran");
								while($dt = mysql_fetch_array($sql)){
								if ($ta==$dt[tahun_ajaran]) {
									echo "<option value=\"$dt[tahun_ajaran]\" selected>$dt[tahun_ajaran]</option>";}
								else {
									echo "<option value=\"$dt[tahun_ajaran]\">$dt[tahun_ajaran]</option>";
									}
								}
							?>
						</select>
                    </div>
                    <div class="form-group">
						<label for="sem">Semester</label>
						<select id="sem" name="sem" class="form-control" readonly>
							<?php if ($sem==1) { ?>
							<option value="1" selected>Semester 1</option>
							<option value="2">Semester 2</option>
							<?php ;} if ($sem==2) { ?>
							<option value="1">Semester 1</option>
							<option value="2" selected>Semester 2</option>
							<?php ;} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="stat">Status</label>
						<select id="stat" name="stat" class="form-control">
							<?php if ($stat==1) { ?>
							<option value="1" selected>Aktif</option>
							<option value="0">Tidak Aktif</option>
							<?php ;} if ($stat==0) { ?>
							<option value="1">Aktif</option>
							<option value="0" selected>Tidak Aktif</option>
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