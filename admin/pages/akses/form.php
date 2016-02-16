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
if($_SESSION['akses']==2 || $_SESSION['akses']==3){
	header("location:../../");
	exit();
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
	<script>
		function jurusan(fak){
		$.ajax({
		url: "getjur.php?p="+fak,
		success: function(msg){
		$('#jur').html(msg);
		},
		dataType: "html"
		});
	}
	</script>
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
            Page Header
            <small>Optional description</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="../mahasiswa">Mahasiswa</a></li>
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
				<?php if (isset($_GET['user'])){
					$user=$_GET['user'];
					$sql = mysql_query("select * from userlogin where username='$user'");
					$data = mysql_fetch_array($sql);
					$akses = $data['akses'];	
				?>
                <form role="form" action="update_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
						<label for="user">Username</label>
						<input type="text" class="form-control" name="user" value="<?php echo $user; ?>" readonly>
                    </div>
					<div class="form-group">
						<label for="pass">Password Baru</label>
						<input type="password" class="form-control" name="password" value="" placeholder="●●●●●">
                    </div>
					<label for="akses">Hak Akses</label>
						<select id="akses" name="akses" class="form-control" required>
							<?php 
							if ($akses==1){
							?>
							<option value=1 selected>Analis</option>
							<option value=2>Asisten</option>
							<option value=3>Dosen</option>
							<?php }
							if ($akses==2){
							?>
							<option value=1>Analis</option>
							<option value=2 selected>Asisten</option>
							<option value=3>Dosen</option>
							<?php }
							if ($akses==3){
							?>
							<option value=1>Analis</option>
							<option value=2>Asisten</option>
							<option value=3 selected>Dosen</option>
							<?php } ?>
						</select>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Ganti</button>
                  </div>
                </form>
				<?php } ?>
				<?php if (!isset($_GET['user'])){ ?>
                <form role="form" action="create_process.php" method="post">
                  <div class="box-body">
					<div class="form-group">
						<label for="user">Username</label>
						<input type="text" class="form-control" name="user" value="">
                    </div>
					<div class="form-group">
						<label for="pass">Password</label>
						<input type="password" class="form-control" name="password" value="">
                    </div>
					<div class="form-group">
						<label for="akses">Hak Akses</label>
						<select id="akses" name="akses" class="form-control" required>
							<option selected disabled>--Hak Akses--</option>
							<option value=1>Analis</option>
							<option value=2>Asisten</option>
							<option value=3>Dosen</option>
						</select>
					</div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </form>
				<?php } ?>
            </div><!-- /.box-body -->
		
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