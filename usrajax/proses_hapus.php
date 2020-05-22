<?php 
	include "../koneksi.php";
	$key = mysqli_real_escape_string($conn, $_POST['key']);

	if(@$_GET['page']=='transaksi')
  {
    // $status = mysqli_real_escape_string($conn, $_POST['status']);
    // if($status == "Dikirim" || $status == "Selesai")
    // {
    //   $query = "DELETE FROM tbl_penjualan WHERE no_penjualan = '$key'";
    //   mysqli_query($conn, $query) or die ($conn->error);
    // }
    // else {
      $query_pjld = "SELECT * FROM tbl_penjualandetail WHERE no_penjualan = '$key'";
      $sql_pjld = mysqli_query($conn, $query_pjld) or die ($conn->error);
      while($data = mysqli_fetch_array($sql_pjld)) {
        $id_prd = $data['id_prd'];
        $id_ukuran = $data['id_ukuran'];
        $jml_prd = $data['jml_prd'];

        $query_stokproduk = "UPDATE tbl_produk SET stok_prd = stok_prd + '$jml_prd' WHERE id_prd = '$id_prd'";
        mysqli_query($conn, $query_stokproduk) or die ($conn->error);

        $query_stokukuran = "UPDATE tbl_ukuranprd SET stok_ukr = stok_ukr + '$jml_prd' WHERE id_ukuran = '$id_ukuran'";
        mysqli_query($conn, $query_stokukuran) or die ($conn->error);

        $query_del = "DELETE FROM tbl_penjualan WHERE no_penjualan = '$key'";
        mysqli_query($conn, $query_del) or die ($conn->error);
      }
    // }
  }
 ?>