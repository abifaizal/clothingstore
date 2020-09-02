<?php 
	$no_penjualan = @$_GET['nopenjualan'];
	$kode_plg = @$_SESSION['kode_plg'];
	$query_cekpjl = "SELECT no_penjualan, status_penjualan FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND kode_plg = '$kode_plg' AND no_penjualan = '$no_penjualan'";
	$sql_cekpjl = mysqli_query($conn, $query_cekpjl) or die ($conn->error);
  $rows = mysqli_num_rows($sql_cekpjl);
	if($no_penjualan != '' && $rows > 0) {
		$data_pjl = mysqli_fetch_array($sql_cekpjl);
 ?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="?page=datatransaksi">Data Transaksi</a></li>
		<li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
	</ol>
</nav>

<div class="kontainer-pembayaran">
	<div>
		<style>
			.kode-transaksi {
				font-size: 14px;
			}
			.kode-transaksi th, .kode-transaksi td {
				padding: 0 15px 5px 0;
			}
		</style>
		<table class="kode-transaksi">
			<tr>
				<th>Kode Transaksi</th>
				<td><?php echo $no_penjualan; ?></td>
			</tr>
			<tr>
				<th>Status Penjualan</th>
				<td>
					<span class="badge <?php if($data_pjl['status_penjualan'] == 'Belum Bayar') {
						echo 'badge-warning';
					} else if($data_pjl['status_penjualan'] == 'Menunggu Verifikasi') {
						echo 'badge-secondary';
					} else if($data_pjl['status_penjualan'] == 'Verifikasi') {
						echo 'badge-dark';
					} else if($data_pjl['status_penjualan'] == 'Dikirim') {
						echo 'badge-primary';
					} else if($data_pjl['status_penjualan'] == 'Selesai') {
						echo 'badge-success';
					} ?>">
						<?php echo $data_pjl['status_penjualan']; ?>
					</span>
				</td>
			</tr>
		</table>
	</div>
	<table class="table detail-order table-bordered">
		<thead>
			<tr>
				<th colspan="2">Produk</th>
				<th>Qty</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query_pjldetail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
	  	$sql_pjldetail = mysqli_query($conn, $query_pjldetail) or die ($conn->error);
	  	$total_belanja = 0;
	  	while($data_pjldetail = mysqli_fetch_array($sql_pjldetail)) {
		 ?>
			<tr>
				<td>
		      <img src="img/produk/<?php echo $data_pjldetail['gambar_prd']; ?>" class="card-img-top" alt="..." style="width: 60px;">
				</td>
				<?php 
					$total_belanja = $total_belanja + $data_pjldetail['subtotal_prd'];
					$id_prd = $data_pjldetail['id_prd'];
          $id_ukuran = $data_pjldetail['id_ukuran'];
          $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
          $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
          $data_ukuran = mysqli_fetch_array($sql_ukuran);
				 ?>
				<td>
					<?php echo $data_pjldetail['nama_prd']; ?> <br>
					Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
					Harga : Rp <?php echo $data_pjldetail['harga_prd']; ?>
				</td>
				<td>
					<?php echo $data_pjldetail['jml_prd']; ?>
				</td>
				<td>
					Rp. <?php echo $data_pjldetail['subtotal_prd']; ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
		<tr>
			<th colspan="3">
				Total Belanja
			</th>
			<th>
				Rp <?php echo $total_belanja; ?>
			</th>
		</tr>
	</table>

	<div class="kontainer-tabelpenerima">
		<?php 
			$query_penerima = "SELECT * FROM tbl_datapenerima WHERE no_penjualan = '$no_penjualan'";
	  	$sql_penerima = mysqli_query($conn, $query_penerima) or die ($conn->error);
	  	$data_penerima = mysqli_fetch_array($sql_penerima);
		?>
		<h6 style="padding-left: 5px">Data Penerima</h6>
		<table class="table penerima table-borderless">
			<tr>
				<td width="26%">Nama Penerima</td>
				<td><?php echo $data_penerima['nama_penerima']; ?></td>
			</tr>
			<tr>
				<td>Telp</td>
				<td><?php echo $data_penerima['nohp_penerima']; ?></td>
			</tr>
			<tr>
				<td>Alamat Lengkap</td>
				<td><?php echo $data_penerima['alamat_penerima']; ?></td>
			</tr>
			<tr>
				<td>Kota / Kabupaten</td>
				<td><?php echo $data_penerima['kabkota_penerima']; ?></td>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td><?php echo $data_penerima['provinsi_penerima']; ?></td>
			</tr>
			<tr>
				<td>Ongkir</td>
				<td>Rp <?php echo $data_penerima['ongkir_paket']; ?> (<?php echo strtoupper($data_penerima['kurir_pengiriman']); ?> Paket <?php echo $data_penerima['paket_pengiriman']; ?>)</td>
			</tr>
			<tr>
				<?php 
					$total_akhir = $total_belanja + $data_penerima['ongkir_paket'];
				 ?>
				<td>Total Akhir dan Ongkir</td>
				<th>Rp <?php echo $total_akhir; ?></th>
			</tr>
		</table>
	</div>

  <div class="kontainer-tabelpenerima">
  	<?php 
  		$query_buktitrans = "SELECT * FROM tbl_buktitransfer WHERE no_penjualan = '$no_penjualan'";
  		$sql_buktitrans = mysqli_query($conn, $query_buktitrans) or die ($conn->error);
  		$data_bukti = mysqli_fetch_array($sql_buktitrans);
  	?>
  	<h6 style="padding-left: 5px">Data Transfer</h6>
		<table class="table penerima table-borderless">
			<tr>
				<td width="26%">Nama Pengirim</td>
				<td><?php echo $data_bukti['nama_pengirim']; ?></td>
			</tr>
			<tr>
				<td>Tgl Transfer</td>
				<td><?php echo $data_bukti['tgl_transfer']; ?></td>
			</tr>
			<tr>
				<td>Waktu Transfer</td>
				<td><?php echo $data_bukti['jam_transfer']; ?></td>
			</tr>
			<tr>
				<td>Bank</td>
				<td><?php echo $data_bukti['bank_transfer']; ?></td>
			</tr>
			<tr>
				<td>Bukti Transfer</td>
				<td style="height: auto;">
					<div class="foto-produk" style="max-width: 150px;">
		        <img src="img/bukti_transfer/<?php echo $data_bukti['foto_bukti']; ?>" class="card-img-top" alt="...">
		      </div>
				</td>
			</tr>
		</table>
		<?php if ($data_pjl['status_penjualan'] == "Menunggu Verifikasi") { ?>
		<div style="text-align: right; padding: 5px;">
			<button style="font-size: 10px;" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal_ubahdatatrans" id="tmb_ubahdatatrans">
				ubah
			</button>
		</div>
		<?php } ?>
  </div>

	<?php 
		if ($data_pjl['status_penjualan'] == "Dikirim" || $data_pjl['status_penjualan'] == "Selesai") {
	?>
	<div class="kontainer-tabelpenerima">
		<?php 
			$query_pengiriman = "SELECT * FROM tbl_datapengiriman WHERE no_penjualan = '$no_penjualan'";
	  	$sql_pengiriman = mysqli_query($conn, $query_pengiriman) or die ($conn->error);
	  	$data_pengiriman = mysqli_fetch_array($sql_pengiriman);
		?>
		<h6 style="padding-left: 5px">Data Pengiriman</h6>
		<table class="table penerima table-borderless">
			<tr>
				<td width="26%">Nomor Resi</td>
				<th><?php echo $data_pengiriman['no_resi']; ?></th>
			</tr>
			<tr>
				<td>Jasa Kurir</td>
				<td><?php echo $data_pengiriman['jasa_kirim']; ?></td>
			</tr>
			<tr>
				<td>Tanggal Dikirim</td>
				<td><?php echo $data_pengiriman['tgl_kirim']; ?></td>
			</tr>
			<tr>
				<td>Lama Pengiriman</td>
				<td><?php echo $data_pengiriman['lama_kirim']; ?> Hari</td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td><?php echo $data_pengiriman['catatan_kirim']; ?></td>
			</tr>
		</table>
	</div>
	<?php } ?>
	<div style="padding-bottom: 10px; text-align: right;">
		<?php 
			if ($data_pjl['status_penjualan'] != "Belum Bayar") {
		?>
		<a href="arsip/?page=invoice&npjl=<?php echo $no_penjualan; ?>" target="_blank"><button type="button" class="btn btn-warning btn-sm" id="tmb_invoice" data-nopenjualan = "<?php echo $no_penjualan; ?>">Lihat Invoice</button></a>
		<?php } ?>
		<?php 
			if ($data_pjl['status_penjualan'] == "Dikirim") {
		?>
  	<button type="button" class="btn btn-primary btn-sm" id="tmb_konfirmasi" data-nopenjualan = "<?php echo $no_penjualan; ?>">Konfirmasi Produk Telah Diterima</button>
  	<?php } ?>
  </div>
	
</div>

<style>
	#close_modal span {
		font-size: 18px;
	}
	.modal-body .form-group label, .modal-body .form-group .form-control{
		font-size: 12px;
	}
