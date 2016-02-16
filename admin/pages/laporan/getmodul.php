<?php
include("../../inc/config.php");
$idpr = $_GET['p'];
$query = mysql_query("SELECT * FROM modul join mata_kuliah on mata_kuliah.id_mk=modul.id_mk join praktikum on praktikum.id_mk=mata_kuliah.id_mk WHERE id_prak ='$idpr'");
while( $data = mysql_fetch_array( $query ) ){
echo "<option value='".$data['id_modul']."'>Modul ".$data['no_modul']." - ".$data['judul_modul']."</option>";
}
?>