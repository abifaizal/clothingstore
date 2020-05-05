<?php 
	session_start();
	unset($_SESSION['kode_plg']);
	unset($_SESSION['username_plg']);
	unset($_SESSION['nama_plg']);

	session_destroy();
 ?>