</style>

<div class="modal fade modal_ubahdatatrans" id="modal_ubahdatatrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Ubah Data Transfer</h6>
        <button type="button" class="close" id="close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form method="POST" id="form_editpembayaran" autocomplete="off">
	      	<input type="hidden" id="no_penjualan" name="no_penjualan" value="<?php echo $no_penjualan; ?>">
	      	<input type="hidden" id="id_transfer" name="id_transfer" value="<?php echo $data_bukti['id_transfer']; ?>">
	        <div class="form-group">
	          <label for="nama_pengirim">Nama Pengirim <small>(sesuai bukti transfer)</small></label>
	          <input type="text" class="form-control form-control-sm" name="nama_pengirim" id="nama_pengirim" placeholder="cth: Budi Ramadhan" autofocus="" value="<?php echo $data_bukti['nama_pengirim']; ?>">
	        </div>
	        <div class="form-group">
	          <label for="tgl_transfer">Tanggal Transfer</label>
	          <input type="date" class="form-control form-control-sm" name="tgl_transfer" id="tgl_transfer" placeholder="cth: 24/04/2020" autofocus="" value="<?php echo $data_bukti['tgl_transfer']; ?>">
	        </div>
	        <div class="form-group">
	          <label for="jam_transfer">Waktu Transfer</label>
	          <input type="text" class="form-control form-control-sm" name="jam_transfer" id="jam_transfer" placeholder="cth: 22:11:37" autofocus="" value="<?php echo $data_bukti['jam_transfer']; ?>">
	        </div>
	        <div class="form-group">
	          <label for="bank_transfer">Bank</label>
	          <input type="text" class="form-control form-control-sm" name="bank_transfer" id="bank_transfer" placeholder="cth: BNI / Mandiri / BCA / BRI" autofocus="" value="<?php echo $data_bukti['bank_transfer']; ?>">
	        </div>
	        <div class="form-group">
	          <label for="bank_transfer">Bukti Tranfer <small>(foto/screenshot bukti transfer)</small> </label> <br>
	          <input type="file" id="bukti_transfer" name="bukti_transfer" style="font-size: 12px;">
	          <p class="help-block" style="font-size: 12px;">*pastikan foto dapat dibaca dengan jelas</p>
	          <img id="blah" src="img/bukti_transfer/<?php echo $data_bukti['foto_bukti']; ?>" alt="" class="foto-pgw" style="max-width: 150px;"/>
	        </div>
	        <div class="form-group" style="text-align: right;">
	          <input type="submit" class="btn btn-primary" name="edit_pembayaran" id="edit_pembayaran" value="Simpan Perubahan" style="font-size: 14px;">
	        </div>
	      </form>
      </div>
    </div>
  </div>
