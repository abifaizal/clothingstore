
<section class="content-header">
  <h1>
    Halaman Tambah Data Produk
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li><a href="?page=produk">Data Produk</a></li>
    <li class="active">Tambah Produk</li>
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
    <form method="POST" id="form_tmbproduk" autocomplete="off">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box-body">
            <div class="form-group">
              <label for="nama_prd">Nama Produk</label>
              <input type="text" class="form-control" name="nama_prd" id="nama_prd" placeholder="masukkan nama produk" required="">
            </div>
            <div class="form-group">
              <label for="kategori_prd">Kategori Produk</label>
              <select class="form-control" id="kategori_prd" name="kategori_prd" required="">
                <option>pilih kategori produk</option>
                <option>Kaus</option>
                <option>Kemeja</option>
                <option>Celana</option>
                <option>Jaket</option>
                <option>Sweater</option>
              </select>
            </div>
            <div class="form-group">
              <label for="berat_prd">Berat Produk</label>
              <div class="input-group">
                <input type="number" class="form-control" name="berat_prd" id="berat_prd" placeholder="masukkan harga produk" required="">
                <span class="input-group-addon">gram</span>
              </div>
            </div>
            <div class="form-group">
              <label for="harga_prd">Harga Pokok</label>
              <input type="number" class="form-control" name="harga_prd" id="harga_prd" placeholder="masukkan harga pokok produk" required="">
            </div>
            <div class="form-group">
              <label for="ukuran_prd">Ukuran Produk</label>
              <div id="kotak_barisukuran">
                <div class="row" style="margin-bottom: 5px;" id="baris_ukuran1">
                  <div class="col-xs-4">
                    <input type="text" class="form-control ukuran_prd" name="ukuran_prd[]" id="ukuran_prd1" placeholder="ukuran produk (M, 30, All Size)" required="">
                  </div>
                  <div class="col-xs-3">
                    <input type="number" class="form-control jml_ukuranprd" name="jml_ukuranprd[]" id="jml_ukuranprd1" placeholder="jumlah" required="">
                  </div>
                  <div class="col-xs-5">
                    <button type="button" class="btn btn-primary" id="tambah_ukuran">tambah</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="stok_prd">Jumlah Stok Keseluruhan</label>
              <input type="number" class="form-control" name="stok_prd" id="stok_prd" value="0" readonly="" required="">
            </div>
            <div class="form-group">
              <label for="deskripsi_prd">Deskripsi Produk</label>
              <textarea class="form-control" name="deskripsi_prd" id="deskripsi_prd" rows="3" placeholder="masukkan deskripsi produk (biarkan kosong jika tidak perlu)"></textarea>
            </div>
            <div class="form-group">
              <label for="gambar_prd">Gambar Produk</label>
              <input type="file" id="gambar_prd" name="gambar_prd" required="">
              <p class="help-block">max 2000kb (2mb)</p>
              <img id="blah" src="#" alt="" class="foto-pgw" style="max-width: 150px;"/>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-right">
            <!-- <button type="button" class="btn btn-success">Simpan</button> -->
            <input type="submit" name="simpan_produk" id="simpan_produk" class="btn btn-success" value="Simpan">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<script>
  var jml_stok = 0;
  var list = 1;
  $(document).on("click", "#tambah_ukuran", function() {
    list++;
    var baris = '';
    baris  = '<div class="row" style="margin-bottom: 5px;" id="baris_ukuran'+list+'">';
    baris += '<div class="col-xs-4">';
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
    var num = $("#jml_ukuranprd"+button_id+"").val();
    jml_stok -= parseInt(num);
    $("#baris_ukuran"+button_id+"").remove();
    $("#stok_prd").val(jml_stok);
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

  $("#form_tmbproduk").on("submit", function() {
    event.preventDefault();
    var data_form = $("#form_tmbproduk").serialize();
    var gbr = $("#gambar_prd").val();
    $.ajax({
      url: "ajax/simpan_produk.php",
      method: "POST",
      // data: data_form+"&gambar="+gbr,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success:function(data) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Data Berhasil Disimpan',
          type: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
        }).then((ok) => {
          if (ok.value) {
            location.reload();
          }
        })
      }
    })
    // alert(data_form+" / "+gbr);
  });
</script>