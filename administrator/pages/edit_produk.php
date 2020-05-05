<?php 
	$id_prd = $_GET['id_prd'];
  $qry_produk = "SELECT * FROM tbl_produk WHERE id_prd = '$id_prd'";
  $sql_produk = mysqli_query($conn, $qry_produk) or die ($conn->error);
  $data_produk = mysqli_fetch_array($sql_produk);
 ?>
<section class="content-header">
  <h1>
    Halaman Edit Data Produk
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li><a href="?page=produk">Data Produk</a></li>
    <li class="active">Edit Produk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <a href="?page=produk">
        <button class="btn btn-primary btn-sm">
          Daftar Produk
        </button>
      </a>
    </div>
    <form method="POST" id="form_editproduk" autocomplete="off" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box-body">
          	<div class="form-group">
              <label for="id_prd">Nama Produk</label>
              <input type="text" class="form-control" name="id_prd" id="id_prd" value="<?php echo $id_prd ?>" readonly="">
            </div>
            <div class="form-group">
              <label for="nama_prd">Nama Produk</label>
              <input type="text" class="form-control" name="nama_prd" id="nama_prd" value="<?php echo $data_produk['nama_prd'] ?>" placeholder="masukkan nama produk" required="">
            </div>
            <div class="form-group">
              <label for="kategori_prd">Kategori Produk</label>
              <select class="form-control" id="kategori_prd" name="kategori_prd" required="">
                <?php $kategori = $data_produk['kategori_prd']; ?>
                <option value="0" <?php if($kategori == '0') { echo "selected";} ?>>pilih kategori produk</option>
                <option value="Kaus" <?php if($kategori == 'Kaus') { echo "selected";} ?>>Kaus</option>
                <option value="Kemeja" <?php if($kategori == 'Kemeja') { echo "selected";} ?>>Kemeja</option>
                <option value="Celana" <?php if($kategori == 'Celana') { echo "selected";} ?>>Celana</option>
                <option value="Jaket" <?php if($kategori == 'Jaket') { echo "selected";} ?>>Jaket</option>
                <option value="Sweater" <?php if($kategori == 'Sweater') { echo "selected";} ?>>Sweater</option>
              </select>
            </div>
            <div class="form-group">
              <label for="berat_prd">Berat Produk</label>
              <div class="input-group">
                <input type="number" class="form-control" name="berat_prd" id="berat_prd" placeholder="masukkan harga produk" value="<?php echo $data_produk['berat_prd'] ?>" required="">
                <span class="input-group-addon">gram</span>
              </div>
            </div>
            <div class="form-group">
              <label for="harga_prd">Harga Pokok</label>
              <input type="number" class="form-control" name="harga_prd" id="harga_prd" placeholder="masukkan harga pokok produk" value="<?php echo $data_produk['harga_prd'] ?>" required="">
            </div>
            <div class="form-group">
              <label for="diskon_prd">Diskon Harga Produk</label>
              <div class="input-group">
                <input type="number" class="form-control" name="diskon_prd" id="diskon_prd" placeholder="masukkan harga produk" value="<?php echo $data_produk['diskon_prd'] ?>" required="">
                <span class="input-group-addon">%</span>
              </div>
            </div>
            <div class="form-group">
              <label for="ukuran_prd">Ukuran Produk</label>
              <div id="kotak_barisukuran">
                <?php 
                  $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd'";
                  $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
                  $count = mysqli_num_rows($sql_ukuran);
                  $i = 1;
                  while($data_ukuran = mysqli_fetch_array($sql_ukuran)) {
                    if($i == 1) {
                ?>
                      <div class="row" style="margin-bottom: 5px;" id="baris_ukuran1">
                        <div class="col-xs-4">
                          <input type="hidden" name="idukuran_prd[]" id="idukuran_prd<?php echo $i; ?>" value="<?php echo $data_ukuran['id_ukuran'] ?>">
                          <input type="text" class="form-control ukuran_prd" name="ukuran_prd[]" id="ukuran_prd1" placeholder="ukuran produk (M, 30, All Size)" required="" value="<?php echo $data_ukuran['keterangan_ukr'] ?>" readonly>
                        </div>
                        <div class="col-xs-3">
                          <input type="number" class="form-control jml_ukuranprd" name="jml_ukuranprd[]" id="jml_ukuranprd1" placeholder="jumlah" required="" value="<?php echo $data_ukuran['stok_ukr'] ?>">
                        </div>
                        <div class="col-xs-5">
                          <button type="button" class="btn btn-primary" id="tambah_ukuran">tambah</button>
                        </div>
                      </div>
                <?php
                    } else {
                ?>
                      <div class="row" style="margin-bottom: 5px;" id="baris_ukuran<?php echo $i; ?>">
                        <div class="col-xs-4">
                          <input type="hidden" name="idukuran_prd[]" id="idukuran_prd<?php echo $i; ?>" value="<?php echo $data_ukuran['id_ukuran'] ?>">
                          <input type="text" class="form-control ukuran_prd" name="ukuran_prd[]" id="ukuran_prd<?php echo $i; ?>" placeholder="ukuran produk (M, 30, All Size)" required="" value="<?php echo $data_ukuran['keterangan_ukr'] ?>" readonly>
                        </div>
                        <div class="col-xs-3">
                          <input type="number" class="form-control jml_ukuranprd" name="jml_ukuranprd[]" id="jml_ukuranprd<?php echo $i; ?>" placeholder="jumlah" required="" value="<?php echo $data_ukuran['stok_ukr'] ?>">
                        </div>
                        <div class="col-xs-5">
                          <!-- <button type="button" class="btn btn-danger kurang_ukuran" id="<?php echo $i; ?>"><i class="fa fa-minus"></i></button> -->
                        </div>
                      </div>
                <?php
                    }
                    $i++;
                  }
                  $i--;
                 ?>
              </div>
            </div>
            <div class="form-group">
              <label for="stok_prd">Jumlah Stok Keseluruhan</label>
              <input type="number" class="form-control" name="stok_prd" id="stok_prd" value="<?php echo $data_produk['stok_prd']; $jml_stok = $data_produk['stok_prd']; ?>" readonly="" placeholder="0" required="">
            </div>
            <div class="form-group">
              <label for="deskripsi_prd">Deskripsi Produk</label>
              <textarea class="form-control" name="deskripsi_prd" id="deskripsi_prd" rows="3" placeholder="masukkan deskripsi produk (biarkan kosong jika tidak perlu)"><?php echo $data_produk['deskripsi_prd'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="gambar_prd">Gambar Produk</label>
              <input type="file" id="gambar_prd" name="gambar_prd">
              <p class="help-block">max 2000kb (2mb)</p>
              <img id="blah" src="../img/produk/<?php echo $data_produk['gambar_prd'] ?>" alt="" class="foto-pgw" style="max-width: 150px;"/>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-right">
            <!-- <button type="button" class="btn btn-success">Simpan</button> -->
            <input type="submit" name="edit_produk" id="edit_produk" class="btn btn-success" value="Simpan">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<script>
  var jml_stok = <?php echo $jml_stok; ?>;
  var list = <?php echo $i; ?>;
  $(document).on("click", "#tambah_ukuran", function() {
    list++;
    var baris = '';
    baris  = '<div class="row" style="margin-bottom: 5px;" id="baris_ukuran'+list+'">';
    baris += '<div class="col-xs-4">';
    baris += '<input type="hidden" name="idukuran_prd[]" id="idukuran_prd'+list+'" value="baru">'
    baris += '<input type="text" class="form-control ukuran_prd" name="ukuran_prd[]" id="ukuran_prd'+list+'" placeholder="ukuran produk (M, 30, All Size)" required=""></div>';
    baris += '<div class="col-xs-3">';
    baris += '<input type="number" class="form-control jml_ukuranprd" name="jml_ukuranprd[]" id="jml_ukuranprd'+list+'" placeholder="jumlah" required=""></div>';
    baris += '<div class="col-xs-5">';
    baris += '<button type="button" class="btn btn-danger kurang_ukuran" id="'+list+'"><i class="fa fa-minus"></i></button>';
    baris += '</div>';
    // $("#tambah_ukuran").remove();
    $("#kotak_barisukuran").append(baris);
  })

  $(document).on("click", ".kurang_ukuran", function() {
    var button_id = $(this).attr("id");
    var num = Number($("#jml_ukuranprd"+button_id+"").val());
    if(num != "" && num > 0) {
      jml_stok -= num;
      $("#stok_prd").val(jml_stok);
    }
    $("#baris_ukuran"+button_id+"").remove();
  })

  var total = function() {
    var sum = 0;
    $('.jml_ukuranprd').each(function() {
      var num = $(this).val();

      if(num > 0) {
        sum += parseInt(num);
      }
    });
    $("#stok_prd").val(sum);
    jml_stok = sum;
  }

  $(document).on("keyup", ".jml_ukuranprd", function() {
    total();
  })

  $(document).on("change", ".jml_ukuranprd", function() {
    total();
  })

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    };
  };
  $("#gambar_prd").change(function() {
    readURL(this);
  });

  // $(document).on("click", '#reset_form', function() {
  //     $("#blah").attr('src', '');
  // });

  // $(document).on("click", '#tombol_tambah', function() {
  //     $("#blah").attr('src', '');
  // });

  $("#form_editproduk").on("submit", function() {
    event.preventDefault();
    $.ajax({
      url: "ajax/proses_edit_produk.php",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      processData: false,
      success:function(data) {
        window.location='?page=produk';
      }
    })
    // alert();
  });
</script>