<?php 
function stats(){
	$stat=1;
	if ($stat==0) {echo "Pending";} 
	elseif ($stat==1) {echo "Approve";} 
	else {echo "Denied";}
}
stats();
 ?>