</div>

<script>
	function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    };
  };
  $("#bukti_transfer").change(function() {
    readURL(this);
  });

  $("#form_editpembayaran").on("submit", function() {
  	event.preventDefault();
  	var nama_pengirim = $("#nama_pengirim").val();
  	var tgl_transfer = $("#tgl_transfer").val();
  	var jam_transfer = $("#jam_transfer").val();
  	var bank_transfer = $("#bank_transfer").val();
  	// var bukti_transfer = document.getElementById("bukti_transfer").files.length;
  	
  	if(nama_pengirim == "") {
      document.getElementById("nama_pengirim").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi nama pengririm dengan benar',
        'warning'
      )
    }
    else if(tgl_transfer == "") {
      document.getElementById("tgl_transfer").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi tanggal transfer dengan benar',
        'warning'
      )
    }
    else if(jam_transfer == "") {
      document.getElementById("jam_transfer").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi waktu transfer dengan benar',
        'warning'
      )
    }
    else if(bank_transfer == "") {
      document.getElementById("bank_transfer").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi bank transfer dengan benar',
        'warning'
      )
    }
    else {
    	Swal.fire({
        title: 'Konfirmasi',
        text: 'anda yakin akan mengubah data pembayaran anda ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((simpan) => {
        if (simpan.value) {
          $.ajax({
            url: "usrajax/edit_konfirmasipembayaran.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
    				processData: false,
            success:function(data) {
              Swal.fire({
                title: 'Tunggu Verifikasi Kami',
                text: 'Terima kasih telah melakukan pembayaran, kami akan segera verifikassi pembayaran dan mengirim pesanan anda',
                type: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((ok) => {
                if (ok.value) {
                  // window.location='?page=datatransaksi';
                  // window.open("laporan/?page=nota_penjualan&no_pjl="+no_penjualan);
                  location.reload();
                  // alert('berhasil');
                }
              })
            }
          })
        }
      })
    }
  });

  $("#tmb_konfirmasi").on("click", function() {
  	var no_penjualan = $(this).data('nopenjualan');
  	Swal.fire({
	    title: 'Konfirmasi',
	    text: 'anda yakin telah menerima produk anda ? jika Ya maka transaksi akan dinyatakan selesai',
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    confirmButtonText: 'Ya'
	  }).then((selesai) => {
	    if (selesai.value) {
	      $.ajax({
          type: "GET",
          url: "usrajax/konfirmasi_selesai.php",
          data: "no_penjualan="+no_penjualan,
          success:function(konfirmasi) {
            Swal.fire({
              title: 'Berhasil',
              text: 'Transaksi ini telah dinyatakan selesai',
              type: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((ok) => {
              if (ok.value) {
                window.location = '?page=datatransaksi';
              }
            })
          }
        })
	    }
	  })
  })
</script>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>