<?php 
	session_start();
  include "../koneksi.php";

  // INNER JOIN tbl_balasan ON tbl_ulasan.no_penjualan = tbl_balasan.no_penjualan

  if(@$_GET['page']=='lihat_ulasan')
  {
  	$no_penjualan = $_GET['no_penjualan'];
  	$data = array();
  	$query_ulasan = "SELECT *, DATE_FORMAT(tgl_ulasan, '%d %M %Y') AS tglformat_ulasan FROM tbl_ulasan WHERE tbl_ulasan.no_penjualan = '$no_penjualan'";
  	$sql_ulasan = mysqli_query($conn, $query_ulasan) or die ($conn->error);
  	$data_ulasan = mysqli_fetch_array($sql_ulasan);
  	if($data_ulasan['status_balasan'] == "Kosong") {
  		$data[] = $data_ulasan;
  	}
  	else {
  		$query_ulasan = "SELECT *, DATE_FORMAT(tgl_ulasan, '%d %M %Y') AS tglformat_ulasan, DATE_FORMAT(tgl_balasan, '%d %M %Y') AS tglformat_balasan FROM tbl_ulasan INNER JOIN tbl_balasan ON tbl_ulasan.no_penjualan = tbl_balasan.no_penjualan WHERE tbl_ulasan.no_penjualan = '$no_penjualan'";
	  	$sql_ulasan = mysqli_query($conn, $query_ulasan) or die ($conn->error);
	  	$data_ulasan = mysqli_fetch_array($sql_ulasan);
	  	$data[] = $data_ulasan;
  	}

  	echo json_encode($data);
  }
 ?>