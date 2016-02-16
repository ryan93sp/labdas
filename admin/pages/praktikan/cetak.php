<?php include("../../inc/config.php");
if (isset($_GET['jp'])){
$idjp=$_GET['jp']; }
else {header("location:./select.php");} ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laboratorium Dasar Fisika</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  </head>
  <body class="" onload="window.print()">
              <div class="container">
                <div class="">
                  <h3 class="">Daftar Praktikan</h3>
				  <?php
					$sql_p = mysql_query("select * from jadwal_praktikum join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal join shift on shift.id_shift=jadwal.id_shift join hari on hari.id_hari=jadwal.id_hari where id_jad_prak='$idjp'");
					$no = 1;
					$d =  mysql_fetch_array($sql_p)?>
					
				  <table>
					<tr><td>Praktikum</td><td>: <?php echo $d['nama_mk'] ?></td></tr>
					<tr><td>Jadwal</td><td>: <?php echo $d['nama_hari'].' / shift : '.$d['ket_shift'] ?></td></tr>
					<tr><td>Semester</td><td>: <?php if ($d['semester']==1) {echo "Ganjil";} else {echo "Genap";} ?></td></tr>
					<tr><td>Tahun Ajaran</td><td>: <?php echo $d['tahun_ajaran'] ?></td></tr>
				  </table>
                </div>
				
                <div class="">
                  <table id="" class="table table-bordered">
                    <thead>
                      <tr>
						<th>No</th>
						<th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$sql = mysql_query("SELECT * FROM praktikan JOIN mahasiswa ON mahasiswa.nim = praktikan.nim JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan JOIN jadwal_praktikum ON praktikan.id_jad_prak = jadwal_praktikum.id_jad_prak WHERE praktikan.id_jad_prak = '$idjp' and status_pr=1 order by praktikan.nim");
					while($data =  mysql_fetch_array($sql)){
					$nim = $data['nim'];
					$nama = $data['nama'];
					$jur = $data['nama_jurusan'];
					$stat = $data['status_pr'];
					?>	
                      <tr>
						<td><?php echo "$no"; ?></td>
                        <td><?php echo "$nim"; ?></td>
                        <td><?php echo "$nama"; ?></td>
                        <td><?php echo "$jur"; ?></td>
					  </tr>
					<?php $no++;} ?>
                    </tbody>
                  </table>
                </div>
              </div>
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>