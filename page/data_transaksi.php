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
					            <img src="img/produk/<?php echo $data_detail['gambar_prd']; ?>" class="card-img-top" alt="..." style="width: 60px;">
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
                    if($data_pjl['status_penjualan'] != 'Verifikasi' && $data_pjl['status_penjualan'] != 'Dikirim' && $data_pjl['status_penjualan'] != 'Selesai') {
                  ?>
      						  <button class="btn btn-sm btn-danger tmb_batal" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" style="font-size: 11px;">Batalkan</button>
                  <?php } ?>

                  <?php 
                    // $data_pjl['status_ulasan'] = "Ada";
                    if($data_pjl['status_penjualan'] == 'Selesai' && $data_pjl['status_ulasan'] == 'Kosong') {
                  ?>
                    <button class="btn btn-sm btn-warning tmb_ulasan" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" data-toggle="modal" data-target="#modal_form_ulasan" style="font-size: 11px;">Beri Ulasan</button>
                  <?php 
                    } 
                    else if($data_pjl['status_penjualan'] == 'Selesai' && $data_pjl['status_ulasan'] == 'Ada') {
                  ?>
                    <button class="btn btn-sm btn-info tmb_lihat_ulasan" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" data-toggle="modal" data-target="#modal_lihat_ulasan" style="font-size: 11px;">Lihat Ulasan</button>
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
      						<button class="btn btn-sm btn-danger tmb_batal" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" style="font-size: 11px;">Batalkan</button>
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
                  <?php if($data_pjl['status_penjualan'] != 'Verifikasi') { ?>
      						  <button class="btn btn-sm btn-danger tmb_batal" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" style="font-size: 11px;">Batalkan</button>
                  <?php } ?>
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

    <!-- TAB TRANSAKSI DIKIRIM -->
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
                  <!-- <button class="btn btn-sm btn-danger tmb-batal" style="font-size: 11px;">Batalkan</button> -->
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
                  <?php if($data_pjl['status_ulasan'] == 'Kosong') { ?>
                    <button class="btn btn-sm btn-warning tmb_ulasan" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" data-toggle="modal" data-target="#modal_form_ulasan" style="font-size: 11px;">Beri Ulasan</button>
                  <?php 
                    } 
                    else if($data_pjl['status_ulasan'] == 'Ada') {
                  ?>
                    <button class="btn btn-sm btn-info tmb_lihat_ulasan" id="<?php echo $no_penjualan; ?>" data-status="<?php echo $data_pjl['status_penjualan']; ?>" data-toggle="modal" data-target="#modal_lihat_ulasan" style="font-size: 11px;">Lihat Ulasan</button>
                  <?php } ?>

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

<!-- style untuk div rating dan animasi rating -->
<style>
  .rating {
    position: relative;
    /*top: 50%;*/
    /*left: 50%;*/
    right: 68%;
    display: flex;
    /*transform: rotateY(180deg);*/
    flex-direction: row-reverse;
    margin-bottom: 10px;
  }
  .rating input {
    display: none;
  }
  .rating label {
    display: block;
    cursor: pointer;
    width: 30px;
    margin: 0;
    /*background: grey;*/
  }
  .rating label:before {
    content: '\f005';
    font-weight: 900;
    font-family: 'Font Awesome\ 5 Free';
    position: relative;
    display: block;    
    font-size: 25px;
    color: #bab3a8;
    /*color: #bab3a8;*/
  }
  .rating label:after {
    content: '\f005';
    font-weight: 900;
    font-family: 'Font Awesome\ 5 Free';
    position: absolute;
    display: block;
    font-size: 25px;
    color: #f5a82c;
    top: 0;
    opacity: 0;
    transition: .5s;
    /*text-shadow: 0 2px 5px rgba(0,0,0,.5);*/
  }
  .rating label:hover:after,
  .rating label:hover ~ label:after,
  .rating input:checked ~ label:after {
    opacity: 1;
  }
</style>
<!-- Modal Beri Ulasan -->
<div class="modal fade" id="modal_form_ulasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Beri Ulasan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="form_ulasan" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-body">
            <!-- <i class="fas fa-star"></i> -->
            <div>
              <label for="" style="font-size: 12px;">Kode Transaksi : <span id="ulasan_kd_transaksi"></span></label>
              <input type="hidden" name="hidden_kdtransaksi_ulasan" id="hidden_kdtransaksi_ulasan">
            </div>
            <label for="rating" style="font-size: 12px;">Rating <small>(wajib)</small></label>
            <div class="rating">
              <input type="radio" name="rating" id="star1" value="5"><label for="star1"></label>
              <input type="radio" name="rating" id="star2" value="4"><label for="star2"></label>
              <input type="radio" name="rating" id="star3" value="3"><label for="star3"></label>
              <input type="radio" name="rating" id="star4" value="2"><label for="star4"></label>
              <input type="radio" name="rating" id="star5" value="1"><label for="star5"></label>
            </div>
            <div class="form-group">
              <label for="komentar" style="font-size: 12px;">Komentar <small>(anda dapat membiarkan kosong)</small></label>
              <textarea class="form-control form-control-sm" name="komentar" id="komentar" placeholder="bagaimana komentar anda . . ." rows="4"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-primary" name="submit_ulasan">Simpan Ulasan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_lihat_ulasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lihat Ulasan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size: 14px;">
        <div class="ulasan-pelanggan">
          <div class="card">
            <div class="card-header">
              <b>Anda</b> - <small id="waktu_ulasan_plg">10 Juli 2020 [13:17:02]</small>
            </div>
            <div class="card-body">
              <h6 class="card-title" id="rating_ulasan_plg">
                <i class="fas fa-star" style="color: #f5a82c;"></i>
                <i class="fas fa-star" style="color: #f5a82c;"></i>
                <i class="fas fa-star" style="color: #f5a82c;"></i>
                <i class="fas fa-star" style="color: #f5a82c;"></i>
                <i class="fas fa-star" style="color: #bab3a8;"></i>
              </h6>
              <p class="card-text" id="kometar_ulasan_plg">
                <small><i>(tidak ada komentar)</i></small>
              </p>
            </div>
          </div>
        </div>

        <div class="belum-ada-balasan" id="belum-ada-balasan" style="text-align: right; padding: 5px;">
          <small><i>(belum ada balasan)</i></small>
        </div>

        <div class="balasan-ulasan" id="balasan-ulasan" style="margin-top: 10px; margin-left: 1%; padding-left: 4%; border-left: 2px solid #DCDCDC; display: none;">
          <div class="card">
            <div class="card-header">
              <b>Blackshadow</b> - <small id="waktu_balasan">11 Juli 2020 [09:21:16]</small>
            </div>
            <div class="card-body">
              <p class="card-text" id="komentar_balasan">
                Terima kasih telah memberi ulasan positif terhadap pelayanan kami.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  // $("input[name=rating]").change(function() {
  //   var value = $(this).val();
  //   console.log(value);
  // });
  $(".tmb_ulasan").click(function() {
    var kode_transaksi = $(this).attr("id");
    $("#ulasan_kd_transaksi").text(kode_transaksi);
    $("#hidden_kdtransaksi_ulasan").val(kode_transaksi);
  })

  $("#form_ulasan").submit(function() {
    event.preventDefault();
    var rating = $("input[name=rating]:checked").val();
    // alert(rating);
    if(rating == "" || rating == null) {
      Swal.fire({
        title: 'Maaf',
        text: 'Anda harus memberi rating terlebih dulu',
        type: 'warning'
      })
    }
    else {
      Swal.fire({
        title: 'Peringatan',
        text: 'apakah anda yakin memberikan ulasan ini?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((ya) => {
        if (ya.value) {
          // Simpan form ulasan
          var form_ulasan_data = $(this).serialize();
          $.ajax({
            type: "POST",
            url: "usrajax/simpan_ulasan.php",
            data: form_ulasan_data,
            success:function(hasil) {
              Swal.fire({
                title: 'Terima Kasih',
                text: 'semoga anda puas dengan pelayanan kami',
                type: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((ok) => {
                if (ok.value) {
                  // window.location='?page=data_transaksi_offline';
                  location.reload();
                }
              })
            }
          })
          // location.reload();
        }
      })
    }
  })

  $(".tmb_lihat_ulasan").click(function() {
    var kode_transaksi = $(this).attr("id");
    $.ajax({
      type: "GET",
      url: "usrajax/detail.php?page=lihat_ulasan",
      data: "no_penjualan="+kode_transaksi,
      success : function(data) {
        var objData = JSON.parse(data);
        console.log(objData);
        $.each(objData, function(key,val){
          $("#waktu_ulasan_plg").text(val.tglformat_ulasan+" ["+val.jam_ulasan+"]");
          // mengisi jumlah bintang sesuai rating pelanggan
          var rating = Number(val.rating_ulasan);
          $("#rating_ulasan_plg").html("");
          for(var i = 0; i < rating; i++) {
            var bintang = '<i class="fas fa-star" style="color: #f5a82c;"></i>';
            $("#rating_ulasan_plg").append(bintang);
          }
          for(var i = 0; i < 5-rating; i++) {
            var bintang = '<i class="fas fa-star" style="color: #bab3a8;"></i>';
            $("#rating_ulasan_plg").append(bintang);
          }
          // mengisi komentar ulasan pelanggan
          if(val.komentar_ulasan == "") {
            $("#kometar_ulasan_plg").html('<small><i>(tidak ada komentar)</i></small>');
          } else {
            $("#kometar_ulasan_plg").html(val.komentar_ulasan);
          }
          // mengisi kotak balasan
          if(val.status_balasan == "Kosong") {
            $("#belum-ada-balasan").show();
            $("#balasan-ulasan").hide();
          } else {
            $("#belum-ada-balasan").hide();
            $("#waktu_balasan").text(val.tglformat_balasan+" ["+val.jam_balasan+"]");
            $("#komentar_balasan").text(val.komentar_balasan);
            $("#balasan-ulasan").show();
          }
        })
      }
    }); 
  })

  $(".tmb_batal").click(function() {
    var no_penjualan = $(this).attr('id');
    var status = $(this).data('status');
    Swal.fire({
      title: "Peringatan",
      text: "Anda akan membatalkan transaksi "+no_penjualan+" dengan status saat ini "+status+". Pelanggan tidak akan dapat melanjutkan transaksi ini.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Batalkan',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "usrajax/proses_hapus.php?page=transaksi",
          data: "key="+no_penjualan+"&status="+status,
          success:function(hasil) {
            Swal.fire({
              title: 'Berhasil',
              text: 'Data Berhasil Dihapus',
              type: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((ok) => {
              if (ok.value) {
                // window.location='?page=data_transaksi_offline';
                location.reload();
              }
            })
          }
        })
      }
    })
  })
</script>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>