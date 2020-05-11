<?php 
	$id_pengiriman = $_GET['id'];
	$query_pengiriman = "SELECT * FROM tbl_datapengiriman WHERE id_pengiriman = '$id_pengiriman'";
	$sql_pengiriman = mysqli_query($conn, $query_pengiriman) or die ($conn->error);
	$data = mysqli_fetch_array($sql_pengiriman);
 ?>
<section class="content-header">
  <h1>
    Halaman Form Edit Data Pengiriman
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li><a href="?page=data_transaksi_online">Data Penjualan Online</a></li>
    <li class="active">Form Edit Data Pengiriman</li>
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
    <form method="POST" id="form_editpengiriman" autocomplete="off" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box-body">
          	<div class="form-group">
              <label for="no_penjualan">Nomor Transaksi</label>
              <input type="hidden" name="id_pengiriman" id="id_pengiriman" value="<?php echo $id_pengiriman; ?>">
              <input type="text" class="form-control" name="no_penjualan" id="no_penjualan" value="<?php echo $data['no_penjualan']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="no_resi">Nomor Resi Pengiriman</label>
              <input type="text" class="form-control" name="no_resi" id="no_resi" autofocus="" placeholder="masukkan nomor resi" required="" value="<?php echo $data['no_resi']; ?>">
            </div>
            <div class="form-group">
              <label for="jasa_kirim">Jasa Pengirim</label>
              <input type="text" class="form-control" name="jasa_kirim" id="jasa_kirim" placeholder="Cth : JNE, Tiki, POS Indonesia, J&T Express, dll" required="" value="<?php echo $data['jasa_kirim']; ?>">
            </div>
            <div class="form-group">
              <label for="tgl_kirim">Tanggal Dikirim</label>
              <input type="date" class="form-control" name="tgl_kirim" id="no_tgl_kirimresi" required="" value="<?php echo $data['tgl_kirim']; ?>">
            </div>
            <div class="form-group">
              <label for="lama_pengiriman">Perkiraan Lama Pengiriman</label>
              <div class="input-group">
                <input type="text" class="form-control" name="lama_pengiriman" id="lama_pengiriman" placeholder="masukkan perkiraan lama pengiriman" required="" value="<?php echo $data['lama_kirim']; ?>">
                <span class="input-group-addon">Hari</span>
              </div>
            </div>
            <div class="form-group">
              <label for="catatan_kirim">Catatan <small>(biarkan kosong jika tidak diperlukan)</small></label>
              <textarea class="form-control" name="catatan_kirim" id="catatan_kirim" rows="3" placeholder="masukkan catatan untuk customer"><?php echo $data['catatan_kirim']; ?></textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-right">
            <!-- <button type="button" class="btn btn-success">Simpan</button> -->
            <input type="submit" name="simpan_formkirim" id="simpan_formkirim" class="btn btn-info" value="Simpan Perubahan">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->

</section>

<script>
	$("#form_editpengiriman").on("submit", function() {
		event.preventDefault();
		Swal.fire({
      title: 'Konfirmasi Perubahan',
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
		      url: "ajax/detail.php?page=ubah_pengiriman",
		      method: "POST",
		      data: new FormData(this),
		      contentType: false,
		      processData: false,
		      success:function(hasil) {
		      	Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Diubah',
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