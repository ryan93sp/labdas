<?php include("../../inc/config.php");
if (isset($_GET['p'])){
$idjp=$_GET['p'];
$idm=$_GET['m'];}
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
					$sql_p = mysql_query("select * from jadwal_praktikum 
					join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak 
					join mata_kuliah on mata_kuliah.id_mk=praktikum.id_mk 
					where id_jad_prak='$idjp'");
					$no = 1;
					$d =  mysql_fetch_array($sql_p);
					$sql_m = mysql_query("select * from modul where id_modul='$idm'");
					$m =  mysql_fetch_array($sql_m);
					?>
                  <center><h3 class="">Daftar Nilai Praktikum <?php echo $d['nama_mk'] ?> Modul <?php echo $m['no_modul']." - ".$m['judul_modul']; ?></h3></center>
				  <center><h3 class="">Semester <?php if ($d['semester']==1) {echo "Ganjil";} else {echo "Genap";} ?> Tahun <?php echo $d['tahun_ajaran'] ?></h3></center>
                </div>
				
                <div class="">
                  <table id="" class="table table-bordered">
                    <thead>
                      <tr>
						<th><center>No</center></th>
						<th><center>No.BP</center></th>
                        <th><center>Nama</center></th>
                        <th><center>Nilai Akhir</center></th>
						<th><center>Keterangan</center></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$sql = mysql_query("SELECT * FROM praktikan LEFT JOIN nilai ON nilai.id_praktikan = praktikan.id_praktikan JOIN mahasiswa ON mahasiswa.nim = praktikan.nim JOIN jadwal_praktikum ON praktikan.id_jad_prak = jadwal_praktikum.id_jad_prak WHERE praktikan.id_jad_prak = '$idjp' and (id_modul='$idm' or id_modul is null) and status_pr=1 ORDER BY mahasiswa.nim");
					while($data =  mysql_fetch_array($sql)){
					$idn = $data['id_nilai'];
					$nim = $data['nim'];
					$nama = $data['nama'];
					$awal = $data['nilai_lap_awal'];
					$praktik = $data['nilai_prak'];
					$laporan = $data['nilai_laporan'];
					/* $jur = $data['nama_jurusan'];
					$sem = $data['semester'];
					$fak = $data['nama_fakultas'];
					$tahun = $data['tahun_ajaran']; */
					
					?>	
                      <tr>
						<td><?php echo "$no"; ?></td>
                        <td><?php echo "$nim"; ?></td>
                        <td><?php echo "$nama"; ?></td>
                        <!-- <td><?php/*  echo "$jur";  */?></td> -->
						<td><?php $ntot=($awal+$praktik+$laporan)/3; $nakhir=$ntot; echo round ($nakhir,2); ?></td>
                        <td><?php $ntot=($awal+$praktik+$laporan); if ($ntot>=151) {echo "LULUS";} else {echo "TIDAK LULUS";} ?></td>
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