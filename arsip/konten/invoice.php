<?php 
	include '../koneksi.php';
	$no_penjualan = @$_GET['npjl'];
?>
<style>
	.div-bagianatas {
		padding-bottom: 20px;
		border-bottom: 1px solid #A9A9A9;
	}
	.tabel-bagianatas {
		width: 100%;
	}
	.tabel-bagianatas td {
		width: 50%;
	}
	.div-bagiandua {
		padding: 20px 0;
	}
	.tabel-bagiandua {
		width: 100%;
	}
	.tabel-bagiandua .bill-to {
		width: 35%;
	}
	.tabel-bagiandua .no-transaksi {
		line-height: 1.5;
		text-align: right;
		width: 65%;
	}
	.div-barang {
		margin-bottom: 20px;
	}
	.tabel-barang {
		vertical-align: top;
		border-collapse: collapse;
		width: 100%;
	}
	.tabel-barang th {
		text-align: center;
		padding: 5px;
		background-color: #cfcfcf;
	}
	.tabel-barang td {
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
	.status {
		font-weight: bold;
	}
	.tabel-total {
		width: 100%;
	}
	.tabel-total td {
		/*width: 50%;*/
		text-align: right;
	}
	.tabel-total .judul {
		width: 70%;
	}
	.tabel-total .isi {
		width: 30%;
	}
	.total-akhir {
		padding: 5px 0;
		font-size: 14px;
	}
</style>

<page backleft="5px" backright="5px" backtop="10px" backbottom="30px" style="font-size: 12px; line-height: 1.3;">
	<page_header></page_header>
	<page_footer></page_footer>

	<div class="div-bagianatas">
		<table class="tabel-bagianatas">
			<tr>
				<td>
					Bill From :
				</td>
				<td rowspan="2" style="text-align: right;">
					<img src="../img/logo/blackshadowlogo.png" alt="" style="width: 70px;">
				</td>
			</tr>
			<tr>
				<td>
					<strong>Black Shadow Merch</strong> <br>
					Jln. Tentara No 17, Selatan Polres Kebumen<br>
					Kebumen, Jawa Tengah <br>
					Telp. 0896 0251 3757
				</td>
			</tr>
		</table>
	</div>
	<?php 
		$query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pelanggan ON tbl_penjualan.kode_plg = tbl_pelanggan.kode_plg INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan INNER JOIN tbl_datapengiriman ON tbl_penjualan.no_penjualan = tbl_datapengiriman.no_penjualan WHERE tbl_penjualan.no_penjualan = '$no_penjualan'";
		$sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
		$data_pjl = mysqli_fetch_array($sql_pjl);
			$total_pembayaran = $data_pjl['total_penjualan'] + $data_pjl['ongkir_paket'];
	?>
	<div class="div-bagiandua">
		<table class="tabel-bagiandua">
			<tr>
				<td class="bill-to">
					Bill To :
				</td>
				<td rowspan="2" class="no-transaksi">
					<b>No Transaksi</b> : <?php echo $no_penjualan; ?> <br>
					<b>Tgl Invoice</b> : <?php echo tgl_indo($data_pjl['tgl_penjualan']); ?> <br>
					<b>Total Pembayaran</b> : Rp<?php echo number_format($total_pembayaran); ?>
				</td>
			</tr>
			<tr>
				<td class="bill-to">
					<strong><?php echo $data_pjl['nama_penerima']; ?></strong> <br>
					<?php echo $data_pjl['alamat_penerima']; ?> <br>
					<?php echo $data_pjl['kabkota_penerima'].", ".$data_pjl['provinsi_penerima']; ?> <br>
					Kode Pos : <?php echo $data_pjl['kode_pos']; ?> <br>
					Telp : <?php echo $data_pjl['nohp_penerima']; ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="div-barang">
		<table class="tabel-barang" border="1">
			<tr>
				<th class="kolom-produk" align="left">Produk</th>
				<th class="kolom-harga">Harga</th>
				<th class="kolom-diskon">Diskon</th>
				<th class="kolom-qty">Qty</th>
				<th class="kolom-subtotal">Subtotal</th>
			</tr>
			<?php 
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
		</table>
	</div>
	
	<table style="width: 100%; vertical-align: top;">
		<tr>
			<td style="width: 50%;">
				<table>
					<tr>
						<td class="status">Status</td>
						<td class="status">: 
							<?php if($data_pjl['lunas_penjualan'] == "Lunas") { ?>
								 Lunas & Telah
							<?php 
								}
								echo $data_pjl['status_penjualan']; 
							?>

						</td>
					</tr>
				</table>
			</td>
			<td style="width: 50%;">
				<table class="tabel-total">
					<tr>
						<td class="judul">
							Subtotal
						</td>
						<td class="isi">
							Rp<?php echo number_format($data_pjl['total_penjualan']); ?>
						</td>
					</tr>
					<tr>
						<td>
							Ongkir
						</td>
						<td>
							Rp<?php echo number_format($data_pjl['ongkir_paket']); ?>
						</td>
					</tr>
					<tr>
						<td class="total-akhir">
							<b>Total Pembayaran</b>
						</td>
						<td class="total-akhir">
							<b style="background-color: #d9d9d9; font-style: italic;">Rp<?php echo number_format($total_pembayaran); ?></b>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</page>