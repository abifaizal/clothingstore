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
  <div class="col-lg-6 offset-lg-3">
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
