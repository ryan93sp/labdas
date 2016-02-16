<!-- Sidebar user panel (optional) -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="../../dist/img/avatar5.png" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
    <p><?php echo $_SESSION['username']; ?></p>
    <!-- Status -->
		<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
<!-- search form (Optional) -->
<form action="../cari" method="get" class="sidebar-form">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Cari Praktikan..." required>
		<span class="input-group-btn">
			<button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form><!-- /.search form -->
<!-- Sidebar Menu -->
<ul class="sidebar-menu">
	<li class="header">MENU</li>
	<li class="active"><a href="../../"><span>Home</span></a></li>
	<!--<li class="treeview">
		<a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
			<li><a href="#">Link in level 2</a></li>
			<li><a href="#">Link in level 2</a></li>
		</ul>
    </li>-->
	<?php if($_SESSION['akses']==1 || $_SESSION['akses']==2){?>
	<li><a href="../../pages/praktikum"><span>Praktikum</span></a></li>
	<li><a href="../../pages/praktikan"><span>Praktikan</span></a></li>
	<li><a href="../../pages/pengawas"><span>Pengawas</span></a></li>
	<li><a href="../../pages/modul"><span>Modul</span></a></li>
	<?php } ?>
	<?php if($_SESSION['akses']==2){?><li><a href="../../pages/asisten"><span>Data Asisten</span></a></li><?php }?>
	<li><a href="../../pages/nilai"><span>Nilai Praktikum</span></a></li>
	<?php if($_SESSION['akses']==1){?>
	<li><a href="../../pages/akses"><span>Akses</span></a></li>
	<li class="treeview">
		<a href="#"><span>Data</span> <i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
			<li><a href="../../pages/asisten"><span>Data Asisten</span></a></li>
			<li><a href="../../pages/mahasiswa"><span>Data Mahasiswa</span></a></li>
		</ul>
    </li>
	<?php } ?>
	<li class="treeview">
		<a href="#"><span>Laporan Nilai</span> <i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
			<li><a href="../../pages/laporan/nilai_modul.php">Laporan per Modul</a></li>
			<li><a href="../../pages/laporan/nilai_akhir.php">Laporan Akhir</a></li>
		</ul>
    </li>
	
</ul><!-- /.sidebar-menu -->