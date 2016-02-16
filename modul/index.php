<?php include("../admin/inc/config.php"); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Administrator | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../admin/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="../admin/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue" style="background: #D2D6DE none repeat scroll 0% 0%;">
  
		<nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button> -->
                <a class="navbar-brand" href="../">
                    <i class="fa fa-play-circle"></i><span> Home</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <!-- <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#reg">Daftar</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#download">Download</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Kontak</a>
                    </li>
					<li>
                        <a class="page-scroll" href="#">Admin</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<div class="container">

        <!-- Main content -->
        <section class="content" style="padding:0">
			<div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Modul</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<div class="box-body">
                  <table id="" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
						<th>Praktikum</th>
                        <th>Judul Modul</th>
						<th>Ket</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					$sql = mysql_query("SELECT * FROM modul join mata_kuliah on mata_kuliah.id_mk=modul.id_mk ORDER BY modul.id_mk, no_modul");
					while($data =  mysql_fetch_array($sql)){
					$judul = $data['judul_modul'];
					$mk = $data['nama_mk'];
					$nomodul = $data['no_modul'];
					$file = $data['file'];
					?>
                      <tr>
						<td><?php echo "$mk"; ?></td>
                        <td><?php echo "$judul"; ?></td>
						<td><?php echo "Modul $nomodul"; ?></td>
						<td><a download href="<?php if($file==null){echo "#";} else {echo '../'.$file;} ?>" class="btn btn-sm btn-default" title='Download Modul'><i class="fa fa-download"></i></a></td>
                      </tr>
					<?php } ?>
                    </tbody>
                  </table>
				</div>
			</div>
        </section><!-- /.content -->
	</div>

    <script src="../admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../admin/dist/js/app.min.js" type="text/javascript"></script>

  </body>
</html>