<?php 
  $id_prd = @$_GET['id_prd'];
  $qry_produk = "SELECT * FROM tbl_produk WHERE id_prd = '$id_prd'";
  $sql_produk = mysqli_query($conn, $qry_produk) or die ($conn->error);
  $count = mysqli_num_rows($sql_produk);
  if($count>0) {
  $data_produk = mysqli_fetch_array($sql_produk);

  $gambar = $data_produk['gambar_prd'];
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Produk</li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $data_produk['nama_prd']; ?></li>
  </ol>
</nav>
<div class="row kontainer-produk">
  <div class="col-md-4">
    <div class="card">
      <img src="img/produk/<?php echo $gambar; ?>" class="card-img-top" alt="...">
    </div>
    <div class="row" style="margin-top: 5px;">
      <div class="col-6">
        <button type="button" class="btn btn-light btn-sm">
          <i class="fas fa-caret-square-left"></i>
        </button>
      </div>
      <div class="col-6" style="text-align: right;">
        <button type="button" class="btn btn-light btn-sm">
          <i class="fas fa-caret-square-right"></i>
        </button>
      </div>
    </div>
  </div>
  <div class="col-md-8 kotak-detail">
    <h4 class="halamanproduk-namaproduk"><?php echo $data_produk['nama_prd']; ?></h4>
    <form method="POST" id="form_beliproduk" enctype="multipart/form-data">
      <input type="hidden" name="id_prd" id="id_prd" value="<?php echo $id_prd; ?>">
      <input type="hidden" name="id_plg" id="id_plg" value="<?php echo $_SESSION['kode_plg']; ?>">
      <table class="table table-borderless">
          <tbody>
            <tr>
              <?php 
                $harga_prd = $data_produk['harga_prd'];
                $diskon_prd = $data_produk['diskon_prd'];
                $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
               ?>
              <td>Harga</td>
              <td>
                Rp <?php echo number_format($harga_akhir); ?>
                <?php if($data_produk['diskon_prd']) { ?>
                    <span style="font-size: 11px;">(<del><?php echo number_format($harga_prd); ?></del>)</span>
                    <?php } ?>
              </td>
            </tr>
            <tr>
              <td>Ukuran</td>
              <?php 
                $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND stok_ukr > 0";
                $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
               ?>
              <td>
              <?php 
                while($data_ukuran = mysqli_fetch_array($sql_ukuran)) {
                  echo "(".$data_ukuran['keterangan_ukr'].") ";
                }
               ?>
              </td>
            </tr>
            <tr>
              <td>Stok</td>
              <td id="stok_global"><?php echo $data_produk['stok_prd']; ?></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td><?php echo $data_produk['deskripsi_prd']; ?> (brt : <?php echo $data_produk['berat_prd']; ?>gr)</td>
            </tr>
            <tr>
              <td>Pilih Ukuran</td>
              <td>
                <select class="form-control form-control-sm col-4" id="pilih_ukuran" name="pilih_ukuran">
                  <option value="0" data-stok="<?php echo $data_produk['stok_prd']; ?>">Pilih</option>
                  <?php 
                    $query_ukuran2 = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND stok_ukr > 0";
                    $sql_ukuran2 = mysqli_query($conn, $query_ukuran2) or die ($conn->error);
                    while($data_ukuran2 = mysqli_fetch_array($sql_ukuran2)) {
                   ?>
                      <option value="<?php echo $data_ukuran2['id_ukuran']; ?>" data-stok="<?php echo $data_ukuran2['stok_ukr']; ?>">
                        <?php echo $data_ukuran2['keterangan_ukr']; ?>
                      </option>
                   <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Jumlah</td>
              <td>
                <input class="form-control form-control-sm col-4" type="number" name="jml_beli" id="jml_beli" value="1">
              </td>
            </tr>
            <tr>
              <td>Total</td>
              <td id="total_harga">Rp <?php echo $harga_akhir; ?></td>
            </tr>
          </tbody>
      </table>
      <div class="tombol-tambah-keranjang">
        <input type="submit" class="btn btn-dark" style="font-size: 14px;" id="tmb_keranjang" value="Masukkan Keranjang">
      </div>
    </form>
  </div>
</div>
<style>
  .kontainer-ulasan-produk {
    /*margin-top: 20px;*/
    margin-bottom: 5px;
    font-size: 12px;
  }
  .kontainer-ulasan-balasan {
    margin-bottom: 2%;
  }
</style>
<hr>
<div class="kontainer-ulasan-produk">
  <h6><i class="fas fa-comment-alt"></i> Ulasan Produk</h6>
  <?php 
    $query_ulasan = "SELECT * FROM tbl_ulasan INNER JOIN tbl_penjualandetail ON tbl_ulasan.no_penjualan = tbl_penjualandetail.no_penjualan INNER JOIN tbl_pelanggan ON tbl_ulasan.kode_plg = tbl_pelanggan.kode_plg WHERE tbl_penjualandetail.id_prd = '$id_prd'";
    $sql_ulasan = mysqli_query($conn, $query_ulasan) or die ($conn->error);
    $jml_ulasan = mysqli_num_rows($sql_ulasan);
    if($jml_ulasan == 0) {
  ?>
  <div class="kontainer-belumada-ulasan">
    <i>(belum ada ulasan)</i>
  </div>
  <?php 
    }
    else {
      while($data_ulasan = mysqli_fetch_array($sql_ulasan)) {
  ?>
    <div class="kontainer-ulasan-balasan" style="display: ;">
      <div class="ulasan-pelanggan">
        <div class="card">
          <div class="card-header">
            <b><?php echo $data_ulasan['username_plg']; ?></b> - 
            <small id="waktu_ulasan_plg">
              <?php echo tgl_indo($data_ulasan['tgl_ulasan']); ?> [<?php echo $data_ulasan['jam_ulasan']; ?>]
            </small>
          </div>
          <div class="card-body">
            <h6 class="card-title" id="rating_ulasan_plg">
              <?php 
                $bintang = $data_ulasan['rating_ulasan'];
                for($i=0; $i<$bintang; $i++) {
              ?>
                  <i class="fas fa-star" style="color: #f5a82c;"></i>
              <?php 
                }
                for($i=0; $i<5-$bintang; $i++) {
              ?>
                  <i class="fas fa-star" style="color: #bab3a8;"></i>
              <?php } ?>
            </h6>
            <p class="card-text" id="kometar_ulasan_plg">
              <?php 
                if($data_ulasan['komentar_ulasan'] == "") { ?>
                  <small><i>(tidak ada komentar)</i></small>
              <?php 
                } 
                else {
                  echo $data_ulasan['komentar_ulasan'];
                }
              ?>
            </p>
          </div>
        </div>
      </div>
      <?php 
        if($data_ulasan['status_balasan'] == "Ada") {
          $no_penjualan = $data_ulasan['no_penjualan'];
          $query_balasan = "SELECT * FROM tbl_balasan WHERE no_penjualan = '$no_penjualan'";
          $sql_ulasan = mysqli_query($conn, $query_balasan) or die ($conn->error);
          $data_balasan = mysqli_fetch_array($sql_ulasan);
      ?>
          <div class="balasan-ulasan" id="balasan-ulasan" style="margin-top: 10px; margin-left: 1%; padding-left: 3%; border-left: 2px solid #DCDCDC;">
            <div class="card">
              <div class="card-header">
                <b>Blackshadow</b> - 
                <small id="waktu_balasan">
                  <?php echo tgl_indo($data_balasan['tgl_balasan']); ?> [<?php echo $data_balasan['jam_balasan']; ?>]
                </small>
              </div>
              <div class="card-body">
                <p class="card-text" id="komentar_balasan">
                  <?php echo $data_balasan['komentar_balasan']; ?>
                </p>
              </div>
            </div>
          </div>
      <?php 
        }
      ?>
    </div>
  <?php 
      }
    } 
  ?>
</div>

<script>
  // alert('<?php echo $data_produk['nama_prd']; ?>');
  $("#pilih_ukuran").change(function() {
    var stok = $(this).find(':selected').data('stok')
    $("#stok_global").text(stok);
  })

  function total() {
    var harga = Number(<?php echo $harga_akhir; ?>);
    var jml_beli = Number($("#jml_beli").val());
    var total = harga * jml_beli;
    $("#total_harga").text("Rp "+total);
  }

  $("#jml_beli").change(function() {
    var jml_beli = Number($("#jml_beli").val());
    if(jml_beli<=0) {
      $("#jml_beli").val('1');
    }
    total();
  })
  $("#jml_beli").keyup(function() {
    var jml_beli = Number($("#jml_beli").val());
    if(jml_beli<=0) {
      $("#jml_beli").val('1');
    }
    total();
  })

  $("#form_beliproduk").on("submit", function() {
    event.preventDefault();
    <?php if(!@$_SESSION['username_plg']) { ?>
        Swal.fire({
          title: 'Maaf',
          text: 'Anda harus login terlebih dahulu untuk mengakses halaman keranjang',
          type: 'warning',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
        }).then((ok) => {
          if (ok.value) {
            $("#tmb_masuk").click();
          }
        })
    <?php } else { ?>
        var ukuran = $("#pilih_ukuran").val();
        var stok = Number($("#stok_global").text());
        var jml_beli = Number($("#jml_beli").val());
        if(ukuran == '0') {
          document.getElementById("pilih_ukuran").focus();
          Swal.fire(
            'Data Belum Lengkap',
            'maaf, tolong pilih ukuran',
            'warning'
          )
        } 
        else if(jml_beli>stok) {
          document.getElementById("jml_beli").focus();
          Swal.fire(
            'Data Belum Lengkap',
            'maaf, stok tidak mencukupi jumlah pembelian anda',
            'warning'
          )
        }
        else {
          // write your damn code here
          $.ajax({
            url: "usrajax/simpan_keranjang.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(hasil) {
              Swal.fire({
                title: 'Berhasil',
                text: 'Produk telah ditambahkan ke dalam keranjang',
                type: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((ok) => {
                if (ok.value) {
                  // location.reload();
                  // window.location='?page=keranjang';
                  window.location='./';
                }
              })
            }
          })
        }
    <?php } ?>
  })
</script>

<?php } else {
  echo "PAGE NOT FOUND";
} ?>