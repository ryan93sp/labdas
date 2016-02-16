<?php
include("../../inc/config.php");
$id_prak = $_GET['p'];
$query = mysql_query("SELECT * FROM jadwal_praktikum join praktikum on praktikum.id_prak=jadwal_praktikum.id_prak join jadwal on jadwal.id_jadwal=jadwal_praktikum.id_jadwal join shift on shift.id_shift=jadwal.id_shift join hari on hari.id_hari=jadwal.id_hari WHERE jadwal_praktikum.id_prak ='$id_prak' and status=1");
while( $data = mysql_fetch_array( $query ) ){
echo "<option value='".$data['id_jad_prak']."'>".$data['nama_hari']." / ".$data['ket_shift']."</option>";
}
?>