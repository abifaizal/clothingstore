<?php 
	include "../koneksi.php";

	$id_plg = $_POST['id_plg'];
	$id_prd = $_POST['id_prd'];
	$ukuran = $_POST['pilih_ukuran'];
	$jml_beli = $_POST['jml_beli'];

  $carikeranjang = mysqli_query($conn, "SELECT id_keranjang FROM tbl_keranjang WHERE kode_plg = '$id_plg'") or die (mysql_error());
  $datakrj = mysqli_fetch_array($carikeranjang);
  if(!$datakrj) {
  	$carikode = mysqli_query($conn, "SELECT MAX(id_keranjang) FROM tbl_keranjang") or die (mysql_error());
	  $datakode = mysqli_fetch_array($carikode);
	  if($datakode) {
	    $nilaikode = substr($datakode[0], 3);
	    $kode = (int) $nilaikode;
	    $kode = $kode + 1;
	    $id_keranjang = "KRJ".str_pad($kode, 3, "0", STR_PAD_LEFT);
	  } else {
	    $id_keranjang = "KRJ001";
	  }
		$query_krj = "INSERT INTO tbl_keranjang VALUES ('$id_keranjang', CURDATE(), CURRENT_TIME(), '$id_plg')";
		mysqli_query($conn, $query_krj) or die ($conn->error);
	} else {
		$id_keranjang = $datakrj['id_keranjang'];
	}

	$cariproduk = mysqli_query($conn, "SELECT id_krjdt, jml_prd FROM tbl_keranjangdetail WHERE id_prd = '$id_prd' AND id_ukuran = '$ukuran' AND id_keranjang = '$id_keranjang'") or die (mysql_error());
  $dataprd = mysqli_fetch_array($cariproduk);
  if($dataprd) {
  	$id_krjdt = $dataprd['id_krjdt'];
  	$jml_prd = $dataprd['jml_prd'];
  	$jml_beli = $jml_prd + $jml_beli;

  	$query_upd = "UPDATE tbl_keranjangdetail SET jml_prd = '$jml_beli' WHERE id_krjdt = '$id_krjdt'";
  	mysqli_query($conn, $query_upd) or die ($conn->error);

  } else {
		$query_krjdt = "INSERT INTO tbl_keranjangdetail (id_prd, id_ukuran, jml_prd, id_keranjang) VALUES ('$id_prd', '$ukuran', '$jml_beli', '$id_keranjang')";
		mysqli_query($conn, $query_krjdt) or die ($conn->error);
	}
 ?>