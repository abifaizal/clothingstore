<?php 
  include "../../koneksi.php";

  $id_pgw = $_POST['id_pgw'];
  $nama_pgw = $_POST['nama_pgw'];
  $gender_pgw = $_POST['gender_pgw'];
  $lahir_pgw = $_POST['lahir_pgw'];
  $posisi_pgw = $_POST['posisi_pgw'];
  $alamat_pgw = $_POST['alamat_pgw'];
  $username_pgw = $_POST['username_pgw'];
  $password_pgw = $_POST['password_pgw'];
  $aktif_pgw = $_POST['aktif_pgw'];

  $query_username = "SELECT id_pgw FROM tbl_pegawai WHERE username_pgw = '$username_pgw' AND id_pgw != '$id_pgw'";
  $sql_username = mysqli_query($conn, $query_username) or die ($conn->error);
  $hasil_username = mysqli_fetch_array($sql_username);
  if($hasil_username) {
    echo "gagal-username";
  } else {
    $query_edit = "UPDATE tbl_pegawai SET nama_pgw = '$nama_pgw', gender_pgw = '$gender_pgw', lahir_pgw = '$lahir_pgw', posisi_pgw = '$posisi_pgw', alamat_pgw = '$alamat_pgw', username_pgw = '$username_pgw', password_pgw = '$password_pgw', aktif_pgw = '$aktif_pgw' WHERE id_pgw = '$id_pgw'";
    mysqli_query($conn, $query_edit) or die ($conn->error);
    echo "berhasil";
  }
 ?>