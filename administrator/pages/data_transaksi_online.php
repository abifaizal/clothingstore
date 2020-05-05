<section class="content-header">
  <h1>
    Halaman Data Penjualan Online
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Penjualan Online</li>
  </ol>
</section>

<section class="content">
	<div class="box">
		<div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
      	<?php 
					$query_pjl = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online'";
			    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
			    $count_semua = mysqli_num_rows($sql_pjl);

			    $query_pjl = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Belum Bayar'";
			    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
			    $count_belumbayar = mysqli_num_rows($sql_pjl);

			    $query_pjl = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND (status_penjualan = 'Verifikasi' OR status_penjualan = 'Menunggu Verifikasi')";
			    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
			    $count_verifikasi = mysqli_num_rows($sql_pjl);

			    $query_pjl = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Dikirim'";
			    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
			    $count_dikirim = mysqli_num_rows($sql_pjl);

			    $query_pjl = "SELECT * FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND status_penjualan = 'Selesai'";
			    $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
			    $count_selesai = mysqli_num_rows($sql_pjl);
				?>
        <li class="active">
        	<a href="#tab_semua" data-toggle="tab">
        		Semua <sup>( <?php echo $count_semua; ?> )</sup>
        	</a>
        </li>
        <li>
        	<a href="#tab_belumbayar" data-toggle="tab">
        		Belum Bayar <sup>( <?php echo $count_belumbayar; ?> )</sup>
        	</a>
        </li>
        <li>
        	<a href="#tab_verifikasi" data-toggle="tab">
        		Verifikasi <sup>( <?php echo $count_verifikasi; ?> )</sup>
        	</a>
        </li>
        <li>
        	<a href="#tab_dikirim" data-toggle="tab">
        		Dikirim <sup>( <?php echo $count_dikirim; ?> )</sup>
        	</a>
        </li>
        <li>
        	<a href="#tab_selesai" data-toggle="tab">
        		Selesai <sup>( <?php echo $count_selesai; ?> )</sup>
        	</a>
        </li>
      </ul>
      <div class="tab-content">
      	<!-- TAB SEMUA -->
        <div class="tab-pane active table-responsive no-padding" id="tab_semua">
          <table class="table" style="font-size: 12px;">
          	<thead>
          		<tr>
          			<th>No</th>
          			<th>No Penjualan</th>
          			<th>Waktu</th>
          			<th>Pelanggan</th>
          			<th>Kota</th>
          			<th>Status</th>
          			<th>Total</th>
          			<th>Opsi</th>
          		</tr>
          	</thead>
          	<tbody>
          	<?php 
          		$nomor = 1;
          		$query_penjualan = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan INNER JOIN tbl_pelanggan ON tbl_penjualan.kode_plg = tbl_pelanggan.kode_plg WHERE tbl_penjualan.metode_penjualan = 'Online'";
          		$sql_penjualan = mysqli_query($conn, $query_penjualan) or die ($conn->error);
          		while($data_penjualan = mysqli_fetch_array($sql_penjualan)){
          	?>
          			<tr>
          				<td><?php echo $nomor++; ?></td>
          				<td><?php echo $data_penjualan['no_penjualan']; ?></td>
          				<td><?php echo $data_penjualan['tgl_penjualan']; ?> [<?php echo $data_penjualan['jam_penjualan']; ?>]</td>
          				<td><?php echo $data_penjualan['username_plg']; ?></td>
          				<td><?php echo $data_penjualan['kabkota_penerima']; ?></td>
          				<td>
          					<small class="label <?php if($data_penjualan['status_penjualan'] == 'Belum Bayar') {
          						echo 'bg-red';
          					} else if($data_penjualan['status_penjualan'] == 'Menunggu Verifikasi') {
          						echo 'bg-yellow';
          					} else if($data_penjualan['status_penjualan'] == 'Verifikasi') {
          						echo 'bg-purple';
          					} else if($data_penjualan['status_penjualan'] == 'Dikirim') {
          						echo 'bg-blue';
          					} else if($data_penjualan['status_penjualan'] == 'Selesai') {
          						echo 'bg-green';
          					} ?>">
          						<?php echo $data_penjualan['status_penjualan']; ?>
          					</small>
          				</td>
          				<?php 
          					$total_penjualan = $data_penjualan['total_penjualan'];
          					$ongkir = $data_penjualan['ongkir_paket'];
          					$total_akhir = $total_penjualan + $ongkir;
          				?>
          				<td><?php echo $total_penjualan; ?></td>
          				<td>
          					<button class="btn btn-xs btn-success tmb_detailtrans" id="<?php echo $data_penjualan['no_penjualan']; ?>" title="detail transaksi" data-toggle="modal" data-target="#modal-detail_transaksi"
          						data-diskonpenjualan = "<?php echo $data_penjualan['diskon_penjualan']; ?>"
          						data-totalpenjualan = "<?php echo $data_penjualan['total_penjualan']; ?>"
          						data-nama_penerima = "<?php echo $data_penjualan['nama_penerima']; ?>"
          						data-nohp_penerima = "<?php echo $data_penjualan['nohp_penerima']; ?>"
          						data-alamat_penerima = "<?php echo $data_penjualan['alamat_penerima']; ?>"
          						data-kode_pos = "<?php echo $data_penjualan['kode_pos']; ?>"
          						data-provinsi_penerima = "<?php echo $data_penjualan['provinsi_penerima']; ?>"
          						data-kabkota_penerima = "<?php echo $data_penjualan['kabkota_penerima']; ?>"
          						data-kurir_pengiriman = "<?php echo $data_penjualan['kurir_pengiriman']; ?>"
          						data-paket_pengiriman = "<?php echo $data_penjualan['paket_pengiriman']; ?>"
          						data-ongkir_paket = "<?php echo $data_penjualan['ongkir_paket']; ?>"
          						data-berat_kiriman = "<?php echo $data_penjualan['berat_kiriman']; ?>"
          						>
          						<i class="fa fa-eye"></i>
          					</button>
          					<?php 
          						if($data_penjualan['status_penjualan'] == 'Menunggu Verifikasi') {
          					?>
          					<button class="btn btn-xs btn-info" title="verifikasi pembayaran"><i class="fa fa-check"></i></button>
          					<?php } ?>
          					<button class="btn btn-xs btn-danger" title="hapus"><i class="fa fa-trash"></i></button>
          				</td>
          			</tr>
          	<?php } ?>
          	</tbody>
          </table>
        </div>
        <!-- TAB BELUMBAYAR -->
        <div class="tab-pane table-responsive no-padding" id="tab_belumbayar">
          <table class="table" style="font-size: 12px;">
          	<thead>
          		<tr>
          			<th>No</th>
          			<th>No Penjualan</th>
          			<th>Waktu</th>
          			<th>Pelanggan</th>
          			<th>Kota</th>
          			<th>Status</th>
          			<th>Total</th>
          			<th>Opsi</th>
          		</tr>
          	</thead>
          	<tbody>
          	<?php 
          		$nomor = 1;
          		$query_penjualan = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan INNER JOIN tbl_pelanggan ON tbl_penjualan.kode_plg = tbl_pelanggan.kode_plg WHERE tbl_penjualan.metode_penjualan = 'Online' AND tbl_penjualan.status_penjualan = 'Belum Bayar'";
          		$sql_penjualan = mysqli_query($conn, $query_penjualan) or die ($conn->error);
          		while($data_penjualan = mysqli_fetch_array($sql_penjualan)){
          	?>
          			<tr>
          				<td><?php echo $nomor++; ?></td>
          				<td><?php echo $data_penjualan['no_penjualan']; ?></td>
          				<td><?php echo $data_penjualan['tgl_penjualan']; ?> [<?php echo $data_penjualan['jam_penjualan']; ?>]</td>
          				<td><?php echo $data_penjualan['username_plg']; ?></td>
          				<td><?php echo $data_penjualan['kabkota_penerima']; ?></td>
          				<td>
          					<small class="label bg-red">
          						<?php echo $data_penjualan['status_penjualan']; ?>
          					</small>
          				</td>
          				<?php 
          					$total_penjualan = $data_penjualan['total_penjualan'];
          					$ongkir = $data_penjualan['ongkir_paket'];
          					$total_akhir = $total_penjualan + $ongkir;
          				?>
          				<td><?php echo $total_penjualan; ?></td>
          				<td>
          					<button class="btn btn-xs btn-success tmb_detailtrans" id="<?php echo $data_penjualan['no_penjualan']; ?>" title="detail transaksi" data-toggle="modal" data-target="#modal-detail_transaksi"
          						data-diskonpenjualan = "<?php echo $data_penjualan['diskon_penjualan']; ?>"
          						data-totalpenjualan = "<?php echo $data_penjualan['total_penjualan']; ?>"
          						data-nama_penerima = "<?php echo $data_penjualan['nama_penerima']; ?>"
          						data-nohp_penerima = "<?php echo $data_penjualan['nohp_penerima']; ?>"
          						data-alamat_penerima = "<?php echo $data_penjualan['alamat_penerima']; ?>"
          						data-kode_pos = "<?php echo $data_penjualan['kode_pos']; ?>"
          						data-provinsi_penerima = "<?php echo $data_penjualan['provinsi_penerima']; ?>"
          						data-kabkota_penerima = "<?php echo $data_penjualan['kabkota_penerima']; ?>"
          						data-kurir_pengiriman = "<?php echo $data_penjualan['kurir_pengiriman']; ?>"
          						data-paket_pengiriman = "<?php echo $data_penjualan['paket_pengiriman']; ?>"
          						data-ongkir_paket = "<?php echo $data_penjualan['ongkir_paket']; ?>"
          						data-berat_kiriman = "<?php echo $data_penjualan['berat_kiriman']; ?>"
          						>
          						<i class="fa fa-eye"></i>
          					</button>
          					<button class="btn btn-xs btn-danger" title="hapus"><i class="fa fa-trash"></i></button>
          				</td>
          			</tr>
          	<?php } ?>
          	</tbody>
          </table>
        </div>
        <!-- TAB VERIFIKASI -->
        <div class="tab-pane table-responsive no-padding" id="tab_verifikasi">
          <table class="table" style="font-size: 12px;">
          	<thead>
          		<tr>
          			<th>No</th>
          			<th>No Penjualan</th>
          			<th>Waktu</th>
          			<th>Pelanggan</th>
          			<th>Kota</th>
          			<th>Status</th>
          			<th>Total</th>
          			<th>Opsi</th>
          		</tr>
          	</thead>
          	<tbody>
          	<?php 
          		$nomor = 1;
          		$query_penjualan = "SELECT * FROM tbl_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan INNER JOIN tbl_pelanggan ON tbl_penjualan.kode_plg = tbl_pelanggan.kode_plg WHERE tbl_penjualan.metode_penjualan = 'Online' AND (status_penjualan = 'Menunggu Verifikasi' OR status_penjualan = 'Verifikasi')";
          		$sql_penjualan = mysqli_query($conn, $query_penjualan) or die ($conn->error);
          		while($data_penjualan = mysqli_fetch_array($sql_penjualan)){
          	?>
          			<tr>
          				<td><?php echo $nomor++; ?></td>
          				<td><?php echo $data_penjualan['no_penjualan']; ?></td>
          				<td><?php echo $data_penjualan['tgl_penjualan']; ?> [<?php echo $data_penjualan['jam_penjualan']; ?>]</td>
          				<td><?php echo $data_penjualan['username_plg']; ?></td>
          				<td><?php echo $data_penjualan['kabkota_penerima']; ?></td>
          				<td>
          					<small class="label <?php if($data_penjualan['status_penjualan'] == 'Menunggu Verifikasi') {
          						echo 'bg-yellow';
          					} else if($data_penjualan['status_penjualan'] == 'Verifikasi') {
          						echo 'bg-purple';
          					} ?>">
          						<?php echo $data_penjualan['status_penjualan']; ?>
          					</small>
          				</td>
          				<?php 
          					$total_penjualan = $data_penjualan['total_penjualan'];
          					$ongkir = $data_penjualan['ongkir_paket'];
          					$total_akhir = $total_penjualan + $ongkir;
          				?>
          				<td><?php echo $total_penjualan; ?></td>
          				<td>
          					<button class="btn btn-xs btn-success tmb_detailtrans" id="<?php echo $data_penjualan['no_penjualan']; ?>" title="detail transaksi" data-toggle="modal" data-target="#modal-detail_transaksi"
          						data-diskonpenjualan = "<?php echo $data_penjualan['diskon_penjualan']; ?>"
          						data-totalpenjualan = "<?php echo $data_penjualan['total_penjualan']; ?>"
          						data-nama_penerima = "<?php echo $data_penjualan['nama_penerima']; ?>"
          						data-nohp_penerima = "<?php echo $data_penjualan['nohp_penerima']; ?>"
          						data-alamat_penerima = "<?php echo $data_penjualan['alamat_penerima']; ?>"
          						data-kode_pos = "<?php echo $data_penjualan['kode_pos']; ?>"
          						data-provinsi_penerima = "<?php echo $data_penjualan['provinsi_penerima']; ?>"
          						data-kabkota_penerima = "<?php echo $data_penjualan['kabkota_penerima']; ?>"
          						data-kurir_pengiriman = "<?php echo $data_penjualan['kurir_pengiriman']; ?>"
          						data-paket_pengiriman = "<?php echo $data_penjualan['paket_pengiriman']; ?>"
          						data-ongkir_paket = "<?php echo $data_penjualan['ongkir_paket']; ?>"
          						data-berat_kiriman = "<?php echo $data_penjualan['berat_kiriman']; ?>"
          						>
          						<i class="fa fa-eye"></i>
          					</button>
          					<button class="btn btn-xs btn-info" title="verifikasi pembayaran"><i class="fa fa-check"></i></button>
          					<button class="btn btn-xs btn-danger" title="hapus"><i class="fa fa-trash"></i></button>
          				</td>
          			</tr>
          	<?php } ?>
          	</tbody>
          </table>
        </div>
        <!-- TAB DIKIRIM -->
        <div class="tab-pane table-responsive no-padding" id="tab_dikirim">
          tab 4
        </div>
        <!-- TAB SELESAI -->
        <div class="tab-pane table-responsive no-padding" id="tab_selesai">
          tab 5
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
	</div>
