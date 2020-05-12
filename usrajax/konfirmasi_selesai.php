<?php 
	session_start();
	include "../koneksi.php";

	$no_penjualan = @mysqli_real_escape_string($conn, $_GET['no_penjualan']);
  $query_transaksiselesai = "UPDATE tbl_penjualan SET status_penjualan = 'Selesai' WHERE no_penjualan = '$no_penjualan'";
  mysqli_query($conn, $query_transaksiselesai) or die ($conn->error);
 ?>