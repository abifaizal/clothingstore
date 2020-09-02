<!-- <div class="slide">
    <h1>Fashion as unique as you are.</h1>
  </div> -->
  <div class="jumbotron jumbotron-fluid">
    <h1 class="display-4">fashion as unique as you are.</h1>
  </div>
  <div class="produk-semua" id="produk_semua">
    <p class="judul">
      Produk - Kaus
    </p>
    <div class="row">
    <?php 
      $qry_produk = "SELECT * FROM tbl_produk WHERE kategori_prd = 'Kaus' ORDER BY kategori_prd DESC, nama_prd ASC";
      $sql_produk = mysqli_query($conn, $qry_produk) or die ($conn->error);
      while($data_produk = mysqli_fetch_array($sql_produk)) {
        $gambar = $data_produk['gambar_prd'];
    ?>
      <div class="col-6 col-md-3 kotak-produk">
        <div class="isi-kotak-produk">
          <div class="card card-home">
            <a href="?page=produk&id_prd=<?php echo $data_produk['id_prd']; ?>">
              <img src="img/produk/<?php echo $gambar; ?>" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
              <h5 class="card-title">
                <a href="?page=produk&id_prd=<?php echo $data_produk['id_prd']; ?>">
                  <?php echo $data_produk['nama_prd']; ?>
                </a>
              </h5>
              <div class="row">
                <div class="col-8">
                  <p class="card-text">
                    <?php 
                      $harga_prd = $data_produk['harga_prd'];
                      $diskon_prd = $data_produk['diskon_prd'];
                      $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
                     ?>
                    <span class="badge badge-harga"><i class="fas fa-tag"></i> <?php echo number_format($harga_akhir); ?></span> <br>
                    <?php if($data_produk['diskon_prd']) { ?>
                    <span style="font-size: 11px;"><del><?php echo number_format($data_produk['harga_prd']); ?></del> <?php echo number_format($data_produk['diskon_prd']); ?>% off</span>
                    <?php } ?>
                  </p>
                </div>
                <div class="col-4">
                  <p class="card-text" style="text-align: right;">
                    <a href="?page=produk&id_prd=<?php echo $data_produk['id_prd']; ?>" class="badge badge-warning" style="font-size: 14px;">Beli</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
  <div class="kontak" id="kontak">
    <p class="judul">
      <!-- Kontak Kami -->
    </p>
    <div class="detail-kontak">
      <div class="kotak-hubungi bg-light">
        <p class="ikon">
          <i class="fas fa-envelope"></i>
        </p>
        <h5>
          Hubungi Kami
        </h5>
        <p class="alamat">
          BlackShadow Merchandise Jln. Tentara No 17, Selatan Polres Kebumen. <br>
          Telp. 0896 0251 3757 <br>
          Buka  09:00 - 20:00
        </p>
        <div class="">
          <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.048143913743!2d109.66868731437532!3d-7.677973578133363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7ac9f104776c3d%3A0x6602891327cf4dae!2sBADUT%20DISTRO%20KEBUMEN!5e0!3m2!1sid!2sid!4v1583460698158!5m2!1sid!2sid" width="400" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
        </div>
      </div>
    </div>
  </div>