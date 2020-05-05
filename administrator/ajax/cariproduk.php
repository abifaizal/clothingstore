<?php 
  include "../../koneksi.php";

  $id_prd = @mysqli_real_escape_string($conn, $_GET['id_prd']);
  $data = array();

  if(@$_GET['page']=='data_produk') {
	  $query_cari = "SELECT * FROM tbl_produk WHERE id_prd = '$id_prd'";
	  $sql_cari = mysqli_query($conn, $query_cari) or die ($conn->error);
	  while($hasil = mysqli_fetch_array($sql_cari)) {
	  	$data[] = $hasil;
	  }
	} 
	else if(@$_GET['page']=='data_ukuran') {
    $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND stok_ukr > 0";
    $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
    while($hasil = mysqli_fetch_array($sql_ukuran)) {
	  	$data[] = $hasil;
	  }
	}

  echo json_encode($data);
?>