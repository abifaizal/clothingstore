<?php 
	session_start();
	include "../../koneksi.php";

	$username_pgw = $_POST['username_pgw'];
  $password_pgw = $_POST['password_pgw'];

	$query = "SELECT * FROM tbl_pegawai WHERE username_pgw = '$username_pgw' AND password_pgw = '$password_pgw' AND aktif_pgw = 'Aktif'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	$data = mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql) > 0) {
		$_SESSION['username_pgw'] = $data['username_pgw'];
		$_SESSION['id_pgw'] = $data['id_pgw'];
		$_SESSION['nama_pgw'] = $data['nama_pgw'];
		$_SESSION['posisi_pgw'] = $data['posisi_pgw'];

		echo "berhasil";
	} else {
		echo "gagal";
	}

 ?>