<?php 
  include "../../koneksi.php";

  $carikode = mysqli_query($conn, "SELECT MAX(id_pgw) FROM tbl_pegawai") or die (mysql_error());
  $datakode = mysqli_fetch_array($carikode);
  if($datakode) {
    $nilaikode = substr($datakode[0], 3);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $id_pgw = "PGW".str_pad($kode, 3, "0", STR_PAD_LEFT);
  } else {
    $id_pgw = "PGW001";
  }

  $nama_pgw = $_POST['nama_pgw'];
  $gender_pgw = $_POST['gender_pgw'];
  $lahir_pgw = $_POST['lahir_pgw'];
  $posisi_pgw = $_POST['posisi_pgw'];
  $alamat_pgw = $_POST['alamat_pgw'];
  $username_pgw = $_POST['username_pgw'];
  $password_pgw = $_POST['password_pgw'];

  $query_username = "SELECT id_pgw FROM tbl_pegawai WHERE username_pgw = '$username_pgw'";
  $sql_username = mysqli_query($conn, $query_username) or die ($conn->error);
  $hasil_username = mysqli_fetch_array($sql_username);
  if($hasil_username) {
    echo "gagal-username";
  } else {
    $query_simpan = "INSERT INTO tbl_pegawai (id_pgw, nama_pgw, gender_pgw, lahir_pgw, posisi_pgw, alamat_pgw, username_pgw, password_pgw, aktif_pgw) VALUES ('$id_pgw', '$nama_pgw', '$gender_pgw', '$lahir_pgw', '$posisi_pgw', '$alamat_pgw', '$username_pgw', '$password_pgw', 'Aktif')";
    mysqli_query($conn, $query_simpan) or die ($conn->error);
    echo "berhasil";
  }
 ?>