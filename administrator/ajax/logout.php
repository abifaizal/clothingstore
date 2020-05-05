<?php 
	session_start();
	unset($_SESSION['username_pgw']);
	unset($_SESSION['id_pgw']);
	unset($_SESSION['nama_pgw']);
	unset($_SESSION['posisi_pgw']);

	session_destroy();
 ?>