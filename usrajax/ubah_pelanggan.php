<?php 
  include "../koneksi.php";

  $kode_plg = $_POST['kode_plg'];
  $nama_plg = $_POST['nama_plg'];
  $gender_plg = $_POST['gender_plg'];
  $email_plg = $_POST['email_plg'];
  $username_plg = $_POST['username_plg'];
  $password_plg = $_POST['password_plg'];

  $query_username = "SELECT nama_plg FROM tbl_pelanggan WHERE username_plg = '$username_plg' AND kode_plg != '$kode_plg'";
  $sql_username = mysqli_query($conn, $query_username) or die ($conn->error);
  $hasil_username = mysqli_fetch_array($sql_username);

  if($hasil_username) {
    echo "gagal-username";
  } else {
    $query_edit = "UPDATE tbl_pelanggan SET username_plg='$username_plg', nama_plg='$nama_plg', gender_plg='$gender_plg', email_plg='$email_plg', password_plg='$password_plg' WHERE kode_plg = '$kode_plg'";
    mysqli_query($conn, $query_edit) or die ($conn->error);
    session_start();
    $_SESSION['username_plg'] = $username_plg;
    $_SESSION['nama_plg'] = $nama_plg;
    echo "berhasil";
  }
 ?>