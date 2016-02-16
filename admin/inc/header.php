<?php
	$user=$_SESSION['username'];
	$akses=$_SESSION['akses'];
	if ($akses==1){$tipe='Dosen Analis';}
	elseif ($akses==2){$tipe='Asisten';}
	elseif ($akses==3){$tipe='Dosen';}
?>
<!-- Logo -->
<a href="../../" class="logo" style="font-size:14px"><b>Laboratorium Dasar Fisika</b></a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
	<ul class="nav navbar-nav">
		<?php if($_SESSION['akses']==1){?>
		<li class="dropdown notifications-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <i class="fa fa-bell-o"></i>
			  <span class="label label-warning" id="banyakpending"></span>
			</a>
			<ul class="dropdown-menu">
			  <li class="header">Praktikan yang pending</li>
			  <li>
				<!-- inner menu: contains the actual data -->
				<ul class="menu" id="yangpending">
				  <!-- <li>
					<a href="#">
					  <i class="fa fa-users text-yellow"></i> 5 Pendaftar dalam status pending
					</a>
				  </li> -->
				</ul>
			  </li>
			  <li class="footer"><a href="../../pages/praktikan/pending.php">View all</a></li>
			</ul>
		</li>
		<?php } ?>
	  <!-- User Account Menu -->
	  <li class="dropdown user user-menu">
		<!-- Menu Toggle Button -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <!-- The user image in the navbar-->
		  <img src="../../dist/img/avatar5.png" class="user-image" alt="User Image"/>
		  <!-- hidden-xs hides the username on small devices so only the image appears. -->
		  <span class="hidden-xs"><?php echo $user; ?></span>
		</a>
		<ul class="dropdown-menu">
		  <!-- The user image in the menu -->
		  <li class="user-header">
			<img src="../../dist/img/avatar5.png" class="img-circle" alt="User Image" />
			<p><?php echo $user.' - '.$tipe ?></p>
		  </li>
		  <!-- Menu Footer-->
		  <li class="user-footer">
			<div class="pull-left">
			  <a href="../../pages/profil" class="btn btn-default btn-flat">Profil</a>
			</div>
			<div class="pull-right">
			  <a href="../../logout.php" class="btn btn-default btn-flat">Keluar</a>
			</div>
		  </li>
		</ul>
	  </li>
	</ul>
  </div>
</nav>
