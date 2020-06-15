<style>
	.nama-distro {
		font-size: 28px;
		font-weight: bold;
		text-align: center;
		margin-bottom: 0px;
	}	
	.alamat-distro {
		text-align: center;
		border-bottom: 1px solid;
		line-height: 1.5;
		padding-bottom: 10px;
		margin-bottom: 10px;
	}	
	.judul-laporan {
		font-size: 16px;
		font-weight: bold;
		text-align: center;
	}
	.info-laporan th, .info-laporan td {
		padding: 3px 11px 3px 0;
	}
	.info-laporan, .data-penjualan {
		vertical-align: top;
	}
	.data-penjualan {
		border-collapse: collapse;
		width: 100%;
		min-width: 100%;
		max-width: 100%;
	}
	.data-penjualan th, .data-penjualan td {
		padding: 7px 3px;
	}
	.data-penjualan .judul-kolom {
		text-align: center;
	}
	.nomor {
		width: 5%;
		text-align: center;
	}
	.no-penjualan {
		width: 16%;
	}
	.waktu-penjualan {
		width: 21%;
	}
	.jenis-penjualan {
		width: 8%;
	}
	.status-penjualan {
		width: 18%;
	}
	.lunas-penjualan {
		width: 14%;
	}
	.total-penjualan {
		width: 18%;
	}
</style>

<?php 
	include '../koneksi.php';
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
?>

<page backleft="5px" backright="5px" backtop="10px" backbottom="30px" style="font-size: 12px; line-height: 1.3;">
	<page_header></page_header>
	<page_footer style="text-align: right; font-size: 10px; font-style: italic;">
		Laporan Penjualan - Hal. [[page_cu]]
	</page_footer>

	<div class="nama-distro">
		BLACK SHADOW
	</div>
	<div class="alamat-distro">
		BlackShadow Merchandise Jln. Tentara No 17, Selatan Polres Kebumen. <br>
		Telp. 0896 0251 3757 <br>
	</div>

	<?php 
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
	?>

	<div class="judul-laporan">
		Laporan Penjualan
	</div>
	<table class="info-laporan">
		<tr>
			<th class="judul-info">Periode</th>
			<td class="isi-info"><?php echo $ket_periode; ?></td>
		</tr>
		<tr>
			<th class="judul-info">Jenis Transaksi</th>
			<td class="isi-info"><?php echo $jns_transaksi; ?></td>
		</tr>
		<tr>
			<th class="judul-info">Bentuk Laporan</th>
			<td class="isi-info"><?php echo $bt_laporan; ?></td>
		</tr>
	</table>

	<div style="margin-bottom: 7px;"></div>

	<?php 
		$sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
		$rows_pjl = mysqli_num_rows($sql_pjl);
		if($rows_pjl > 0) {
	?>

		<table class="data-penjualan" border="1">
			<tr>
				<th class="judul-kolom nomor">No</th>
				<th class="judul-kolom no-penjualan">No Penjualan</th>
				<th class="judul-kolom waktu-penjualan">Waktu</th>
				<th class="judul-kolom jenis-penjualan">Jenis</th>
				<th class="judul-kolom status-penjualan">Status</th>
				<th class="judul-kolom lunas-penjualan">Lunas</th>
				<th class="judul-kolom total-penjualan">Total</th>
			</tr>
			<?php 
				$no = 1;
				$total_semua = 0;
				while($data_pjl = mysqli_fetch_array($sql_pjl)) {
			?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td align="center"><?php echo $data_pjl['no_penjualan']; ?></td>
					<td align="center"><?php echo tgl_indo($data_pjl['tgl_penjualan']); ?> [<?php echo $data_pjl['jam_penjualan']; ?>]</td>
					<td align="center"><?php echo $data_pjl['metode_penjualan']; ?></td>
					<td align="center"><?php echo $data_pjl['status_penjualan']; ?></td>
					<td align="center"><?php echo $data_pjl['lunas_penjualan']; ?></td>
					<td align="right">Rp<?php echo number_format($data_pjl['total_penjualan']); ?></td>
				</tr>
			<?php 
					$total = $data_pjl['total_penjualan'];
					$total_semua = $total_semua + $total;
				} 
			?>
			<tr>
				<th colspan="6" align="left">Total</th>
				<th align="right">Rp<?php echo number_format($total_semua); ?></th>
			</tr>
		</table>

	<?php } ?>

</page>