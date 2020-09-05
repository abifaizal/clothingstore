<?php 
	$kode_plg = @$_SESSION['kode_plg'];
	$no_penjualan = @$_GET['nopenjualan'];

	if($kode_plg != '' && $no_penjualan != '') {
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
  </ol>
</nav>
<div class="row kontainer-register">
  <div class="col-lg-5">
    <table class="table table-bordered" style="font-size: 10px">
      <thead>
        <tr>
          <th colspan="4">Kode Transaksi : <?=$no_penjualan?></th>
        </tr>
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
            <img src="img/produk/<?php echo $data_pjldetail['gambar_prd']; ?>" class="card-img-top" alt="..." style="width: 30px;">
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
    <div class="kontainer-tabelpenerima" style="font-size: 10px;">
      <?php 
        $query_penerima = "SELECT * FROM tbl_datapenerima WHERE no_penjualan = '$no_penjualan'";
        $sql_penerima = mysqli_query($conn, $query_penerima) or die ($conn->error);
        $data_penerima = mysqli_fetch_array($sql_penerima);
      ?>
      <table class="table penerima table-borderless" style="font-size: 10px;">
        <tr>
          <td>Nama Penerima</td>
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
  </div>
  <div class="col-lg-7">
    <div class="form-register">
      <h6>Tolong Lengkapi Form Berikut untuk Menkonfirmasi Pembayaran Anda</h6>
      <form method="POST" id="form_konfirmasipembayaran" autocomplete="off">
      	<input type="hidden" id="no_penjualan" name="no_penjualan" value="<?php echo $no_penjualan; ?>">
        <div class="form-group">
          <label for="nama_pengirim">Nama Pengirim <small>(sesuai bukti transfer)</small></label>
          <input type="text" class="form-control form-control-sm" name="nama_pengirim" id="nama_pengirim" placeholder="cth: Budi Ramadhan" autofocus="">
        </div>
        <div class="form-group">
          <label for="tgl_transfer">Tanggal Transfer</label>
          <input type="date" class="form-control form-control-sm" name="tgl_transfer" id="tgl_transfer" placeholder="cth: 24/04/2020" autofocus="">
        </div>
        <div class="form-group">
          <label for="jam_transfer">Waktu Transfer</label>
          <input type="text" class="form-control form-control-sm" name="jam_transfer" id="jam_transfer" placeholder="cth: 22:11:37" autofocus="">
        </div>
        <div class="form-group">
          <label for="bank_transfer">Bank</label>
          <input type="text" class="form-control form-control-sm" name="bank_transfer" id="bank_transfer" placeholder="cth: BNI / Mandiri / BCA / BRI" autofocus="">
        </div>
        <div class="form-group">
          <label for="bank_transfer">Bukti Tranfer <small>(foto/screenshot bukti transfer)</small> </label> <br>
          <input type="file" id="bukti_transfer" name="bukti_transfer">
          <p class="help-block">*pastikan foto dapat dibaca dengan jelas</p>
          <img id="blah" src="#" alt="" class="foto-pgw" style="max-width: 150px;"/>
        </div>
        <div class="form-group" style="text-align: right;">
          <input type="submit" class="btn btn-dark" name="submit_konfirmasi" id="submit_konfirmasi" value="Kirim Konfirmasi" style="font-size: 14px;">
        </div>
      </form>
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

  $("#form_konfirmasipembayaran").on("submit", function() {
  	event.preventDefault();
  	var nama_pengirim = $("#nama_pengirim").val();
  	var tgl_transfer = $("#tgl_transfer").val();
  	var jam_transfer = $("#jam_transfer").val();
  	var bank_transfer = $("#bank_transfer").val();
  	var bukti_transfer = document.getElementById("bukti_transfer").files.length;
  	
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
    else if(bukti_transfer == "") {
      document.getElementById("bukti_transfer").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lampirkan foto bukti transfer',
        'warning'
      )
    }
    else {
    	Swal.fire({
        title: 'Konfirmasi',
        text: 'apakah anda yakin telah mengisi data konfirmasi pembayaran dengan benar ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((simpan) => {
        if (simpan.value) {
          $.ajax({
            url: "usrajax/simpan_konfirmasipembayaran.php",
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
                  window.location='?page=datatransaksi';
                  // window.open("laporan/?page=nota_penjualan&no_pjl="+no_penjualan);
                  // location.reload();
                  // alert('berhasil');
                }
              })
            }
          })
        }
      })
    }
  });
</script>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>
