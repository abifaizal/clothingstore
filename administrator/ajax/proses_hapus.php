<?php 
  include "../../koneksi.php";
  $key = mysqli_real_escape_string($conn, $_POST['key']);
  if(@$_GET['page']=='produk')
  {
    $query_gbr = "SELECT gambar_prd FROM tbl_produk WHERE id_prd = '$key'";
    $sql_gbr = mysqli_query($conn, $query_gbr) or die ($conn->error);
    $data_gbr = mysqli_fetch_array($sql_gbr);
    $gambar_lama = $data_gbr['gambar_prd'];
    unlink("../../img/produk/".$gambar_lama);

    if(!file_exists($gambar_lama)) {
      $query = "DELETE FROM tbl_produk WHERE id_prd = '$key'";
      mysqli_query($conn, $query) or die ($conn->error);
    }
  }
  else if(@$_GET['page']=='pegawai')
  {
    $query = "DELETE FROM tbl_pegawai WHERE id_pgw = '$key'";
    mysqli_query($conn, $query) or die ($conn->error);
  }
  else if(@$_GET['page']=='pelanggan')
  {
    $query = "DELETE FROM tbl_pelanggan WHERE kode_plg = '$key'";
    mysqli_query($conn, $query) or die ($conn->error);
  }
  else if(@$_GET['page']=='keranjang')
  {
    $query = "DELETE FROM tbl_keranjang WHERE id_keranjang = '$key'";
    mysqli_query($conn, $query) or die ($conn->error);
  }
  else if(@$_GET['page']=='penjualan')
  {
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    if($status == "Dikirim" || $status == "Selesai")
    {
      $query = "DELETE FROM tbl_penjualan WHERE no_penjualan = '$key'";
      mysqli_query($conn, $query) or die ($conn->error);
    }
    else {
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
    }
  }
?>