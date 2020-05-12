<?php 
	$kode_plg = @$_SESSION['kode_plg'];
	if($kode_plg != '') {
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
  </ol>
</nav>
<style>
	.kotak-nav-pills {
		margin-top: -10px;
		margin-bottom: 10px;
	}
  ul.nav-pills{
    padding: 0px 0px;
      /*border-bottom: 1px solid #169BB0;*/
  }
  .nav-pills .nav-item{
    font-size: 12px;
    font-weight: lighter;
    padding-bottom: 5px;
    border-bottom: 1px solid #D9DADB;
    margin-right: 15px;
  }
  .nav-pills .nav-link{
    color: #000000;
  }
  .nav-pills .nav-link.active{
    background-color: #343A40;
  }
  .badge-status {
    padding: 5px;
  }
  .nav-pills .nav-item .nav-link {
  	font-size: 12px;
  }
  .nav-pills .nav-item {
  	margin-top: 10px;
  }
</style>
<div class="kontainer-transaksi">
	<?php 
		$query_pjl = "SELECT * FROM tbl_penjualan WHERE kode_plg = '$kode_plg' AND metode_penjualan = 'Online'";
    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
    $count_semua = mysqli_num_rows($sql_pjl);

    $query_pjl = "SELECT * FROM tbl_penjualan WHERE kode_plg = '$kode_plg' AND metode_penjualan = 'Online' AND status_penjualan = 'Belum Bayar'";
    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
    $count_belumbayar = mysqli_num_rows($sql_pjl);

    $query_pjl = "SELECT * FROM tbl_penjualan WHERE kode_plg = '$kode_plg' AND metode_penjualan = 'Online' AND (status_penjualan = 'Verifikasi' OR status_penjualan = 'Menunggu Verifikasi')";
    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
    $count_verifikasi = mysqli_num_rows($sql_pjl);

    $query_pjl = "SELECT * FROM tbl_penjualan WHERE kode_plg = '$kode_plg' AND metode_penjualan = 'Online' AND status_penjualan = 'Dikirim'";
    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
    $count_dikirim = mysqli_num_rows($sql_pjl);

    $query_pjl = "SELECT * FROM tbl_penjualan WHERE kode_plg = '$kode_plg' AND metode_penjualan = 'Online' AND status_penjualan = 'Selesai'";
    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
    $count_selesai = mysqli_num_rows($sql_pjl);
	?>
	<div class="kotak-nav-pills">
	  <ul class="nav nav-pills" id="pills-tab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="semua-tab" data-toggle="pill" href="#semua" role="tab" aria-controls="semua" aria-selected="true">Semua <sup>( <?php echo $count_semua; ?> )</sup></a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="belum_bayar-tab" data-toggle="pill" href="#belum_bayar" role="tab" aria-controls="belum_bayar" aria-selected="false">Belum Bayar <sup>( <?php echo $count_belumbayar; ?> )</sup></a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="verifikasi-tab" data-toggle="pill" href="#verifikasi" role="tab" aria-controls="verifikasi" aria-selected="false">Verifikasi Pembayaran <sup>( <?php echo $count_verifikasi; ?> )</sup></a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="dikirim-tab" data-toggle="pill" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim <sup>( <?php echo $count_dikirim; ?> )</sup></a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="selesai-tab" data-toggle="pill" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai <sup>( <?php echo $count_selesai; ?> )</sup></a>
		  </li>
		</ul>
	</div>

	<div class="tab-content" id="pills-tabContent">
		<!-- TAB TRANSAKSI SEMUA -->
	  <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
	  	<?php if($count_semua == 0) { ?>
    		<div class="transaksi-kosong">
	    		Tidak ada Transaksi Saat Ini
	    	</div>
    	<?php } else { ?>
    	<?php 
        $query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan WHERE tbl_penjualan.kode_plg = '$kode_plg' AND tbl_penjualan.metode_penjualan = 'Online'";
        $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
        while($data_pjl = mysqli_fetch_array($sql_pjl)) {
      ?>
      	<div>
      		<table class="table table-bordered" style="font-size: 12px;">
      			<thead>
      				<tr>
      					<th colspan="3">
      						Kode Transaksi : <?php echo $data_pjl['no_penjualan']; ?> 
      						<span class="badge <?php if($data_pjl['status_penjualan'] == 'Belum Bayar') {
      							echo 'badge-warning';
      						} else if($data_pjl['status_penjualan'] == 'Menunggu Verifikasi') {
      							echo 'badge-secondary';
      						} else if($data_pjl['status_penjualan'] == 'Verifikasi') {
      							echo 'badge-dark';
      						} else if($data_pjl['status_penjualan'] == 'Dikirim') {
      							echo 'badge-primary';
      						} else if($data_pjl['status_penjualan'] == 'Selesai') {
      							echo 'badge-success';
      						} ?>">
      							<?php echo $data_pjl['status_penjualan']; ?>
      						</span>
      					</th>
      					<th style="text-align: right;">Total : Rp <?php echo number_format($data_pjl['total_penjualan'] + $data_pjl['ongkir_paket']); ?></th>
      				</tr>
      			</thead>
      			<tbody>
      				<?php 
      					$no_penjualan = $data_pjl['no_penjualan'];
      					$query_detail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
      					$sql_detail = mysqli_query($conn, $query_detail) or die ($conn->error);
        				while($data_detail = mysqli_fetch_array($sql_detail)) {
      				?>
									<tr>
										<td width="15%">
					            <div class="foto-produk" style="max-width: 55px; max-height: 55px;">
					              <img src="img/produk/<?php echo $data_detail['gambar_prd']; ?>" class="card-img-top" alt="...">
					            </div>
					          </td>
					          <?php
					          	$id_prd = $data_detail['id_prd'];
          						$id_ukuran = $data_detail['id_ukuran'];
					          	$query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
						          $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
						          $data_ukuran = mysqli_fetch_array($sql_ukuran);
					          ?>
					          <td>
					          	<?php echo $data_detail['nama_prd']; ?> <br>
					          	Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
					          	Harga : Rp <?php echo number_format($data_detail['harga_prd']); ?>
					          </td>
					          <td>
					          	<?php echo $data_detail['jml_prd']; ?>
					          </td>
					          <td style="text-align: right;">
					          	Rp <?php echo number_format($data_detail['subtotal_prd']); ?>
					          </td>
									</tr>
      				<?php } ?>
      			</tbody>
      			<tfoot>
      				<tr>
      					<td colspan="4" style="text-align: right;">
                  <?php 
                    if($data_pjl['status_penjualan'] != 'Selesai') {
                  ?>
      						<button class="btn btn-sm btn-danger tmb-batal" style="font-size: 11px;">Batalkan</button>
                  <?php } ?>
      						<?php 
      							if($data_pjl['status_penjualan'] == 'Belum Bayar') {
      						?>
      						<a href="?page=pembayaran&nopenjualan=<?php echo $data_pjl['no_penjualan'] ?>">
      							<button class="btn btn-sm btn-success tmb-detailkonf" style="font-size: 11px;">Detail dan Konfirmasi Pembayaran</button>
      						</a>
      						<?php } else { ?>
      						<a href="?page=detailpembayaran&nopenjualan=<?php echo $data_pjl['no_penjualan'] ?>">
      							<button class="btn btn-sm btn-primary tmb-detailkonf" style="font-size: 11px;">Detail Transaksi</button>
      						</a>
      						<?php } ?>
      					</td>
      				</tr>
      			</tfoot>
      		</table>
      	</div>
    	<?php } }?>
    </div>

    <!-- TAB TRANSAKSI BELUM DIBAYAR -->
	  <div class="tab-pane fade" id="belum_bayar" role="tabpanel" aria-labelledby="belum_bayar-tab">
	  	<?php if($count_belumbayar == 0) { ?>
    		<div class="transaksi-kosong">
	    		Tidak ada Transaksi Saat Ini
	    	</div>
    	<?php } else { ?>
    	<?php 
        $query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan WHERE tbl_penjualan.kode_plg = '$kode_plg' AND tbl_penjualan.metode_penjualan = 'Online' AND tbl_penjualan.status_penjualan = 'Belum Bayar'";
        $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
        while($data_pjl = mysqli_fetch_array($sql_pjl)) {
      ?>
      	<div>
      		<table class="table table-bordered" style="font-size: 12px;">
      			<thead>
      				<tr>
      					<th colspan="3">Kode Transaksi : <?php echo $data_pjl['no_penjualan']; ?> <span class="badge badge-warning"><?php echo $data_pjl['status_penjualan']; ?></span></th>
      					<th style="text-align: right;">Total : Rp <?php echo number_format($data_pjl['total_penjualan'] + $data_pjl['ongkir_paket']); ?></th>
      				</tr>
      			</thead>
      			<tbody>
      				<?php 
      					$no_penjualan = $data_pjl['no_penjualan'];
      					$query_detail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
      					$sql_detail = mysqli_query($conn, $query_detail) or die ($conn->error);
        				while($data_detail = mysqli_fetch_array($sql_detail)) {
      				?>
									<tr>
										<td width="15%">
					            <div class="foto-produk" style="max-width: 55px; max-height: 55px;">
					              <img src="img/produk/<?php echo $data_detail['gambar_prd']; ?>" class="card-img-top" alt="...">
					            </div>
					          </td>
					          <?php
					          	$id_prd = $data_detail['id_prd'];
          						$id_ukuran = $data_detail['id_ukuran'];
					          	$query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
						          $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
						          $data_ukuran = mysqli_fetch_array($sql_ukuran);
					          ?>
					          <td>
					          	<?php echo $data_detail['nama_prd']; ?> <br>
					          	Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
					          	Harga : Rp <?php echo number_format($data_detail['harga_prd']); ?>
					          </td>
					          <td>
					          	<?php echo $data_detail['jml_prd']; ?>
					          </td>
					          <td style="text-align: right;">
					          	Rp <?php echo number_format($data_detail['subtotal_prd']); ?>
					          </td>
									</tr>
      				<?php } ?>
      			</tbody>
      			<tfoot>
      				<tr>
      					<td colspan="4" style="text-align: right;">
      						<button class="btn btn-sm btn-danger tmb-batal" style="font-size: 11px;">Batalkan</button>
      						<a href="?page=pembayaran&nopenjualan=<?php echo $data_pjl['no_penjualan'] ?>">
      							<button class="btn btn-sm btn-success tmb-detailkonf" style="font-size: 11px;">Detail dan Konfirmasi Pembayaran</button>
      						</a>
      					</td>
      				</tr>
      			</tfoot>
      		</table>
      	</div>
    	<?php } }?>
    </div>

    <!-- TAB TRANSAKSI VERIFIKASI -->
    <div class="tab-pane fade" id="verifikasi" role="tabpanel" aria-labelledby="verifikasi-tab">
    	<?php if($count_verifikasi == 0) { ?>
    		<div class="transaksi-kosong">
	    		Tidak ada Transaksi Saat Ini
	    	</div>
    	<?php } else { ?>
	  	<div class="alert alert-secondary" role="alert" style="font-size: 12px; padding: 6px 10px;">
			  <span class="badge badge-dark">verifikasi</span> artinya pembayaran anda telah diverifikasi dan pesanan akan segera dikirim
			</div>
			<?php 
        $query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan WHERE tbl_penjualan.kode_plg = '$kode_plg' AND tbl_penjualan.metode_penjualan = 'Online' AND (tbl_penjualan.status_penjualan = 'Verifikasi' OR tbl_penjualan.status_penjualan = 'Menunggu Verifikasi')";
        $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
        while($data_pjl = mysqli_fetch_array($sql_pjl)) {
      ?>
      	<div>
      		<table class="table table-bordered" style="font-size: 12px;">
      			<thead>
      				<tr>
      					<th colspan="3">
      						Kode Transaksi : <?php echo $data_pjl['no_penjualan']; ?> 
      						<span class="badge <?php if($data_pjl['status_penjualan'] == 'Menunggu Verifikasi') {
      							echo 'badge-secondary';
      						} else {
      							echo 'badge-dark';
      						} ?>">
      							<?php echo $data_pjl['status_penjualan']; ?>
      						</span>
      					</th>
      					<th style="text-align: right;">Total : Rp <?php echo number_format($data_pjl['total_penjualan'] + $data_pjl['ongkir_paket']); ?></th>
      				</tr>
      			</thead>
      			<tbody>
      				<?php 
      					$no_penjualan = $data_pjl['no_penjualan'];
      					$query_detail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
      					$sql_detail = mysqli_query($conn, $query_detail) or die ($conn->error);
        				while($data_detail = mysqli_fetch_array($sql_detail)) {
      				?>
									<tr>
										<td width="15%">
					            <div class="foto-produk" style="max-width: 55px; max-height: 55px;">
					              <img src="img/produk/<?php echo $data_detail['gambar_prd']; ?>" class="card-img-top" alt="...">
					            </div>
					          </td>
					          <?php
					          	$id_prd = $data_detail['id_prd'];
          						$id_ukuran = $data_detail['id_ukuran'];
					          	$query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
						          $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
						          $data_ukuran = mysqli_fetch_array($sql_ukuran);
					          ?>
					          <td>
					          	<?php echo $data_detail['nama_prd']; ?> <br>
					          	Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
					          	Harga : Rp <?php echo number_format($data_detail['harga_prd']); ?>
					          </td>
					          <td>
					          	<?php echo $data_detail['jml_prd']; ?>
					          </td>
					          <td style="text-align: right;">
					          	Rp <?php echo number_format($data_detail['subtotal_prd']); ?>
					          </td>
									</tr>
      				<?php } ?>
      			</tbody>
      			<tfoot>
      				<tr>
      					<td colspan="4" style="text-align: right;">
      						<button class="btn btn-sm btn-danger tmb-batal" style="font-size: 11px;">Batalkan</button>
      						<a href="?page=detailpembayaran&nopenjualan=<?php echo $data_pjl['no_penjualan'] ?>">
	      						<button class="btn btn-sm btn-primary" style="font-size: 11px;">Detail Transaksi</button>
	      					</a>
      					</td>
      				</tr>
      			</tfoot>
      		</table>
      	</div>
    	<?php 
    		}
    	} 
    	?>
    </div>

    <!-- TAB TRANSAKSI DIKIRM -->
    <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
    	<?php if($count_dikirim == 0) { ?>
    		<div class="transaksi-kosong">
	    		Tidak ada Transaksi Saat Ini
	    	</div>
    	<?php } else { ?>
  		<?php 
        $query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan WHERE tbl_penjualan.kode_plg = '$kode_plg' AND tbl_penjualan.metode_penjualan = 'Online' AND tbl_penjualan.status_penjualan = 'Dikirim'";
        $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
        while($data_pjl = mysqli_fetch_array($sql_pjl)) {
      ?>
        <div>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
                <th colspan="3">Kode Transaksi : <?php echo $data_pjl['no_penjualan']; ?> <span class="badge badge-primary"><?php echo $data_pjl['status_penjualan']; ?></span></th>
                <th style="text-align: right;">Total : Rp <?php echo number_format($data_pjl['total_penjualan'] + $data_pjl['ongkir_paket']); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no_penjualan = $data_pjl['no_penjualan'];
                $query_detail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
                $sql_detail = mysqli_query($conn, $query_detail) or die ($conn->error);
                while($data_detail = mysqli_fetch_array($sql_detail)) {
              ?>
                  <tr>
                    <td width="15%">
                      <div class="foto-produk" style="max-width: 55px; max-height: 55px;">
                        <img src="img/produk/<?php echo $data_detail['gambar_prd']; ?>" class="card-img-top" alt="...">
                      </div>
                    </td>
                    <?php
                      $id_prd = $data_detail['id_prd'];
                      $id_ukuran = $data_detail['id_ukuran'];
                      $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
                      $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
                      $data_ukuran = mysqli_fetch_array($sql_ukuran);
                    ?>
                    <td>
                      <?php echo $data_detail['nama_prd']; ?> <br>
                      Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
                      Harga : Rp <?php echo number_format($data_detail['harga_prd']); ?>
                    </td>
                    <td>
                      <?php echo $data_detail['jml_prd']; ?>
                    </td>
                    <td style="text-align: right;">
                      Rp <?php echo number_format($data_detail['subtotal_prd']); ?>
                    </td>
                  </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" style="text-align: right;">
                  <button class="btn btn-sm btn-danger tmb-batal" style="font-size: 11px;">Batalkan</button>
                  <a href="?page=detailpembayaran&nopenjualan=<?php echo $data_pjl['no_penjualan'] ?>">
                    <button class="btn btn-sm btn-primary tmb-detailkonf" style="font-size: 11px;">Detail Transaksi</button>
                  </a>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      <?php } ?>
    	<?php } ?>
    </div>

    <!-- TAB TRANSAKSI SELESAI -->
    <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
    	<?php if($count_selesai == 0) { ?>
    		<div class="transaksi-kosong">
	    		Tidak ada Transaksi Saat Ini
	    	</div>
    	<?php } else { ?>
    	<?php 
        $query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan WHERE tbl_penjualan.kode_plg = '$kode_plg' AND tbl_penjualan.metode_penjualan = 'Online' AND tbl_penjualan.status_penjualan = 'Selesai'";
        $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
        while($data_pjl = mysqli_fetch_array($sql_pjl)) {
      ?>
        <div>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
                <th colspan="3">Kode Transaksi : <?php echo $data_pjl['no_penjualan']; ?> <span class="badge badge-success"><?php echo $data_pjl['status_penjualan']; ?></span></th>
                <th style="text-align: right;">Total : Rp <?php echo number_format($data_pjl['total_penjualan'] + $data_pjl['ongkir_paket']); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no_penjualan = $data_pjl['no_penjualan'];
                $query_detail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
                $sql_detail = mysqli_query($conn, $query_detail) or die ($conn->error);
                while($data_detail = mysqli_fetch_array($sql_detail)) {
              ?>
                  <tr>
                    <td width="15%">
                      <div class="foto-produk" style="max-width: 55px; max-height: 55px;">
                        <img src="img/produk/<?php echo $data_detail['gambar_prd']; ?>" class="card-img-top" alt="...">
                      </div>
                    </td>
                    <?php
                      $id_prd = $data_detail['id_prd'];
                      $id_ukuran = $data_detail['id_ukuran'];
                      $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
                      $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
                      $data_ukuran = mysqli_fetch_array($sql_ukuran);
                    ?>
                    <td>
                      <?php echo $data_detail['nama_prd']; ?> <br>
                      Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
                      Harga : Rp <?php echo number_format($data_detail['harga_prd']); ?>
                    </td>
                    <td>
                      <?php echo $data_detail['jml_prd']; ?>
                    </td>
                    <td style="text-align: right;">
                      Rp <?php echo number_format($data_detail['subtotal_prd']); ?>
                    </td>
                  </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" style="text-align: right;">
                  <a href="?page=detailpembayaran&nopenjualan=<?php echo $data_pjl['no_penjualan'] ?>">
                    <button class="btn btn-sm btn-primary tmb-detailkonf" style="font-size: 11px;">Detail Transaksi</button>
                  </a>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      <?php } ?>
    	<?php } ?>
    </div>
	</div>
</div>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>