<?php 
	$no_penjualan = $_GET['notransaksi'];
 ?>
<section class="content-header">
  <h1>
    Halaman Form Pengiriman
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li><a href="?page=data_transaksi_online">Data Penjualan Online</a></li>
    <li class="active">Form Pengiriman</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <a href="?page=data_transaksi_online">
        <button class="btn btn-primary btn-sm">
          Daftar Transaksi Online
        </button>
      </a>
    </div>
    <form method="POST" id="form_pengiriman" autocomplete="off" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box-body">
          	<div class="form-group">
              <label for="no_penjualan">Nomor Transaksi</label>
              <input type="text" class="form-control" name="no_penjualan" id="no_penjualan" value="<?php echo $no_penjualan; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="no_resi">Nomor Resi Pengiriman</label>
              <input type="text" class="form-control" name="no_resi" id="no_resi" autofocus="" placeholder="masukkan nomor resi" required="">
            </div>
            <div class="form-group">
              <label for="jasa_kirim">Jasa Pengirim</label>
              <input type="text" class="form-control" name="jasa_kirim" id="jasa_kirim" placeholder="Cth : JNE, Tiki, POS Indonesia, J&T Express, dll" required="">
            </div>
            <div class="form-group">
              <label for="tgl_kirim">Tanggal Dikirim</label>
              <input type="date" class="form-control" name="tgl_kirim" id="no_tgl_kirimresi" required="">
            </div>
            <div class="form-group">
              <label for="lama_pengiriman">Perkiraan Lama Pengiriman</label>
              <div class="input-group">
                <input type="text" class="form-control" name="lama_pengiriman" id="lama_pengiriman" placeholder="masukkan perkiraan lama pengiriman" required="">
                <span class="input-group-addon">Hari</span>
              </div>
            </div>
            <div class="form-group">
              <label for="catatan_kirim">Catatan <small>(biarkan kosong jika tidak diperlukan)</small></label>
              <textarea class="form-control" name="catatan_kirim" id="catatan_kirim" rows="3" placeholder="masukkan catatan untuk customer"></textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-right">
            <!-- <button type="button" class="btn btn-success">Simpan</button> -->
            <input type="submit" name="simpan_formkirim" id="simpan_formkirim" class="btn btn-success" value="Simpan">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->

</section>

<script>
	$("#form_pengiriman").on("submit", function() {
		event.preventDefault();
		Swal.fire({
      title: 'Konfirmasi',
      text: "anda yakin telah mengisi data dengan benar ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((ya) => {
      if (ya.value) {
        $.ajax({
		      url: "ajax/simpan_formkirim.php",
		      method: "POST",
		      data: new FormData(this),
		      contentType: false,
		      processData: false,
		      success:function(hasil) {
		      	Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Disimpan',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location = '?page=data_transaksi_online';
		          }
		        })
		      }
		    })
      }
    })
	})
</script>