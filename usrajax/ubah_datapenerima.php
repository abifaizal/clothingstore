<?php 
	session_start();
	include "../koneksi.php";

	$no_penjualan = $_POST['no_penjualan'];
	$kode_plg = $_SESSION['kode_plg'];
	$nama_penerima = $_POST['nm_penerima'];
	$no_hpaktif = $_POST['no_hpaktif'];
	$almt_lengkap = $_POST['almt_lengkap'];
	$kd_pos = $_POST['kd_pos'];
	$ip_provinsi = $_POST['ip_provinsi'];
	$kota_kab = $_POST['kota_kab'];
	$jasa_pengirim = $_POST['jasa_pengirim'];
	$paket_pengiriman = $_POST['paket_pengiriman'];
	$ip_etd_paket = $_POST['ip_etd_paket'];
	$ip_cost_paket = $_POST['ip_cost_paket'];
	$berat_kiriman = $_POST['berat_kiriman'];

	$query_ubahdatapenerima = "UPDATE tbl_datapenerima SET nama_penerima = '$nama_penerima', nohp_penerima = '$no_hpaktif', alamat_penerima = '$almt_lengkap', kode_pos = '$kd_pos', provinsi_penerima = '$ip_provinsi', kabkota_penerima = '$kota_kab', kurir_pengiriman = '$jasa_pengirim', paket_pengiriman = '$paket_pengiriman', etd_paket = '$ip_etd_paket', ongkir_paket = '$ip_cost_paket', berat_kiriman = '$berat_kiriman' WHERE no_penjualan = '$no_penjualan' AND kode_plg = '$kode_plg' ";
	mysqli_query($conn, $query_ubahdatapenerima) or die ($conn->error);
 ?>