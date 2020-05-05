<?php 
	session_start();
	include "../koneksi.php";

	$no_penjualan = $_POST['no_penjualan'];
	$nama_pengirim = $_POST['nama_pengirim'];
	$tgl_transfer = $_POST['tgl_transfer'];
	$jam_transfer = $_POST['jam_transfer'];
	$bank_transfer = $_POST['bank_transfer'];

	$temp = explode(".", $_FILES['bukti_transfer']['name']);
  $bukti_trans = "bkt-".round(microtime(true)) . '.' . end($temp);
  $sumber = $_FILES['bukti_transfer']['tmp_name'];
  move_uploaded_file($sumber, "../img/bukti_transfer/".$bukti_trans);

  $query_konf = "INSERT INTO tbl_buktitransfer VALUES ('', '$nama_pengirim', '$tgl_transfer', '$jam_transfer', '$bank_transfer', '$bukti_trans', '$no_penjualan')";
  mysqli_query($conn, $query_konf) or die ($conn->error);

  $query_updpjl = "UPDATE tbl_penjualan SET status_penjualan = 'Menunggu Verifikasi' WHERE no_penjualan = '$no_penjualan'";
  mysqli_query($conn, $query_updpjl) or die ($conn->error);
?>