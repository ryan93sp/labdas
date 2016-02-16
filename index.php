<?php include("admin/inc/config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laboratorium Dasar Fisika</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">Home</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
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
                        <a class="" href="admin">Admin</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!--<h1 class="brand-heading">Grayscale</h1>-->
						<h1 style="margin:15px">Selamat Datang di</h1>
						<h1 style="margin:15px">Laboratorium Dasar Fisika</h1>
						<h1>Universitas Andalas</h1>
                        <p class="intro-text">Silahkan klik tombol di bawah untuk mendaftar praktikum.</p>
                        <a href="#reg" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
	
	<!-- Reg Section -->
    <section id="reg" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
				<div class="" style="margin-bottom: 20px;">
					<a href="registrasi" type="button" class="btn btn-default"><b style="font-size:20px;">Form Pendaftaran</b></a>
				</div>
				<form class="form-horizontal"  method="post" action="status.php">
				  <div class="form-group">
					  <input type="text" class="form-control"  placeholder="NIM" name='nim' required>
				  </div>
				<div class="form-group">
					<select id="single_select1" class="form-control" name="praktikum" required>
						<option>--Pilih Praktikum--</option>
							<?php
							$sql = mysql_query("select * from praktikum join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk where status=1");
							while($dt = mysql_fetch_array($sql)){
							echo "<option value=\"$dt[id_prak]\">$dt[nama_mk]</option>";
							} ?>
					   </select>
				</div>
					
					
				  <div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
					  <button type="submit" class="btn btn-default" name="submit">Cek Status</button>
					</div>
				  </div>
				</form>
            
				</div>
        </div>
    </section>

    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Download Modul</h2>
                    <p>Anda dapat mendownload modul pada link yang telah disediakan dibawah.</p>
                    <a href="modul" class="btn btn-default btn-lg">Download Modul</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Laboratorium Dasar Fisika</h2>
                <p>Untuk informasi lebih lanjut anda dapat menghubungi email dibawah:</p>
                <p><a href="mailto:labdas-fisika@unand.ac.id">labdas-fisika@unand.ac.id</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://www.facebook.com/" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                    </li>
					<li>
                        <a href="https://twitter.com/" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; 2015 Laboratorium Dasar Fisika Universitas Andalas</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
