<?php 
  include "../../koneksi.php";
  $key = mysqli_real_escape_string($conn, $_POST['key']);
  if(@$_GET['page']=='produk')
  {
    $query = "DELETE FROM tbl_produk WHERE id_prd = '$key'";
    mysqli_query($conn, $query) or die ($conn->error);
  }
  else if(@$_GET['page']=='pegawai')
  {
    $query = "DELETE FROM tbl_pegawai WHERE id_pgw = '$key'";
    mysqli_query($conn, $query) or die ($conn->error);
  }
?>