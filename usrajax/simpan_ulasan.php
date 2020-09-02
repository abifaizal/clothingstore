<?php 
	session_start();
	include "../koneksi.php";

	$no_penjualan = $_POST['hidden_kdtransaksi_ulasan'];
	$rating = $_POST['rating'];
	$komentar = $_POST['komentar'];
	$kode_plg = $_SESSION['kode_plg'];

	$query_simpan_ulasan = "INSERT INTO tbl_ulasan (rating_ulasan, komentar_ulasan, tgl_ulasan, jam_ulasan, kode_plg, no_penjualan) VALUES ('$rating', '$komentar', CURDATE(), CURTIME(), '$kode_plg', '$no_penjualan')";
	mysqli_query($conn, $query_simpan_ulasan) or die ($conn->error);

	// Update status ulasan data penjualan
	$query_upd_pjl = "UPDATE tbl_penjualan SET status_ulasan = 'Ada' WHERE no_penjualan = '$no_penjualan'";
	mysqli_query($conn, $query_upd_pjl) or die ($conn->error);
 ?>