
<section class="content-header">
  <h1>
    Dashboard
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php 
    $query_dash = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Belum Bayar'";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_belumbayar = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Menunggu Verifikasi'";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_menungguverifikasi = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Verifikasi'";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_verifikasi = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Dikirim'";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_dikirim = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Selesai'";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_selesai = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_keranjang";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_keranjang = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_produk";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_produk = mysqli_num_rows($sql_pjl);

    $query_dash = "SELECT * FROM tbl_pelanggan";
    $sql_pjl = mysqli_query($conn, $query_dash) or die ($conn->error);
    $count_pelanggan = mysqli_num_rows($sql_pjl);
  ?>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=data_transaksi_online&tab=belumbayar">
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $count_belumbayar; ?></h3>
            <p>Transaksi Belum Bayar</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=data_transaksi_online&tab=verifikasi">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $count_menungguverifikasi; ?></h3>
            <p>Transaksi Menunggu Verifikasi</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=data_transaksi_online&tab=verifikasi">
        <div class="small-box bg-purple">
          <div class="inner">
            <h3><?php echo $count_verifikasi; ?></h3>
            <p>Transaksi Belum Dikirim</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=data_transaksi_online&tab=dikirim">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php echo $count_dikirim; ?></h3>
            <p>Transaksi dalam Proses Pengiriman</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=data_transaksi_online&tab=selesai">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $count_selesai; ?></h3>
            <p>Transaksi Selesai</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=data_keranjang">
        <div class="small-box bg-navy">
          <div class="inner">
            <h3><?php echo $count_keranjang; ?></h3>
            <p>Keranjang Aktif</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=produk">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $count_produk; ?></h3>
            <p>Jumlah Produk Saat ini</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <a href="?page=pelanggan">
        <div class="small-box" style="background-color: #222D32;">
          <div class="inner" style="color: #FFFFFF;">
            <h3><?php echo $count_pelanggan; ?></h3>
            <p>Jumlah Pelanggan Online</p>
          </div>
        </div>
      </a>
    </div>
    <!-- ./col -->
  </div>

</section>
<!-- /.content -->