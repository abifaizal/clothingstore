<?php 
  include "../../koneksi.php";

  $id_prd = $_POST['id_prd'];
  $nama_prd = $_POST['nama_prd'];
  $kategori_prd = $_POST['kategori_prd'];
  $berat_prd = $_POST['berat_prd'];
  $harga_prd = $_POST['harga_prd'];
  $diskon_prd = $_POST['diskon_prd'];
  $stok_prd = $_POST['stok_prd'];
  $deskripsi_prd = $_POST['deskripsi_prd'];
  $gambar_baru = $_FILES['gambar_prd']['name'];

  $query_edprd = "UPDATE tbl_produk SET nama_prd = '$nama_prd', kategori_prd = '$kategori_prd', berat_prd = '$berat_prd', harga_prd = '$harga_prd', diskon_prd = '$diskon_prd', stok_prd = '$stok_prd', deskripsi_prd = '$deskripsi_prd'";
  if($gambar_baru == "") {
  	$query_edprd .= " WHERE id_prd = '$id_prd'";
  	mysqli_query($conn, $query_edprd) or die ($conn->error);
  } else {
  	$query_gbr = "SELECT gambar_prd FROM tbl_produk WHERE id_prd = '$id_prd'";
  	$sql_gbr = mysqli_query($conn, $query_gbr) or die ($conn->error);
  	$data_gbr = mysqli_fetch_array($sql_gbr);
  	$gambar_lama = $data_gbr['gambar_prd'];
  	unlink("../../img/produk/".$gambar_lama);

  	if(!file_exists($gambar_lama)) {
		  $temp = explode(".", $gambar_baru);
		  $gambar_prd = "prd-".round(microtime(true)) . '.' . end($temp);
		  $sumber = $_FILES['gambar_prd']['tmp_name'];
		  move_uploaded_file($sumber, "../../img/produk/".$gambar_prd);

		  $query_edprd .= ", gambar_prd = '$gambar_prd' WHERE id_prd = '$id_prd'";
  		mysqli_query($conn, $query_edprd) or die ($conn->error);
		}
	}

	// $query_delukr = "DELETE FROM tbl_ukuranprd WHERE id_prd = '$id_prd'";
	// mysqli_query($conn, $query_delukr) or die ($conn->error);

  for($i=0; $i < count($_POST['ukuran_prd']); $i++) {
    $idukuran_prd = $_POST['idukuran_prd'][$i];
    $ukuran_prd = $_POST['ukuran_prd'][$i];
    $jml_ukuranprd = $_POST['jml_ukuranprd'][$i];

    if($idukuran_prd == "baru") {
      $query_ukuran = "INSERT INTO tbl_ukuranprd (keterangan_ukr, stok_ukr, id_prd) VALUES ('$ukuran_prd', '$jml_ukuranprd', '$id_prd')";
      mysqli_query($conn, $query_ukuran) or die ($conn->error);
    } else {
      $query_ukuran = "UPDATE tbl_ukuranprd SET keterangan_ukr = '$ukuran_prd', stok_ukr = '$jml_ukuranprd' WHERE id_ukuran = '$idukuran_prd'";
      mysqli_query($conn, $query_ukuran) or die ($conn->error);
    }
  }
?>