</section>

<!-- MODAL DETAIL TRANSAKSI -->
<div class="modal fade" id="modal-detail_transaksi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Transaksi</h4>
      </div>
      <div class="modal-body">
				<table class="table table-bordered tabel-detail-keranjang-produk">
          <thead>
            <tr>
              <th colspan="2">Produk</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="data_detailkrj">
            <tr>
              <td class="td-foto">
                <div class="foto-produk" id="dt_fotoproduk">
                  <img src="../img/produk/prd-1584967402.jpg" class="card-img-top" alt="...">
                </div>
              </td>
              <td id="dt_ketproduk">
                Kemeja Hitam Lengan Panjang <br>
                Size : M <br>
                Rp 120,000 (diskon 10%) <br>
                Harga : Rp 108,000
              </td>
              <td id="dt_jmlprd">1</td>
              <td id="dt_subtotalprd">Rp 120,000</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-right" colspan="3">Total</th>
              <th>Rp <span id="dt_totalkrj">120,000</span></th>
            </tr>
            <tr>
              <th class="text-right" colspan="3">Diskon</th>
              <th><span id="dt_diskonpjl">10</span> %</th>
            </tr>
            <tr>
              <th class="text-right" colspan="3">Total Akhir</th>
              <th>Rp <span id="dt_totalpjl">10</span></th>
            </tr>
          </tfoot>
        </table>
        <table class="table table-bordered" style="font-size: 12px;">
        	<tr>
        		<th width="35%">Nama Penerima</th>
        		<td id="dt_namapenerima">Jamal</td>
        	</tr>
        	<tr>
        		<th>Telepon</th>
        		<td id="dt_nohp">Jamal</td>
        	</tr>
        	<tr>
        		<th>Alamat Lengkap</th>
        		<td id="dt_alamat">Jamal</td>
        	</tr>
        	<tr>
        		<th>Kota / Kabupaten</th>
        		<td id="dt_kabkota">Jamal</td>
        	</tr>
        	<tr>
        		<th>Provinsi</th>
        		<td id="dt_provinsi">Jamal</td>
        	</tr>
        	<tr>
        		<th>Ongkir</th>
        		<td id="dt_ongkir">Jamal</td>
        	</tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
	$(document).on("click", ".tmb_detailtrans", function() {
    var no_penjualan = $(this).attr('id');
    // var tgl_penjualan = $(this).data('tglpenjualan');
    // var jam_penjualan = $(this).data('jampenjualan');
    // var username_pgw = $(this).data('usernamepgw');
    var diskon_pjl = $(this).data('diskonpenjualan');
    var total_penjualan = $(this).data('totalpenjualan');
    var nama_penerima = $(this).data('nama_penerima');
    var nohp_penerima = $(this).data('nohp_penerima');
    var alamat_penerima = $(this).data('alamat_penerima');
    var kabkota_penerima = $(this).data('kabkota_penerima');
    var provinsi_penerima = $(this).data('provinsi_penerima');
    var ongkir_paket = $(this).data('ongkir_paket');
    var kurir_pengiriman = $(this).data('kurir_pengiriman');
    var paket_pengiriman = $(this).data('paket_pengiriman');paket_pengiriman

    // $("#dt_nopenjualan").text(no_penjualan);
    // $("#dt_wktpjl").text(tgl_penjualan+" ["+jam_penjualan+"]");
    // $("#dt_usernamepgw").text(username_pgw);
    $("#dt_diskonpjl").text(diskon_pjl);
    $("#dt_totalpjl").text(total_penjualan);
    $("#dt_namapenerima").text(nama_penerima);
    $("#dt_nohp").text(nohp_penerima);
    $("#dt_alamat").text(alamat_penerima);
    $("#dt_kabkota").text(kabkota_penerima);
    $("#dt_provinsi").text(provinsi_penerima);
    $("#dt_ongkir").text(ongkir_paket+" ("+kurir_pengiriman+" paket "+paket_pengiriman+")");

    $("#data_detailkrj").html("");
    $.ajax({
      type: "GET",
      url: "ajax/detail.php?page=penjualan",
      data: "no_penjualan="+no_penjualan,
      success : function(data) {
        var objData = JSON.parse(data);
        var total = 0;
        // console.log(objData);
        $.each(objData, function(key,val){
          var baris_baru = '';
          baris_baru += '<tr>';
          baris_baru +=   '<td class="td-foto">';
          baris_baru +=   ' <div class="foto-produk">';
          baris_baru +=   '   <img src="../img/produk/'+val.gambar_prd+'" class="card-img-top" alt="...">';
          baris_baru +=   ' </div>';
          baris_baru +=   '</td>';
          baris_baru +=   '<td>'+val.nama_prd+'<br>Ukuran : '+val.keterangan_ukr+'<br>Harga : Rp '+val.harga_prd+'<br>Diskon : '+val.diskon_prd+' %</td>';
          baris_baru +=   '<td>'+val.jml_prd+'</td>';
          baris_baru +=   '<td>Rp '+val.subtotal_prd+'</td>';
          baris_baru += '</tr>';
          $("#data_detailkrj").append(baris_baru);

          var subtotal_prd = Number(val.subtotal_prd);
          total = total + subtotal_prd;
        })
        $("#dt_totalkrj").text(total);
      }
    });
  })
</script>