<?php
session_start();

if(isset($_SESSION['ADMIN_LBD']) && $_SESSION['akses']=="3")
{
	echo "masuak sebagai dosen";
}
elseif(isset($_SESSION['ADMIN_LBD']) && $_SESSION['akses']=="2")
{
	echo "masuak sebagai asisten";
}
elseif(isset($_SESSION['ADMIN_LBD']) && $_SESSION['akses']=="1")
{
	echo "masuak sebagai analis";
}
?>