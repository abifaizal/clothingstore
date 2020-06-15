<?php 
	include '../koneksi.php';
	$no_penjualan = @$_GET['npjl'];
?>
<style>
	.tbl-qrcode-distro {
		width: 100%;
	}
	.kolom-qrcode {
		width: 25%;
	}
	.kolom-distro {
		/*width: 75%;*/
		text-align: center;
		font-size: 20px;
		font-weight: bold;
	}
	.alamat-distro {
		text-align: center;
		padding: 0 35px;
		font-size: 7px;
	}
	.tbl-nopenjualan {
		margin-top: 10px;
		font-weight: lighter;
		width: 100%;
	}
	.tbl-nopenjualan td {
		width: 50%;
	}
	.kolom-pgw {
		text-align: right;
	}
	.tbl-detailpenjualan {
		width: 100%;
		margin-top: 4px;
	}
	.tbl-detailpenjualan td {
		vertical-align: top;
		padding: 2px 0;
	}
	.tbl-detailpenjualan .judul {
		padding: 1px 0;
		border-bottom: 1px dashed;
	}
	.kolom-produk {
		width: 42%;
	}
	.kolom-harga {
		width: 24%;
		text-align: right;
	}
	.kolom-qty {
		width: 10%;
		text-align: center;
	}
	.kolom-subtotal {
		width: 24%;
		text-align: right;
	}
	.baris-total td {
		text-align: right;
	}
</style>

<page backleft="-10px" backright="-10px" backtop="-16px" backbottom="-16px" style="font-size: 8px;">
	<page_header></page_header>
	<page_footer style="text-align: center; font-size: 10px;">Terima Kasih</page_footer>
	
	<!-- <qrcode value="<?php echo $no_penjualan; ?>" ec="H" style="width: 20px; background-color: white; color: black;"></qrcode> -->
	<table class="tbl-qrcode-distro">
		<tr>
			<td class="kolom-qrcode">
				<qrcode value="<?php echo $no_penjualan; ?>" ec="H" style="width: 30px; background-color: white; color: black;"></qrcode>
			</td>
			<td class="kolom-distro">
				BLACK SHADOW
			</td>
		</tr>
	</table>

	<div class="alamat-distro">
		BlackShadow Merchandise Jln. Tentara No 17, Selatan Polres Kebumen. <br>
		Telp. 0896 0251 3757 <br>
	</div>
	
	<?php 
		$query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_pgw = tbl_pegawai.id_pgw WHERE tbl_penjualan.no_penjualan = '$no_penjualan' AND tbl_penjualan.metode_penjualan = 'Offline'";
		$sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
		$data_pjl = mysqli_fetch_array($sql_pjl);
	?>
	<table class="tbl-nopenjualan">
		<tr>
			<td class="kolom-nopenjualan">
				<?php echo $no_penjualan; ?>
			</td>
			<td class="kolom-pgw">
				<?php echo $data_pjl['username_pgw']; ?>
			</td>
		</tr>
		<tr>
			<td class="kolom-waktu">
				<?php echo $data_pjl['tgl_penjualan']; ?> [<?php echo $data_pjl['jam_penjualan']; ?>]
			</td>
		</tr>
	</table>

	<?php 
		$query_detailpjl = "SELECT *, tbl_penjualandetail.harga_prd AS harga_jual FROM tbl_penjualandetail INNER JOIN tbl_produk ON tbl_penjualandetail.id_prd = tbl_produk.id_prd INNER JOIN tbl_ukuranprd ON tbl_penjualandetail.id_ukuran = tbl_ukuranprd.id_ukuran WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
		$sql_detailpjl = mysqli_query($conn, $query_detailpjl) or die ($conn->error);
	?>
	<table class="tbl-detailpenjualan" border="0" style="border-collapse: collapse;">
		<tr>
			<td class="kolom-produk judul">Produk</td>
			<td class="kolom-harga judul">Harga</td>
			<td class="kolom-qty judul">Qty</td>
			<td class="kolom-subtotal judul">Subtotal</td>
		</tr>
		<?php 
			while($data_detail = mysqli_fetch_array($sql_detailpjl)) {
		?>
		<tr>
			<td class="kolom-produk">
				<?php echo $data_detail['nama_prd']; ?> <br>
				Ukuran : <?php echo $data_detail['keterangan_ukr']; ?>
			</td>
			<td class="kolom-harga">
				Rp<?php echo number_format($data_detail['harga_jual']); ?>
			</td>
			<td class="kolom-qty">
				<?php echo $data_detail['jml_prd']; ?>
			</td>
			<td class="kolom-subtotal">
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
			<td class="kolom-total" colspan="3">
				Total <?php if($diskon_penjualan > 0) { echo "+ diskon (".$diskon_penjualan."%)";} ?>
			</td>
			<td class="kolom-total nominal">
				Rp<?php echo number_format($total_penjualan); ?>
			</td>
		</tr>
		<tr class="baris-total">
			<td class="kolom-bayar" colspan="3">
				Bayar
			</td>
			<td class="kolom-bayar nominal">
				Rp<?php echo number_format($bayar_penjualan); ?>
			</td>
		</tr>
		<tr class="baris-total">
			<td class="kolom-kembalian" colspan="3">
				Kembalian
			</td>
			<td class="kolom-kembalian nominal">
				Rp<?php echo number_format($kembalian); ?>
			</td>
		</tr>
	</table>
</page>