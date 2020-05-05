<?php 
	session_start();
	include "../koneksi.php";

	$no_penjualan = $_POST['no_penjualan'];
	$id_transfer = $_POST['id_transfer'];
	$nama_pengirim = $_POST['nama_pengirim'];
	$tgl_transfer = $_POST['tgl_transfer'];
	$jam_transfer = $_POST['jam_transfer'];
	$bank_transfer = $_POST['bank_transfer'];
	$gambar_baru = $_FILES['bukti_transfer']['name'];

	$query_edit = "UPDATE tbl_buktitransfer SET nama_pengirim = '$nama_pengirim', tgl_transfer = '$tgl_transfer', jam_transfer = '$jam_transfer', bank_transfer = '$bank_transfer'";
	if($gambar_baru == "") {
		$query_edit .= " WHERE id_transfer = '$id_transfer'";
		mysqli_query($conn, $query_edit) or die ($conn->error);
	} else {
		$query_gbr = "SELECT foto_bukti FROM tbl_buktitransfer WHERE id_transfer = '$id_transfer'";
		$sql_gbr = mysqli_query($conn, $query_gbr) or die ($conn->error);
  	$data_gbr = mysqli_fetch_array($sql_gbr);
  	$gambar_lama = $data_gbr['foto_bukti'];
  	unlink("../img/bukti_transfer/".$gambar_lama);

  	if(!file_exists($gambar_lama)) {
		  $temp = explode(".", $gambar_baru);
		  $foto_bukti = "bkt-".round(microtime(true)) . '.' . end($temp);
		  $sumber = $_FILES['bukti_transfer']['tmp_name'];
		  move_uploaded_file($sumber, "../img/bukti_transfer/".$foto_bukti);

		  $query_edit .= ", foto_bukti = '$foto_bukti' WHERE id_transfer = '$id_transfer'";
  		mysqli_query($conn, $query_edit) or die ($conn->error);
		}
	}
 ?>