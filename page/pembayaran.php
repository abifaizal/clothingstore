<?php 
	$no_penjualan = @$_GET['nopenjualan'];
	$kode_plg = @$_SESSION['kode_plg'];
	$query_cekpjl = "SELECT no_penjualan, status_penjualan FROM tbl_penjualan WHERE metode_penjualan = 'Online' AND kode_plg = '$kode_plg' AND no_penjualan = '$no_penjualan' AND status_penjualan = 'Belum Bayar'";
	$sql_cekpjl = mysqli_query($conn, $query_cekpjl) or die ($conn->error);
  $rows = mysqli_num_rows($sql_cekpjl);
	if($no_penjualan != '' && $rows > 0) {
		$data_pjl = mysqli_fetch_array($sql_cekpjl);
 ?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="./">Home</a></li>
		<li class="breadcrumb-item"><a href="?page=datatransaksi">Data Transaksi</a></li>
		<li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
	</ol>
</nav>

<div class="kontainer-pembayaran">
	<div>
		<style>
			.kode-transaksi {
				font-size: 14px;
			}
			.kode-transaksi th, .kode-transaksi td {
				padding: 0 15px 5px 0;
			}
		</style>
		<table class="kode-transaksi">
			<tr>
				<th>Kode Transaksi</th>
				<td><?php echo $no_penjualan; ?></td>
			</tr>
			<tr>
				<th>Status Penjualan</th>
				<td>
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
				</td>
			</tr>
		</table>
	</div>
	<table class="table detail-order table-bordered">
		<thead>
			<tr>
				<th colspan="2">Produk</th>
				<th>Qty</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query_pjldetail = "SELECT * FROM tbl_produk INNER JOIN tbl_penjualandetail ON tbl_produk.id_prd = tbl_penjualandetail.id_prd WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
	  	$sql_pjldetail = mysqli_query($conn, $query_pjldetail) or die ($conn->error);
	  	$total_belanja = 0;
	  	while($data_pjldetail = mysqli_fetch_array($sql_pjldetail)) {
		 ?>
			<tr>
				<td>
		      <img src="img/produk/<?php echo $data_pjldetail['gambar_prd']; ?>" class="card-img-top" alt="..." style="width: 70px;">
				</td>
				<?php 
					$total_belanja = $total_belanja + $data_pjldetail['subtotal_prd'];
					$id_prd = $data_pjldetail['id_prd'];
          $id_ukuran = $data_pjldetail['id_ukuran'];
          $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
          $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
          $data_ukuran = mysqli_fetch_array($sql_ukuran);
				 ?>
				<td>
					<?php echo $data_pjldetail['nama_prd']; ?> <br>
					Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
					Harga : Rp <?php echo $data_pjldetail['harga_prd']; ?>
				</td>
				<td>
					<?php echo $data_pjldetail['jml_prd']; ?>
				</td>
				<td>
					Rp. <?php echo $data_pjldetail['subtotal_prd']; ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
		<tr>
			<th colspan="3">
				Total Belanja
			</th>
			<th>
				Rp <?php echo $total_belanja; ?>
			</th>
		</tr>
	</table>

	<div class="kontainer-tabelpenerima">
		<?php 
			$query_penerima = "SELECT * FROM tbl_datapenerima WHERE no_penjualan = '$no_penjualan'";
	  	$sql_penerima = mysqli_query($conn, $query_penerima) or die ($conn->error);
	  	$data_penerima = mysqli_fetch_array($sql_penerima);
		?>
		<table class="table penerima table-borderless">
			<tr>
				<td>Nama Penerima</td>
				<td><?php echo $data_penerima['nama_penerima']; ?></td>
			</tr>
			<tr>
				<td>Telp</td>
				<td><?php echo $data_penerima['nohp_penerima']; ?></td>
			</tr>
			<tr>
				<td>Alamat Lengkap</td>
				<td><?php echo $data_penerima['alamat_penerima']; ?></td>
			</tr>
			<tr>
				<td>Kota / Kabupaten</td>
				<td><?php echo $data_penerima['kabkota_penerima']; ?></td>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td><?php echo $data_penerima['provinsi_penerima']; ?></td>
			</tr>
			<tr>
				<td>Ongkir</td>
				<td>Rp <?php echo $data_penerima['ongkir_paket']; ?> (<?php echo strtoupper($data_penerima['kurir_pengiriman']); ?> Paket <?php echo $data_penerima['paket_pengiriman']; ?>)</td>
			</tr>
			<tr>
				<?php 
					$total_akhir = $total_belanja + $data_penerima['ongkir_paket'];
				 ?>
				<td>Total Akhir dan Ongkir</td>
				<th>Rp <?php echo $total_akhir; ?></th>
			</tr>
		</table>
		<div style="text-align: right; padding: 5px;">
			<button style="font-size: 10px;" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal_ubahalamat" id="tmb_ubahalamat">
				ubah
			</button>
		</div>
	</div>

	<div class="alert alert-danger" role="alert">
	  Total yang harus anda bayar adalah <b>Rp <?php echo Number_format($total_akhir); ?></b>
	</div>

  <div class="kontainer-petunjukbayar">
    <h6>Petunjuk Pembayaran</h6>
    <table class="table petunjuk-bayar table-borderless">
      <tr>
        <td>1.</td>
        <td>Pembayaran dilakukan dengan cara transfer ke <b>bank Mandiri</b> </td>
      </tr>
      <tr>
        <td>2.</td>
        <td>Nomor Rekening : <b>555-01-3341-02</b></td>
      </tr>
      <tr>
        <td>3.</td>
        <td>Atas Nama : Black Sabath Distro Kebumen</td>
      </tr>
      <tr>
        <td>4.</td>
        <td>Masukkan nominal transfer sesuai dengan nominal pembayaran anda</td>
      </tr>
      <tr>
        <td>5.</td>
        <td>Jika nominal kurang maka pesanan anda tidak akan diproses sedangkan jika nominal anda lebih maka kami tidak akan mengembalikan sisa nominal pembayaran anda</td>
      </tr>
      <tr>
        <td>6.</td>
        <td><b>Simpan bukti transfer</b> lalu foto dan lampirkan saat konfirmasi pembayaran</td>
      </tr>
      <tr>
        <td>7.</td>
        <td>Black Sabath akan memvalidasi dan mengirimkan pesanan anda</td>
      </tr>
    </table>
  </div>
  <div style="padding-bottom: 10px; text-align: right;">
  	<button type="button" class="btn btn-dark btn-sm" id="halaman_konfirmasi">Konfirmasi Pembayaran</button>
  </div>
</div>

<style>
	#close_modal span {
		font-size: 18px;
	}
	.modal-body .form-group label, .modal-body .form-group .form-control {
		font-size: 12px;
	}
</style>

<div class="modal fade modal_ubahalamat" id="modal_ubahalamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Ubah Data Penerima</h6>
        <button type="button" class="close" id="close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_ubahalamat">
          <form method="POST" autocomplete="off" id="form_ubahalamat" enctype="multipart/form-data">
            <div class="form-group">
					  	<input type="hidden" id="no_penjualan" name="no_penjualan" value="<?php echo $no_penjualan; ?>">
					  	<input type="hidden" id="berat_kiriman" name="berat_kiriman" value="<?php echo $data_penerima['berat_kiriman']; ?>">
					    <label for="nm_penerima">Nama Penerima</label>
					    <input type="text" class="form-control form-control-sm" name="nm_penerima" id="nm_penerima" placeholder="cth: Budi Ramadhan" autofocus="" value="<?php echo $data_penerima['nama_penerima']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="no_hpaktif">No HP aktif</label>
					    <input type="text" class="form-control form-control-sm" name="no_hpaktif" id="no_hpaktif" placeholder="cth: 085333461216" value="<?php echo $data_penerima['nohp_penerima']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="almt_lengkap">Alamat Lengkap</label>
					    <textarea class="form-control form-control-sm" name="almt_lengkap" id="almt_lengkap" rows="3" placeholder="cth: Jl. Bhayangkara No.01, Panggel, Kembaran, Kec. Kebumen, Kabupaten Kebumen, Jawa Tengah."><?php echo $data_penerima['alamat_penerima']; ?></textarea>
					  </div>
					  <div class="form-group">
					    <label for="kd_pos">Kode Pos</label>
					    <input type="text" class="form-control form-control-sm" name="kd_pos" id="kd_pos" placeholder="cth: 55161" value="<?php echo $data_penerima['kode_pos']; ?>">
					  </div>
					  <div class="form-group">
					  	<?php 
					  	$array_prov = rajaongkir_provinsi();
					  	?>
					    <label for="provinsi">Provinsi</label>
					    <select class="form-control form-control-sm" id="provinsi_tujuan" name="provinsi_tujuan">
					    	<option value="0">Pilih Provinsi</option>
					      <?php 
					      for($i=0; $i<count($array_prov); $i++) {
					      ?>
					      	<option value="<?php echo $array_prov[$i]['id']; ?>" data-namaprov="<?php echo $array_prov[$i]['name']; ?>">
					      		<?php echo $array_prov[$i]['name']; ?>
					      	</option>
					    	<?php } ?>
					    </select>
					    <input type="hidden" name="ip_provinsi" id="ip_provinsi">
					  </div>
					  <div class="form-group">
					    <label for="kota_kab">Kota / Kabupaten</label>
					    <select class="form-control form-control-sm" id="kota_kab" name="kota_kab">
					      <option value="0">Pilih Provinsi Dulu</option>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="jasa_pengirim">Pilih Jasa Pengiriman</label>
					    <div class="form-check">
							  <input class="form-check-input jasa_pengirim" type="radio" name="jasa_pengirim" id="jasa_jne" value="jne">
							  <label class="form-check-label" for="jasa_jne">
							    JNE
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input jasa_pengirim" type="radio" name="jasa_pengirim" id="jasa_pos" value="pos">
							  <label class="form-check-label" for="jasa_pos">
							    POS Indonesia
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input jasa_pengirim" type="radio" name="jasa_pengirim" id="jasa_tiki" value="tiki">
							  <label class="form-check-label" for="jasa_tiki">
							    TIKI
							  </label>
							</div>
					  </div>
					  <div class="form-group">
					    <label for="jasa_pengirim">Pilih Jenis Paket Pengiriman</label>
					    <table class="table table-bordered" style="font-size: 11px;">
					    	<thead>
					    		<tr>
						    		<th>Nama Paket</th>
						    		<th>Biaya</th>
						    		<th width="8%">Opsi</th>
						    	</tr>
					    	</thead>
					    	<tbody id="tbody_paket_pengiriman">
					    		<!-- di isi dengan javascript -->
					    	</tbody>
					    	<tfoot id="tfoot_kosong">
					    		<tr>
					    			<td colspan="3" style="text-align: center;">
					    				Pilih Jasa Pengiriman Terlebih Dahulu
					    			</td>
					    		</tr>
					    	</tfoot>
					    </table>
					    <input type="hidden" name="ip_desk_paket" id="ip_desk_paket">
					    <input type="hidden" name="ip_etd_paket" id="ip_etd_paket">
					    <input type="hidden" name="ip_cost_paket" id="ip_cost_paket">
					  </div>
					  <div class="form-group">
					    <label for="total_bayar">Total Bayar</label>
					    <table class="table table-bordered" style="font-size: 11px;">
					    	<tr>
					    		<td>Total Belanja</td>
					    		<th style="text-align: right;">Rp <span id="total_belanja"><?php echo $total_belanja; ?></span></th>
					    	</tr>
					    	<tr>
					    		<td>Total Ongkir</td>
					    		<th style="text-align: right;">Rp <span id="total_ongkir">-</span></th>
					    	</tr>
					    	<tr>
					    		<th>Total Bayar</th>
					    		<th style="text-align: right;">Rp <span id="total_bayar"><?php echo $total_belanja; ?></span></th>
					    	</tr>
					    </table>
					    <input type="hidden" name="ip_total_belanja" id="ip_total_belanja" value="<?php echo $total_belanja; ?>">
					    <input type="hidden" name="ip_total_bayar" id="ip_total_bayar" value="<?php echo $total_belanja; ?>">
					  </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="tmb_simpanperubahan">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<script>
	var total_belanja = Number(<?php echo $total_belanja; ?>);
	var berat_total = <?php echo $data_penerima['berat_kiriman']; ?>;

	function ip_kabkota() {
		var nama_kota = $("#kota_kab").find(':selected').data('namakota');
		$("#ip_kabkota").val(nama_kota);
	}

	$("#provinsi_tujuan").change(function() {
		var id_prov = $(this).val();
		if(id_prov == "0") {
			$("#ip_provinsi").val("");
			$("#kota_kab").html('<option value="0">Pilih Provinsi Dulu</option>');
		} else {
			var nama_prov = $(this).find(':selected').data('namaprov');
			$("#ip_provinsi").val(nama_prov);

			$.ajax({
        type: "GET",
        url: "usrajax/rajaongkir.php?page=kabkota",
        data: "id_prov="+id_prov,
        success: function(hasil) {
          var objData = JSON.parse(hasil);
          $("#kota_kab").html('');
          // console.log(objData);
          $.each(objData, function(key,val){
	          var option_city = '';
	          option_city = '<option value="'+val.name+'" data-idkota="'+val.id+'">'+val.name+' ('+val.type+')</option>';
            $("#kota_kab").append(option_city);
	        })
        }
      });
		}
    $(".jasa_pengirim").prop('checked', false);
    $("#tbody_paket_pengiriman").html('');
    $("#tfoot_kosong").show();
    $("#ip_desk_paket").val('');
		$("#ip_etd_paket").val('');
		$("#ip_cost_paket").val('');
		$("#total_ongkir").text('-');
		$("#total_bayar").text(total_belanja);
		$("#ip_total_bayar").val(total_belanja);
	})

	$("#kota_kab").change(function() {
		$(".jasa_pengirim").prop('checked', false);
    $("#tbody_paket_pengiriman").html('');
    $("#tfoot_kosong").show();
    $("#ip_desk_paket").val('');
		$("#ip_etd_paket").val('');
		$("#ip_cost_paket").val('');
		$("#total_ongkir").text('-');
		$("#total_bayar").text(total_belanja);
		$("#ip_total_bayar").val(total_belanja);
	})

	$(".jasa_pengirim").change(function() {
		var count = 0;
		var jasa = $(this).val();
		var id_prov = $("#provinsi_tujuan").val();
		var id_kota = $("#kota_kab").find(':selected').data('idkota');

		$("#ip_desk_paket").val('');
		$("#ip_etd_paket").val('');
		$("#ip_cost_paket").val('');

		$("#total_ongkir").text('-');
		$("#total_bayar").text(total_belanja);
		$("#ip_total_bayar").val(total_belanja);

		if(id_prov == '0') {
			$("#provinsi_tujuan").focus();
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong pilih provinsi tujuan',
        'warning'
      )
      $(".jasa_pengirim").prop('checked', false);
		} else {
			// alert(jasa+" / "+id_kota);
			$.ajax({
        type: "GET",
        url: "usrajax/rajaongkir.php?page=biaya_ongkir",
        data: "id_kota="+id_kota+"&berat="+berat_total+"&jasa="+jasa,
        success: function(ongkir) {
          var objData = JSON.parse(ongkir);
          $("#tbody_paket_pengiriman").html('');
          console.log(objData);
          if(objData.length > 0) {
	          $.each(objData, function(key,val){
	          	count++;
		          var paket = '';
		          paket += '<tr>';
		          paket += 	'<td>';
		          paket +=		'<b>'+val.service+'</b> <br>';
		          paket +=		'<span style="font-size: 10px;">'+val.description+'</span> <br>';
		          paket +=		'<span style="font-size: 10px;">'+val.etd+' Hari</span>';
		          paket += 	'</td>';
		          paket += 	'<td>';
		          paket +=		''+val.cost;
		          paket += 	'</td>';
		          paket += 	'<td>';
		          paket +=		'<div class="form-check">';
		          paket +=			'<input class="form-check-input position-static paket_pengiriman" type="radio" name="paket_pengiriman" id="paket_pengiriman'+count+'" value="'+val.service+'" data-description="'+val.description+'" data-etd="'+val.etd+'" data-cost="'+val.cost+'">';
		          paket +=		'</div>';
		          paket += 	'</td>';
		          paket += '</tr>';

		          $("#tbody_paket_pengiriman").append(paket);
          		$("#tfoot_kosong").hide();
		        })
	        } else {
	        	$("#tfoot_kosong").show();
	        	$("#tfoot_kosong > tr > td").html('Tidak Ada Paket Pengiriman');
	        }
        }
      });
		}
	})

	$(document).on("change", ".paket_pengiriman", function() {
		var nama_paket = $(this).val();
		var desk_paket = $(this).data('description');
		var etd_paket = $(this).data('etd');
		var cost_paket = Number($(this).data('cost'));
		$("#ip_desk_paket").val(desk_paket);
		$("#ip_etd_paket").val(etd_paket);
		$("#ip_cost_paket").val(cost_paket);

		var total_bayar = total_belanja + cost_paket;
		$("#total_ongkir").text(cost_paket);
		$("#total_bayar").text(total_bayar);
		$("#ip_total_bayar").val(total_bayar);
		// alert(nama_paket+" / "+cost_paket+" / "+desk_paket+" / "+etd_paket);
	})

	$("#tmb_simpanperubahan").click(function() {
		var no_penjualan = $("#no_penjualan").val();
		var nm_penerima = $("#nm_penerima").val();
		var no_hpaktif = $("#no_hpaktif").val();
		var almt_lengkap = $("#almt_lengkap").val();
		var kd_pos = $("#kd_pos").val();
		var ip_provinsi = $("#ip_provinsi").val();
		var jasa_pengirim = $("input[name='jasa_pengirim']:checked").val()
		var ip_cost_paket = $("#ip_cost_paket").val();

		if(nm_penerima == "") {
			$("#nm_penerima").focus();
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi nama penerima dengan lengkap',
        'warning'
      )
		}
		else if(no_hpaktif == "") {
			$("#no_hpaktif").focus();
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi no hp penerima dengan lengkap',
        'warning'
      )
		}
		else if(almt_lengkap == "") {
			$("#almt_lengkap").focus();
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi alamat penerima dengan lengkap',
        'warning'
      )
		}
		else if(kd_pos == "") {
			$("#kd_pos").focus();
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi kode pos penerima dengan lengkap',
        'warning'
      )
		}
		else if(ip_provinsi == "") {
			$("#provinsi_tujuan").focus();
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong pilih provinsi penerima dulu',
        'warning'
      )
		}
		else if(typeof jasa_pengirim === "undefined") {
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong pilih jasa pengiriman dulu',
        'warning'
      )
		}
		else if(ip_cost_paket == "") {
			Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong pilih jenis paket pengiriman dulu',
        'warning'
      )
		}
		else {
			var form_data = $("#form_ubahalamat").serialize();
      $.ajax({
        url: "usrajax/ubah_datapenerima.php",
        method: "POST",
        data: form_data,
        success:function(data) {
          // window.location='?page=pembayaran&nopenjualan='+no_penjualan;
          // window.open("laporan/?page=nota_penjualan&no_pjl="+no_penjualan);
          location.reload();
          // alert('berhasil');
        }
    	})
		}
	})

	$("#halaman_konfirmasi").click(function() {
		var no_penjualan = $("#no_penjualan").val();
		Swal.fire({
        title: 'Konfirmasi',
        text: 'apakah anda yakin telah melakukan transfer pembayaran ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((yakin) => {
        if (yakin.value) {
          window.location="?page=konfirmasipembayaran&nopenjualan="+no_penjualan;
        }
      })
	})
</script>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>