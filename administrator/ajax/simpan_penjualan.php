<?php 
	session_start();
	include "../../koneksi.php";

	$no_penjualan = $_POST['no_penjualan'];
	$id_pgw = $_SESSION['id_pgw'];
	$total_penjualan = $_POST['total_penjualan'];
	$diskon_penjualan = $_POST['diskon_tran'];
	$bayar_penjualan = $_POST['jml_bayar'];

	$query_penjualan = "INSERT INTO tbl_penjualan VALUES ('$no_penjualan', CURDATE(), CURTIME(), '$total_penjualan', '$diskon_penjualan', '$bayar_penjualan', 'Offline', 'Lunas', 'Selesai', NULL, '$id_pgw')";
	mysqli_query($conn, $query_penjualan) or die ($conn->error);

	for($i = 0; $i < count($_POST['hidden_id_prd']); $i++) {
		$id_prd = $_POST['hidden_id_prd'][$i];
		$id_ukuran = $_POST['hidden_ukuran_beli'][$i];
		$harga_prd = $_POST['hidden_harga_prd'][$i];
		$diskon_prd = $_POST['hidden_diskon_prd'][$i];
		$jml_prd = $_POST['hidden_jml_beli'][$i];
		$subtotal_prd = $_POST['hidden_subtotal_beli'][$i];

		$query_detail = "INSERT INTO tbl_penjualandetail (id_prd, id_ukuran, harga_prd, diskon_prd, jml_prd, subtotal_prd, no_penjualan) VALUES ('$id_prd', '$id_ukuran', '$harga_prd', '$diskon_prd', '$jml_prd', '$subtotal_prd', '$no_penjualan')";
		mysqli_query($conn, $query_detail) or die ($conn->error);
	}
 ?>