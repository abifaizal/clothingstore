
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
  <?php 
    $tanggal_now = date('Y-m-d');
    $hari= substr($tanggal_now, 8, 2);
    $bulan = substr($tanggal_now, 5, 2);
    $tahun = substr($tanggal_now, 0, 4);

    $label_tgl = array();
    $data_total = array();
    
    for($i = 1; $i <= $hari; $i++) {
      $tgl_penjualan = $tahun."-".$bulan."-".$i;
      $label_tgl[] = tgl_grafik($tgl_penjualan);

      $qry = "SELECT IFNULL(SUM(total_penjualan), 0) AS total_pjl FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_penjualan'";
      $sql = mysqli_query($conn, $qry) or die ($conn->error);
      $data = mysqli_fetch_array($sql);
      $data_total[] = $data['total_pjl'];
    }
   ?>
  <div class="row">
    <div class="col-lg-5">
      <h5 align="center"><strong>Tabel Total Penjualan Bulan ini (<?=bulan_indo(date('m'))?>) per Hari</strong></h5>
      <table class="table table-bordered table-striped" id="example" style="font-size: 12px;">
        <thead>
          <tr>
            <td align="center"><strong>Tanggal</strong></td>
            <td align="center"><strong>Total Penjualan</strong></td>
          </tr>
        </thead>
        <tbody>
          <?php 
            for($i = 0; $i < count($data_total); $i++) {
           ?>
              <tr>
                <td><?=$label_tgl[$i]?></td>
                <td align="right">Rp<?=number_format($data_total[$i])?></td>
              </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="col-lg-7">
      <style>
        .canvas {
          padding: 20px;
          height: 350px;
          /*width: 90%;*/
        }
      </style>
      <div class="canvas">
        <canvas id="myChart">
        
        </canvas>
      </div>
    </div>
  </div>
</section>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: <?php echo json_encode($label_tgl); ?>,
          datasets: [{
              label: 'Grafik Total Penjualan Bulan ini per Hari',
              fill: false,
              // borderDash: [5, 5],
              data: <?php echo json_encode($data_total); ?>,
              backgroundColor: [
                  'rgba(0, 0, 255, 0.1)'
              ],
              borderColor: [
                  'rgba(0, 0, 255, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
</script>
<!-- /.content -->