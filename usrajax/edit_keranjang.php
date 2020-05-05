<?php 
	session_start();
	include "../koneksi.php";
	$kode_plg = '2020033001';
	$kode_plg = $_SESSION['kode_plg'];

	if(@$_GET['page']=='ukuran')
  {
    $id_krjdt = @mysqli_real_escape_string($conn, $_POST['id_krjdt']);
    $id_ukuran = @mysqli_real_escape_string($conn, $_POST['id_ukuran']);

    $query_ukuran = "UPDATE tbl_keranjangdetail SET id_ukuran = '$id_ukuran' WHERE id_krjdt = '$id_krjdt'";
    mysqli_query($conn, $query_ukuran) or die ($conn->error);
  }
  else if(@$_GET['page']=='jml_beli')
  {
    $id_krjdt = @mysqli_real_escape_string($conn, $_POST['id_krjdt']);
    $jml_beli = @mysqli_real_escape_string($conn, $_POST['jml_beli']);

    $query_jmlbeli = "UPDATE tbl_keranjangdetail SET jml_prd = '$jml_beli' WHERE id_krjdt = '$id_krjdt'";
    mysqli_query($conn, $query_jmlbeli) or die ($conn->error);
  }
  else if(@$_GET['page']=='hapus')
  {
    $id_krjdt = @mysqli_real_escape_string($conn, $_POST['id_krjdt']);

    $query_hapus = "DELETE FROM tbl_keranjangdetail WHERE id_krjdt = '$id_krjdt'";
    mysqli_query($conn, $query_hapus) or die ($conn->error);

    $query_cekkrj = "SELECT id_krjdt FROM tbl_keranjangdetail INNER JOIN tbl_keranjang ON tbl_keranjangdetail.id_keranjang = tbl_keranjang.id_keranjang WHERE tbl_keranjang.kode_plg = '$kode_plg'";
    $sql_krj = mysqli_query($conn, $query_cekkrj) or die ($conn->error);
    $data_krj = mysqli_fetch_array($sql_krj);
    if(!$data_krj) {
    	$query_hapus_krjglobal = "DELETE FROM tbl_keranjang WHERE kode_plg = '$kode_plg'";
    	mysqli_query($conn, $query_hapus_krjglobal) or die ($conn->error);
    }
  }
 ?>