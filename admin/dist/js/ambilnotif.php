<?php
	include("../../inc/config.php");
	$isi="";
	$sql = mysql_query("SELECT * FROM praktikan join mahasiswa on mahasiswa.nim=praktikan.nim where status_pr=0 order by id_praktikan desc");
	$count=0;
	while($data =  mysql_fetch_array($sql)){
		$count=$count+1;
		$isi.='<li>
				<a href="../praktikan/pending.php?id='.$data["id_praktikan"].'">
					<i class="fa fa-users text-yellow"></i>'.$data["nim"].' - '.$data["nama"].'
				</a>
			</li>';
	}
	echo $count.'|*-*|'.$isi;
?>