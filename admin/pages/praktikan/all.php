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
            Praktikan
            <small>Tabel Praktikan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active"><a href="#">Praktikan</a></li>
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
					
                  <h3 class="box-title">Daftar Praktikan</h3>
				  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
						<th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
						<th>Praktikum</th>
						<th>Jadwal</th>
						<th>Status</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					
					
					<?php 					
					
					$sql = mysql_query("SELECT * FROM praktikan 
					JOIN mahasiswa ON mahasiswa.nim = praktikan.nim 
					JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan 
					JOIN jadwal_praktikum ON praktikan.id_jad_prak = jadwal_praktikum.id_jad_prak
					JOIN jadwal on jadwal.id_jadwal = jadwal_praktikum.id_jadwal
					JOIN shift on shift.id_shift = jadwal.id_shift
					JOIN hari on hari.id_hari = jadwal.id_hari
					JOIN praktikum on praktikum.id_prak = jadwal_praktikum.id_prak
					JOIN mata_kuliah on mata_kuliah.id_mk = praktikum.id_mk
					WHERE status=1");
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
                        <td><?php echo "$jur"; ?></td>
						<td><?php echo "<b><a href='../jadwal-praktikum/?p=$idp'>$mk</a></b>"; ?></td>
						<td><?php echo "<b><a href='../praktikan/?jp=$idjp'>$hari - $shift</a></b>"; ?></a></td>
						<td><?php
								if ($stat==0) {echo '<span class="label label-warning">Pending</span>';}
								elseif ($stat==1) {echo '<span class="label label-success">Approve</span>';}
								else {echo '<span class="label label-danger">Denied</span>';}
							?></td>
						<td class="btn-group">
						<a <?php if($data['krs']!=null){ echo "target='_blank'"; }?> href="<?php if($data['krs']==null){echo "#";} else { echo "../../../registrasi/".$data['krs']; }?>" class="btn btn-sm btn-default" title='Lihat KRS'><i class="fa fa-eye"></i></a>
						<a href="forme.php?id=<?php echo $data['id_praktikan']; ?>" class="btn btn-sm btn-default" title='Ubah'><i class="fa fa-edit"></i></a>
						<a href="delete_a.php?id=<?php echo $data['id_praktikan']; ?>" class="btn btn-sm btn-default" title='Hapus' onclick="return confirm('Anda yakin menghapus praktikan<?php echo " $nama" ?>?')" ><i class="fa fa-remove"></i></a></td>
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