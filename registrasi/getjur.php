<?php
include ('../admin/inc/config.php');
$id_fak = $_GET['p'];
$query = mysql_query("SELECT * FROM jurusan WHERE id_fakultas ='$id_fak'");
while( $data = mysql_fetch_array( $query ) ){
echo "<option value='".$data['id_jurusan']."'>".$data['nama_jurusan']."</option>";
}
?>