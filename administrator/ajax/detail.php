<?php 
  session_start();
  include "../../koneksi.php";

  if(@$_GET['page']=='keranjang')
  {
    $id_keranjang = @mysqli_real_escape_string($conn, $_GET['id_krj']);
    $query_krj = "SELECT * FROM tbl_keranjang INNER JOIN tbl_keranjangdetail ON tbl_keranjang.id_keranjang = tbl_keranjangdetail.id_keranjang INNER JOIN tbl_produk ON tbl_keranjangdetail.id_prd = tbl_produk.id_prd INNER JOIN tbl_ukuranprd ON tbl_keranjangdetail.id_ukuran = tbl_ukuranprd.id_ukuran WHERE tbl_keranjang.id_keranjang = '$id_keranjang'";
  	$sql_krj = mysqli_query($conn, $query_krj) or die ($conn->error);
  	$data = array();
  	$no = 1;

  	while($detail = mysqli_fetch_array($sql_krj)) {
  		$jml_prd = $detail['jml_prd'];
          $harga_prd = $detail['harga_prd'];
          $diskon_prd = $detail['diskon_prd'];
          $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
          $subtotal = $harga_akhir * $jml_prd;
          $harga_akhir = number_format($harga_akhir);
          $subtotal = number_format($subtotal);

  		$data2 = array('harga_akhir' => $harga_akhir, 'subtotal' => $subtotal);
  		$detail += $data2;

  		$data[] = $detail;
  	}
  	echo json_encode($data);
  }
  else if(@$_GET['page']=='penjualan')
  {
    $no_penjualan = @mysqli_real_escape_string($conn, $_GET['no_penjualan']);
    $query_pjl = "SELECT tbl_penjualandetail.jml_prd, FORMAT(tbl_penjualandetail.harga_prd, 0) AS harga_prd, tbl_penjualandetail.diskon_prd, tbl_penjualandetail.subtotal_prd, tbl_produk.nama_prd, tbl_produk.gambar_prd, tbl_ukuranprd.keterangan_ukr FROM tbl_penjualandetail INNER JOIN tbl_produk ON tbl_penjualandetail.id_prd = tbl_produk.id_prd INNER JOIN tbl_ukuranprd ON tbl_penjualandetail.id_ukuran = tbl_ukuranprd.id_ukuran WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
    $data = array();
    $no = 1;

    while($detail = mysqli_fetch_array($sql_pjl)) {
      // $jml_prd = $detail['jml_prd'];
      // $harga_prd = $detail['harga_prd'];
      // $diskon_prd = $detail['diskon_prd'];
      // $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
      // $subtotal = $harga_akhir * $jml_prd;
      // $harga_akhir = number_format($harga_akhir);
      // $subtotal = number_format($subtotal);

      // $data2 = array('harga_akhir' => $harga_akhir, 'subtotal' => $subtotal);
      // $detail += $data2;

      $data[] = $detail;
    }
    echo json_encode($data);
  }
  else if(@$_GET['page']=='transfer')
  {
    $no_penjualan = @mysqli_real_escape_string($conn, $_GET['no_penjualan']);
    $query_transfer = "SELECT * FROM tbl_buktitransfer WHERE no_penjualan = '$no_penjualan'";
    $sql_transfer = mysqli_query($conn, $query_transfer) or die ($conn->error);
    $data = array();

    $detail = mysqli_fetch_array($sql_transfer);
    $data[] = $detail;

    echo json_encode($data);
  }
  else if(@$_GET['page']=='ubahverifikasi')
  {
    $no_penjualan = @mysqli_real_escape_string($conn, $_GET['no_penjualan']);
    $query_ubahverifikasi = "UPDATE tbl_penjualan SET lunas_penjualan = 'Lunas', status_penjualan = 'Verifikasi' WHERE no_penjualan = '$no_penjualan'";
    mysqli_query($conn, $query_ubahverifikasi) or die ($conn->error);
  }
  else if(@$_GET['page']=='pengiriman')
  {
    $no_penjualan = @mysqli_real_escape_string($conn, $_GET['no_penjualan']);
    $query_pengiriman = "SELECT * FROM tbl_datapengiriman INNER JOIN tbl_pegawai ON tbl_datapengiriman.id_pgw = tbl_pegawai.id_pgw WHERE tbl_datapengiriman.no_penjualan = '$no_penjualan'";
    $sql_pengiriman = mysqli_query($conn, $query_pengiriman) or die ($conn->error);
    $data = array();

    $detail = mysqli_fetch_array($sql_pengiriman);
    $data[] = $detail;

    echo json_encode($data);
  }
  else if(@$_GET['page']=='ubah_pengiriman')
  {
    $id_pgw = $_SESSION['id_pgw'];
    $id_pengiriman = $_POST['id_pengiriman'];
    $no_resi = $_POST['no_resi'];
    $jasa_kirim = $_POST['jasa_kirim'];
    $tgl_kirim = $_POST['tgl_kirim'];
    $lama_pengiriman = $_POST['lama_pengiriman'];
    $catatan_kirim = $_POST['catatan_kirim'];

    $query_ubah = "UPDATE tbl_datapengiriman SET no_resi = '$no_resi', jasa_kirim = '$jasa_kirim', tgl_kirim = '$tgl_kirim', lama_kirim = '$lama_pengiriman', catatan_kirim = '$catatan_kirim', tgl_record = CURDATE(), id_pgw = '$id_pgw' WHERE id_pengiriman = '$id_pengiriman'";
    mysqli_query($conn, $query_ubah) or die ($conn->error);
  }
  else if(@$_GET['page']=='transaksi_selesai')
  {
    $no_penjualan = @mysqli_real_escape_string($conn, $_GET['no_penjualan']);
    $query_transaksiselesai = "UPDATE tbl_penjualan SET status_penjualan = 'Selesai' WHERE no_penjualan = '$no_penjualan'";
    mysqli_query($conn, $query_transaksiselesai) or die ($conn->error);
  }
?>