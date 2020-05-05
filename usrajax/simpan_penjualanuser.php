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
	$ip_total_belanja = $_POST['ip_total_belanja'];
	$diskon_penjualan = 0;

	$query_penjualanuser = "INSERT INTO tbl_penjualan VALUES ('$no_penjualan', CURDATE(), CURTIME(), '$ip_total_belanja', '$diskon_penjualan', '0', 'Online', 'Pending', 'Belum Bayar','$kode_plg', NULL)";
	mysqli_query($conn, $query_penjualanuser) or die ($conn->error);

	$id_keranjang = '';
	$query_krj = "SELECT * FROM tbl_keranjang INNER JOIN tbl_keranjangdetail ON tbl_keranjang.id_keranjang = tbl_keranjangdetail.id_keranjang INNER JOIN tbl_produk ON tbl_keranjangdetail.id_prd = tbl_produk.id_prd WHERE tbl_keranjang.kode_plg = '$kode_plg'";
	$sql_krj = mysqli_query($conn, $query_krj) or die ($conn->error);
	while($data_krj = mysqli_fetch_array($sql_krj)) {
		$id_prd = $data_krj['id_prd'];
		$id_ukuran = $data_krj['id_ukuran'];
		$harga_prd = $data_krj['harga_prd'];
		$diskon_prd = $data_krj['diskon_prd'];
		$jml_prd = $data_krj['jml_prd'];
		$harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
		$subtotal = $harga_akhir * $jml_prd;
		$id_keranjang = $data_krj['id_keranjang'];

		$query_pjldetail = "INSERT INTO tbl_penjualandetail (id_prd, id_ukuran, harga_prd, diskon_prd, jml_prd, subtotal_prd, no_penjualan) VALUES ('$id_prd', '$id_ukuran', '$harga_akhir', '$diskon_prd', '$jml_prd', '$subtotal', '$no_penjualan')";
		mysqli_query($conn, $query_pjldetail) or die ($conn->error);
	}

	mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE id_keranjang = '$id_keranjang'") or die ($conn->error);
	mysqli_query($conn, "DELETE FROM tbl_keranjangdetail WHERE id_keranjang = '$id_keranjang'") or die ($conn->error);

	$query_datapenerima = "INSERT INTO tbl_datapenerima VALUES ('', '$nama_penerima', '$no_hpaktif', '$almt_lengkap', '$kd_pos', '$ip_provinsi', '$kota_kab', '$jasa_pengirim', '$paket_pengiriman', '$ip_etd_paket', '$ip_cost_paket', '$berat_kiriman', '$no_penjualan', '$kode_plg')";
	mysqli_query($conn, $query_datapenerima) or die ($conn->error);
 ?>