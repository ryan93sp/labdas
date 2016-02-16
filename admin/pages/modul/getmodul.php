<?php
include("../../inc/config.php");
$idpr = $_GET['p'];
$query = mysql_query("SELECT * FROM modul WHERE id_mk ='$idpr'");
while( $data = mysql_fetch_array( $query ) ){
echo "<option value='".$data['id_modul']."'>Modul ".$data['no_modul']." - ".$data['judul_modul']."</option>";
}
?>