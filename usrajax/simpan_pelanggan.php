<?php 
  include "../koneksi.php";

  $tgl_masuk = date('Y-m-d');
  $hari= substr($tgl_masuk, 8, 2);
  $bulan = substr($tgl_masuk, 5, 2);
  $tahun = substr($tgl_masuk, 0, 4);
  $tgl = $tahun.$bulan.$hari;
  $carikode = mysqli_query($conn, "SELECT MAX(kode_plg) FROM tbl_pelanggan WHERE tglregis_plg = '$tgl_masuk'") or die (mysql_error());
  $datakode = mysqli_fetch_array($carikode);
  if($datakode) {
      $nilaikode = substr($datakode[0], 8);
      $kode = (int) $nilaikode;
      $kode = $kode + 1;
      $kode_plg = $tgl.str_pad($kode, 2, "0", STR_PAD_LEFT);
  } else {
      $kode_plg = $tgl."01";
  }

  $nama_plg = $_POST['nama_plg'];
  $gender_plg = $_POST['gender_plg'];
  $email_plg = $_POST['email_plg'];
  $username_plg = $_POST['username_plg'];
  $password_plg = $_POST['password_plg'];

  $query_username = "SELECT nama_plg FROM tbl_pelanggan WHERE username_plg = '$username_plg'";
  $sql_username = mysqli_query($conn, $query_username) or die ($conn->error);
  $hasil_username = mysqli_fetch_array($sql_username);

  if($hasil_username) {
    echo "gagal-username";
  } else {
    $query_simpan = "INSERT INTO tbl_pelanggan VALUES ('$kode_plg', '$nama_plg', '$gender_plg', '$email_plg', '$username_plg', '$password_plg', '$tgl_masuk')";
    mysqli_query($conn, $query_simpan) or die ($conn->error);
    echo "berhasil";
  }
 ?>