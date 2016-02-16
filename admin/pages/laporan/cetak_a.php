<?php include("../../inc/config.php");
if (isset($_GET['p'])){
$idp=$_GET['p'];
$jur=$_GET['jurusan']; }
else {header("location:./");} ?>



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
				<?php
					$sql_p = mysql_query("select * from praktikum
					join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk 
					where id_prak='$idp'");					
					$dp =  mysql_fetch_array($sql_p);
					$sql_j = mysql_query("select * from jurusan join fakultas on jurusan.id_fakultas=fakultas.id_fakultas where id_jurusan='$jur'");
					$dj =  mysql_fetch_array($sql_j);
					?>
                  <center><h3 class="">Daftar Nilai Praktikum <?php echo $dp['nama_mk'] ?>
				  <center><h4 class="">Semester <?php if ($dp['semester']==1) {echo "Ganjil";} else {echo "Genap";} ?> Tahun <?php echo $dp['tahun_ajaran'] ?></h4></center>
				  <center><h4><?php echo $dj['nama_fakultas'] ?></h4></center>
				  <center><h4>Jurusan <?php echo $dj['nama_jurusan'] ?></h4></center>
                </div>
				
                <div class="">
                  <table id="" class="table table-bordered">
                    <thead>
                      <tr>
						<th><center>No</center></th>
						<th><center>Nim</center></th>
                        <th><center>Nama</center></th>
                        <th><center>Nilai Akhir</center></th>
						<th><center>Keterangan</center></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$sql = mysql_query("select * from praktikan left join (select sum(nilai_lap_awal) as total_lap_awal ,sum(nilai_prak) as total_nilai_prak, sum(nilai_laporan) as total_nilai_laporan,id_praktikan from nilai group by id_praktikan) nilainya on praktikan.id_praktikan=nilainya.id_praktikan join mahasiswa on mahasiswa.nim=praktikan.nim join jurusan on jurusan.id_jurusan=mahasiswa.id_jurusan where id_prak=$idp and mahasiswa.id_jurusan='$jur' ORDER BY praktikan.id_praktikan ASC");
					$sql_m = mysql_query("SELECT count(*) as banyak_modul from modul join mata_kuliah on mata_kuliah.id_mk=modul.id_mk join praktikum on praktikum.id_mk=mata_kuliah.id_mk where id_prak='$idp' and status='1'");
					$no = 1;
					$dtm =  mysql_fetch_array($sql_m);
					$bmod = $dtm['banyak_modul'];
					while($data =  mysql_fetch_array($sql)){
					$nim = $data['nim'];
					$nama = $data['nama'];
					$jur = $data['nama_jurusan'];
					$awal = $data['total_lap_awal'];
					$praktik = $data['total_nilai_prak'];
					$laporan = $data['total_nilai_laporan'];
					$na = ($awal+$praktik+$laporan)/3/$bmod;
					
					?>	
                      <tr>
						<td><?php echo "$no"; ?></td>
                        <td><?php echo "$nim"; ?></td>
						<td><?php echo "$nama"; ?></td>
						
						<td><?php echo round ($na,2);; ?></td>
						<td><?php if ($na>=50) {echo "LULUS";} else {echo "TIDAK LULUS";} ?></td>
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