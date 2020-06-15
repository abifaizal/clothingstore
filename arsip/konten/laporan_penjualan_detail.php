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
	.info-laporan, .data-penjualan, .data-produk {
		vertical-align: top;
	}
	.div-data-penjualan {
		margin: 16px 0 6px 0;
	}
	.data-penjualan, .data-produk {
		border-collapse: collapse;
		width: 100%;
		min-width: 100%;
		max-width: 100%;
	}
	.data-penjualan td {
		width: 21%;
		padding: 3px;
	}
	.data-produk th {
		text-align: center;
	}
	.data-produk th, .data-produk td {
		padding: 3px;
	}
	.indeks-nomor {
		width: 4%;
	}
	.kolom-produk {
		width: 42%;
	}
	.kolom-harga {
		width: 19%;
	}
	.kolom-diskon {
		width: 10%;
	}
	.kolom-qty {
		width: 10%;
	}
	.kolom-subtotal {
		width: 19%;
	}
	.baris-total td {
		text-align: right;
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

	<!-- <div style="margin-bottom: 0px;">---------------------------------------------------------</div> -->

	<?php 
		$sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
		$rows_pjl = mysqli_num_rows($sql_pjl);
		if($rows_pjl > 0) {
			$no = 1;
			$total_semua = 0;
			while($data_pjl = mysqli_fetch_array($sql_pjl)) {
	?>
		<div class="tes">
		<div class="div-data-penjualan">
			<table class="data-penjualan" border="0">
				<tr>
					<td rowspan="2" class="indeks-nomor"><?php echo $no++; ?></td>
					<td>
						<?php echo $data_pjl['no_penjualan']; ?>
					</td>
					<td>
						<?php echo tgl_indo($data_pjl['tgl_penjualan']); ?> [<?php echo $data_pjl['jam_penjualan']; ?>]
					</td>
					<td>
						<?php echo $data_pjl['lunas_penjualan']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $data_pjl['metode_penjualan']; ?>
					</td>
					<td>
						<?php echo $data_pjl['status_penjualan']; ?>
					</td>
				</tr>
			</table>
		</div>
		<table class="data-produk" border="1">
			<tr>
				<th class="kolom-produk">Produk</th>
				<th class="kolom-harga">Harga</th>
				<th class="kolom-diskon">Diskon</th>
				<th class="kolom-qty">Qty</th>
				<th class="kolom-subtotal">Subtotal</th>
			</tr>
			<?php 
				$no_penjualan = $data_pjl['no_penjualan'];
				$query_detailpjl = "SELECT *, tbl_penjualandetail.harga_prd AS harga_jual, tbl_penjualandetail.diskon_prd AS diskon_jual FROM tbl_penjualandetail INNER JOIN tbl_produk ON tbl_penjualandetail.id_prd = tbl_produk.id_prd INNER JOIN tbl_ukuranprd ON tbl_penjualandetail.id_ukuran = tbl_ukuranprd.id_ukuran WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
				$sql_detailpjl = mysqli_query($conn, $query_detailpjl) or die ($conn->error);
				while($data_detail = mysqli_fetch_array($sql_detailpjl)) {
			?>
				<tr>
					<td class="kolom-produk">
						<?php echo $data_detail['nama_prd']; ?> <br>
						Ukuran : <?php echo $data_detail['keterangan_ukr']; ?>
					</td>
					<td class="kolom-harga" align="right">
						Rp<?php echo number_format($data_detail['harga_jual']); ?>
					</td>
					<td class="kolom-diskon" align="center">
						<?php echo $data_detail['diskon_jual']; ?>%
					</td>
					<td class="kolom-qty" align="center">
						<?php echo $data_detail['jml_prd']; ?>
					</td>
					<td class="kolom-subtotal" align="right">
						Rp<?php echo number_format($data_detail['subtotal_prd']); ?>
					</td>
				</tr>
			<?php } ?>
			<?php 
				$total_penjualan = $data_pjl['total_penjualan'];
				$bayar_penjualan = $data_pjl['bayar_penjualan'];
				$diskon_penjualan = $data_pjl['diskon_penjualan'];
				$kembalian = $bayar_penjualan - $total_penjualan;
			?>
			<tr class="baris-total">
				<td class="kolom-total" colspan="4">
					Total <?php if($diskon_penjualan > 0) { echo "+ diskon (".$diskon_penjualan."%)";} ?>
				</td>
				<td class="kolom-total nominal">
					Rp<?php echo number_format($total_penjualan); ?>
				</td>
			</tr>
		</table>
	</div> <!-- div tes -->
	<?php
				$total_semua = $data_pjl['total_penjualan'] + $total_semua; 
			} 
		} 
	?>
	
	<div style="margin-top: 30px; background-color: #dbdbdb; padding: 5px 2px; font-weight: bold; font-size: 16px; text-align: right; font-style: italic;">
		Total : Rp<?php echo number_format($total_semua); ?>
	</div>

</page>