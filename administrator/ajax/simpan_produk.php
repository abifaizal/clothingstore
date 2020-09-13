<?php 
  session_start();
  include "../../koneksi.php";

  $carikode = mysqli_query($conn, "SELECT MAX(id_prd) FROM tbl_produk") or die (mysql_error());
  $datakode = mysqli_fetch_array($carikode);
  if($datakode) {
    $nilaikode = substr($datakode[0], 3);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "PRD".str_pad($kode, 3, "0", STR_PAD_LEFT);
  } else {
    $hasilkode = "PRD001";
  }

  $id_pgw = $_SESSION['id_pgw'];
  $nama_prd = $_POST['nama_prd'];
  $kategori_prd = $_POST['kategori_prd'];
  $berat_prd = $_POST['berat_prd'];
  $harga_prd = $_POST['harga_prd'];
  $stok_prd = $_POST['stok_prd'];
  $deskripsi_prd = $_POST['deskripsi_prd'];
  // $gambar_prd = $_POST['gambar'];
  $temp = explode(".", $_FILES['gambar_prd']['name']);
  $gambar_prd = "prd-".round(microtime(true)) . '.' . end($temp);
  $sumber = $_FILES['gambar_prd']['tmp_name'];
  move_uploaded_file($sumber, "../../img/produk/".$gambar_prd);

  $query_produk = "INSERT INTO tbl_produk (id_prd, nama_prd, kategori_prd, harga_prd, diskon_prd, stok_prd, berat_prd, deskripsi_prd, gambar_prd, id_pgw) VALUES ('$hasilkode', '$nama_prd', '$kategori_prd', '$harga_prd', '0', '$stok_prd', '$berat_prd', '$deskripsi_prd', '$gambar_prd', '$id_pgw')";
  mysqli_query($conn, $query_produk) or die ($conn->error);

  for($i=0; $i < count($_POST['ukuran_prd']); $i++) {
    $ukuran_prd = $_POST['ukuran_prd'][$i];
    $jml_ukuranprd = $_POST['jml_ukuranprd'][$i];

    $query_ukuran = "INSERT INTO tbl_ukuranprd (keterangan_ukr, stok_ukr, id_prd) VALUES ('$ukuran_prd', '$jml_ukuranprd', '$hasilkode')";
    mysqli_query($conn, $query_ukuran) or die ($conn->error);
  }
 ?>