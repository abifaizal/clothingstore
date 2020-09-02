<?php 
	session_start();
	include "../../koneksi.php";

	$id_pgw = $_SESSION['id_pgw'];
	$no_penjualan = $_POST['no_penjualan_balasan'];
	$komentar_balasan = $_POST['input_komentar_balasan'];

	$query_simpan_balasan = "INSERT INTO tbl_balasan (komentar_balasan, tgl_balasan, jam_balasan, id_pgw, no_penjualan) VALUES ('$komentar_balasan', CURDATE(), CURTIME(), '$id_pgw', '$no_penjualan')";
	mysqli_query($conn, $query_simpan_balasan) or die ($conn->error);

	$query_upd_status_ulasan = "UPDATE tbl_ulasan SET status_balasan = 'Ada' WHERE no_penjualan = '$no_penjualan'";
	mysqli_query($conn, $query_upd_status_ulasan) or die ($conn->error);
 ?>