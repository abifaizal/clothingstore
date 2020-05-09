<?php 
	session_start();
	include "../../koneksi.php";

	$id_pgw = $_SESSION['id_pgw'];
	$no_penjualan = $_POST['no_penjualan'];
	$no_resi = $_POST['no_resi'];
	$jasa_kirim = $_POST['jasa_kirim'];
	$tgl_kirim = $_POST['tgl_kirim'];
	$lama_pengiriman = $_POST['lama_pengiriman'];
	$catatan_kirim = $_POST['catatan_kirim'];

	$query_formkirim = "INSERT INTO tbl_datapengiriman VALUES ('', '$no_resi', '$jasa_kirim', '$tgl_kirim', '$lama_pengiriman', '$catatan_kirim', CURDATE(), '$no_penjualan', '$id_pgw')";
	mysqli_query($conn, $query_formkirim) or die ($conn->error);

	$query_ubahverifikasi = "UPDATE tbl_penjualan SET status_penjualan = 'Dikirim' WHERE no_penjualan = '$no_penjualan'";
  mysqli_query($conn, $query_ubahverifikasi) or die ($conn->error);
 ?>