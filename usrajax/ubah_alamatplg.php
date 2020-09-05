<?php 
	session_start();
	include "../koneksi.php";

	$id_alamatplg = $_POST['id_alamatplg'];
	$kode_plg = $_SESSION['kode_plg'];
	$nama_penerima = $_POST['nm_penerima'];
	$no_hpaktif = $_POST['no_hpaktif'];
	$almt_lengkap = $_POST['almt_lengkap'];
	$kd_pos = $_POST['kd_pos'];
	$id_provinsi = $_POST['provinsi_tujuan'];
	$ip_provinsi = $_POST['ip_provinsi'];
	$kota_kab = $_POST['kota_kab'];
	$status_alamatplg = $_POST['status_alamatplg'];

	$query_updatealamat = "UPDATE tbl_alamatplg SET nama_alamatplg = '$nama_penerima', nohp_alamatplg = '$no_hpaktif', alamat_plg = '$almt_lengkap', kodepos_alamatplg = '$kd_pos', provinsi_alamatplg = '$ip_provinsi', id_provinsi = '$id_provinsi', kabkota_alamatplg = '$kota_kab', status_alamatplg = '$status_alamatplg' WHERE id_alamatplg = '$id_alamatplg' ";
	mysqli_query($conn, $query_updatealamat) or die ($conn->error);
 ?>