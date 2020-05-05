<?php 
	session_start();
	include "../koneksi.php";

	$username = @mysqli_real_escape_string($conn, $_GET['username']);
	$password = @mysqli_real_escape_string($conn, $_GET['password']);

	$query = "SELECT * FROM tbl_pelanggan WHERE username_plg = '$username' AND password_plg = '$password'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	$data = mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql) > 0) {
		$_SESSION['kode_plg'] = $data['kode_plg'];
		$_SESSION['username_plg'] = $data['username_plg'];
		$_SESSION['nama_plg'] = $data['nama_plg'];

		echo "berhasil";
	} else {
		echo "gagal";
	}

 ?>