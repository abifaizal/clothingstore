<?php 
	include "../../koneksi.php";
	$jns_periode = @$_POST['jns_periode'];
	$tglakhir_aktif = @$_POST['tglakhir_aktif'];
	$tgl_awal = @$_POST['tgl_awal'];
	$tgl_akhir = @$_POST['tgl_akhir'];
	$blnakhir_aktif = @$_POST['blnakhir_aktif'];
	$bulan_awal = @$_POST['bulan_awal'];
	$bulanthn_awal = @$_POST['bulanthn_awal'];
	$bulan_akhir = @$_POST['bulan_akhir'];
	$bulanthn_akhir = @$_POST['bulanthn_akhir'];
	$thnakhir_aktif = @$_POST['thnakhir_aktif'];
	$tahun_awal = @$_POST['tahun_awal'];
	$tahun_akhir = @$_POST['tahun_akhir'];
	$jns_transaksi = @$_POST['jns_transaksi'];
	$bt_laporan = @$_POST['bt_laporan'];
	if($jns_transaksi == "Semua") {
		$metode = "%";
	} else {
		$metode = $jns_transaksi;
	}

	if($jns_periode == "Hari ini") {
		$ket_periode = date('d M Y');
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE tgl_penjualan = CURDATE() AND metode_penjualan LIKE '$metode' ORDER BY tgl_penjualan ASC";
	}
	else if($jns_periode == "Bulan ini") {
		$ket_periode = date('F Y');
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE (MONTH(tgl_penjualan) = MONTH(CURDATE()) AND YEAR(tgl_penjualan) = YEAR(CURDATE())) AND metode_penjualan LIKE '$metode' ORDER BY tgl_penjualan ASC";
	}
	else if($jns_periode == "Tahun ini") {
		$ket_periode = "Tahun ".date('Y');
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE YEAR(tgl_penjualan) = YEAR(CURDATE()) AND metode_penjualan LIKE '$metode' ORDER BY tgl_penjualan ASC";
	}
	else if($jns_periode == "per_tanggal") {
		if($tglakhir_aktif == "aktif") {
			$ket_periode = tgl_indo($tgl_awal)." sd ".tgl_indo($tgl_akhir);
			$where_tgl_penjualan = "(tgl_penjualan BETWEEN '$tgl_awal' AND '$tgl_akhir')";
		} else {
			$ket_periode = tgl_indo($tgl_awal);
			$where_tgl_penjualan = "(tgl_penjualan = '$tgl_awal')";
		}
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE $where_tgl_penjualan AND metode_penjualan LIKE '$metode' ORDER BY tgl_penjualan ASC";
	}
	else if($jns_periode == "per_bulan") {
		if($blnakhir_aktif == "aktif") {
			$ket_periode = bulan_indo($bulan_awal)." ".$bulanthn_awal." sd ".bulan_indo($bulan_akhir)." ".$bulanthn_akhir;
			$where_tgl_penjualan = "((MONTH(tgl_penjualan) BETWEEN '$bulan_awal' AND '$bulan_akhir') AND (YEAR(tgl_penjualan) BETWEEN '$bulanthn_awal' AND '$bulanthn_akhir'))";
		} else {
			$ket_periode = bulan_indo($bulan_awal)." ".$bulanthn_awal;
			$where_tgl_penjualan = "(MONTH(tgl_penjualan) = '$bulan_awal' AND YEAR(tgl_penjualan) = '$bulanthn_awal')";
		}
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE $where_tgl_penjualan AND metode_penjualan LIKE '$metode' ORDER BY tgl_penjualan ASC";
	}
	else if($jns_periode == "per_tahun") {
		if($thnakhir_aktif == "aktif") {
			$ket_periode = "Tahun ".$tahun_awal." sd ".$tahun_akhir;
			$where_tgl_penjualan = "(YEAR(tgl_penjualan) BETWEEN '$tahun_awal' AND '$tahun_akhir')";
		} else {
			$ket_periode = "Tahun ".$tahun_awal;
			$where_tgl_penjualan = "(YEAR(tgl_penjualan) = '$tahun_awal')";
		}
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE $where_tgl_penjualan AND metode_penjualan LIKE '$metode' ORDER BY tgl_penjualan ASC";
	}

	$sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
	$rows_pjl = mysqli_num_rows($sql_pjl);
	if($rows_pjl > 0) {
		echo "ada";
	} else {
		echo "kosong";
	}
 ?>