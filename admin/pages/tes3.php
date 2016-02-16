

<?php
include("../inc/config.php");

/*  $sql_count = mysql_query("SELECT COUNT(*) FROM praktikan where id_jad_prak='$idjp'");
							echo $sql_count;  */
							
							
							
							
							
							
							
							
							
							
$result = mysql_query("SELECT count(*) from praktikan where id_jad_prak='jp1'");
echo mysql_result($result, 0);							
							
							
							
							?>