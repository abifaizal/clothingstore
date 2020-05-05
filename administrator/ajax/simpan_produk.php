<?php 
  // if(@$_POST['upload']) {
  //   $gambar_prd = $_FILES['file']['name'];
  //   $sumber = $_FILES['file']['tmp_name'];
  //   $upload = move_uploaded_file($sumber, "../../img/".$gambar_prd);

  //   echo $gambar_prd;

  //   if($upload) {
  //     echo "berhasil";
  //   } else {
  //     echo "gagal";
  //   }
  // }
 ?>

<!-- <html>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file[]" id="file">
    <input type="text" name="text">
    <input type="submit" name="upload" value="upload">
  </form>
</html> -->


<?php 
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

  $query_produk = "INSERT INTO tbl_produk VALUES ('$hasilkode', '$nama_prd', '$kategori_prd', '$harga_prd', '0', '$stok_prd', '$berat_prd', '$deskripsi_prd', '$gambar_prd')";
  mysqli_query($conn, $query_produk) or die ($conn->error);

  for($i=0; $i < count($_POST['ukuran_prd']); $i++) {
    $ukuran_prd = $_POST['ukuran_prd'][$i];
    $jml_ukuranprd = $_POST['jml_ukuranprd'][$i];

    $query_ukuran = "INSERT INTO tbl_ukuranprd (keterangan_ukr, stok_ukr, id_prd) VALUES ('$ukuran_prd', '$jml_ukuranprd', '$hasilkode')";
    mysqli_query($conn, $query_ukuran) or die ($conn->error);
  }
 ?>