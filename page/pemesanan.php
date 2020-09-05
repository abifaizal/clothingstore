<?php 
  $kode_plg = @$_SESSION['kode_plg'];
  $query_krj = "SELECT * FROM tbl_keranjang INNER JOIN tbl_keranjangdetail ON tbl_keranjang.id_keranjang = tbl_keranjangdetail.id_keranjang INNER JOIN tbl_produk ON tbl_keranjangdetail.id_prd = tbl_produk.id_prd WHERE tbl_keranjang.kode_plg = '$kode_plg'";
  $sql_krj = mysqli_query($conn, $query_krj) or die ($conn->error);
  $rows = mysqli_num_rows($sql_krj);
  if($rows>0) {
 ?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="./">Home</a></li>
		<li class="breadcrumb-item"><a href="?page=keranjang">Keranjang</a></li>
		<li class="breadcrumb-item active" aria-current="page">Order</li>
	</ol>
</nav>

<div class="row">
	<div class="col-12 col-md-4">
		<table class="table checkout table-bordered">
			<thead>
				<tr>
					<th colspan="2">Produk</th>
					<th>Qty</th>
					<th>Total</th>
				</tr>
			</thead>
			<?php 
        $total = 0;
        $berat_total = 0;
        while($data_krj = mysqli_fetch_array($sql_krj)) {
      ?>
			<tr>
				<td>
					<div class="foto-produk">
            <img src="img/produk/<?php echo $data_krj['gambar_prd']; ?>" class="card-img-top" alt="...">
          </div>
				</td>
				<td>
					<?php 
              $harga_prd = $data_krj['harga_prd'];
              $diskon_prd = $data_krj['diskon_prd'];
              $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
              $berat_prd = $data_krj['berat_prd'];
              $jml_prd = $data_krj['jml_prd'];
              $sub_berat = $berat_prd * $jml_prd;

              $id_prd = $data_krj['id_prd'];
              $id_ukuran = $data_krj['id_ukuran'];
              $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND id_ukuran = '$id_ukuran'";
              $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
              $data_ukuran = mysqli_fetch_array($sql_ukuran);
            ?>
					<?php echo $data_krj['nama_prd']; ?> <br>
					Size : <?php echo $data_ukuran['keterangan_ukr']; ?> <br>
					Harga : Rp <?php echo number_format($harga_akhir); ?> <br>
					Berat : <?php echo $data_krj['berat_prd']; ?>gr
				</td>
				<td>
					<?php echo $data_krj['jml_prd']; ?>
				</td>
				<td>
				<?php 
          $jml_prd = $data_krj['jml_prd'];
          $subtotal = $harga_akhir * $jml_prd;
        ?>
					Rp. <?php echo number_format($subtotal); ?>
				</td>
				<?php 
          $total = $total + $subtotal;
          $berat_total = $berat_total + $sub_berat;
        ?>
			</tr>
			<?php } ?>
			<tr>
				<th colspan="3">
					Total Akhir
				</th>
				<th>
					Rp <?php echo number_format($total); ?>
				</th>
			</tr>
			<tr>
				<td colspan="4">
					<i>*belum termasuk ongkir</i>
				</td>
			</tr>
		</table>

		<table class="table table-bordered tabel-alamat-tersimpan" style="font-size: 10px;">
			<thead>
				<tr>
					<th colspan="2">Riwayat alamat pengiriman sebelumnya</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query_alamat = "SELECT * FROM tbl_alamatplg WHERE kode_plg = $kode_plg AND status_alamatplg = 'Aktif'";
					$sql_alamat = mysqli_query($conn, $query_alamat) or die ($conn->error);
					$row_alamat = mysqli_num_rows($sql_alamat);
					if($row_alamat > 0) { 
						while($data_alamat = mysqli_fetch_array($sql_alamat)) {
				?>
							<tr>
								<td>
									<?=$data_alamat['nama_alamatplg']?> (<?=$data_alamat['nohp_alamatplg']?>) <br>
									<?=$data_alamat['alamat_plg']?> <br>
									kode pos : <?=$data_alamat['kodepos_alamatplg']?> <br>
									Prov : <?=$data_alamat['provinsi_alamatplg']?> <br>
									Kab/kota : <?=$data_alamat['kabkota_alamatplg']?>
								</td>
								<td align="center">
									<button class="btn btn-sm btn-dark pilih_alamat" style="font-size: 8px;"
										data-nama_alamatplg = "<?=$data_alamat['nama_alamatplg']?>"
										data-nohp_alamatplg = "<?=$data_alamat['nohp_alamatplg']?>"
										data-alamat_plg = "<?=$data_alamat['alamat_plg']?>"
										data-kodepos_alamatplg = "<?=$data_alamat['kodepos_alamatplg']?>"
										data-id_provinsi = "<?=$data_alamat['id_provinsi']?>"
									>
										pilih
									</button>
								</td>
							</tr>
				<?php 
						}
					} 
					else {
				?>
						<tr>
							<td colspan="2" align="center">Belum ada data</td>
						</tr>
				<?php 
					} 
				?>
			</tbody>
		</table>
	</div>
	<div class="col-12 col-md-8 data-pemesanan">
		<!-- <div class="alert alert-dark" role="alert">
		  Total yang harus anda bayar adalah <b>Rp 180.000</b>
		</div> -->
		<?php 
      // MENENTUKAN NOMOR PENJUALAN
      $tgl_penjualan = date('Y-m-d');
      $hari= substr($tgl_penjualan, 8, 2);
      $bulan = substr($tgl_penjualan, 5, 2);
      $tahun = substr($tgl_penjualan, 0, 4);
      $tgl = $tahun.$bulan.$hari;
      $carikode = mysqli_query($conn, "SELECT MAX(no_penjualan) FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_penjualan'") or die (mysql_error());
      $datakode = mysqli_fetch_array($carikode);
      if($datakode) {
          $nilaikode = substr($datakode[0], 13);
          $kode = (int) $nilaikode;
          $kode = $kode + 1;
          $no_penjualan = "PJL/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
      } else {
          $no_penjualan = "PJL/".$tgl."/001";
      }
    ?>
		<div class="form-datapemesanan">
			<h6>Tolong Lengkapi Form Berikut untuk melanjutkan pemesanan</h6>
			<form method="POST" id="form_order" autocomplete="off" enctype="multipart/form-data">
			  <div class="form-group">
			  	<input type="hidden" id="no_penjualan" name="no_penjualan" value="<?php echo $no_penjualan; ?>">
			  	<input type="hidden" id="berat_kiriman" name="berat_kiriman" value="<?php echo $berat_total; ?>">
			    <label for="nm_penerima">Nama Penerima</label>
			    <input type="text" class="form-control form-control-sm" name="nm_penerima" id="nm_penerima" placeholder="cth: Budi Ramadhan" autofocus="">
			  </div>
			  <div class="form-group">
			    <label for="no_hpaktif">No HP aktif</label>
			    <input type="text" class="form-control form-control-sm" name="no_hpaktif" id="no_hpaktif" placeholder="cth: 085333461216">
			  </div>
			  <div class="form-group">
			    <label for="almt_lengkap">Alamat Lengkap</label>
			    <textarea class="form-control form-control-sm" name="almt_lengkap" id="almt_lengkap" rows="3" placeholder="cth: Jl. Bhayangkara No.01, Panggel, Kembaran, Kec. Kebumen, Kabupaten Kebumen, Jawa Tengah."></textarea>
			  </div>
			  <div class="form-group">
			    <label for="kd_pos">Kode Pos</label>
			    <input type="text" class="form-control form-control-sm" name="kd_pos" id="kd_pos" placeholder="cth: 55161">
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
			      	<option value="<?php echo $array_prov[$i]['id']; ?>" id="prov_<?php echo $array_prov[$i]['id']; ?>" data-namaprov="<?php echo $array_prov[$i]['name']; ?>">
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
			  	<div class="custom-control custom-switch">
					  <input type="checkbox" class="custom-control-input" id="check_alamatbaru" name="check_alamatbaru" value="simpan_alamatbaru" checked="">
					  <label class="custom-control-label" for="check_alamatbaru">Simpan sebagai alamat baru</label>
					</div>
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
			    <table class="table table-bordered" style="font-size: 12px;">
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
			    <table class="table table-bordered">
			    	<tr>
			    		<td>Total Belanja</td>
			    		<th style="text-align: right;">Rp <span id="total_belanja"><?php echo $total; ?></span></th>
			    	</tr>
			    	<tr>
			    		<td>Total Ongkir</td>
			    		<th style="text-align: right;">Rp <span id="total_ongkir">-</span></th>
			    	</tr>
			    	<tr>
			    		<th>Total Bayar</th>
			    		<th style="text-align: right;">Rp <span id="total_bayar"><?php echo $total; ?></span></th>
			    	</tr>
			    </table>
			    <input type="hidden" name="ip_total_belanja" id="ip_total_belanja" value="<?php echo $total; ?>">
			    <input type="hidden" name="ip_total_bayar" id="ip_total_bayar" value="<?php echo $total; ?>">
			  </div>
			  
			  <div class="form-group" style="text-align: right;">
			  	<button type="button" class="btn btn-dark" id="tmb_lanjutpembayaran" style="font-size: 14px;">Lanjutkan Pembayaran</button>
			  </div>
			</form>
		</div>
	</div>
</div>

<script>
	var total_belanja = Number(<?php echo $total; ?>);
	var berat_total = <?php echo $berat_total; ?>;

	function ip_kabkota() {
		var nama_kota = $("#kota_kab").find(':selected').data('namakota');
		$("#ip_kabkota").val(nama_kota);
	}

	$(".pilih_alamat").click(function() {
		var nama_alamatplg = $(this).data('nama_alamatplg');
		var nohp_alamatplg = $(this).data('nohp_alamatplg');
		var alamat_plg = $(this).data('alamat_plg');
		var kodepos_alamatplg = $(this).data('kodepos_alamatplg');
		var id_provinsi = $(this).data('id_provinsi');

		$("#nm_penerima").val(nama_alamatplg);
		$("#no_hpaktif").val(nohp_alamatplg);
		$("#almt_lengkap").val(alamat_plg);
		$("#kd_pos").val(kodepos_alamatplg);
		$("#check_alamatbaru").attr('checked', false);
		$("#prov_"+id_provinsi).attr('selected', true);
		$("#provinsi_tujuan").change();
	})

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
	          option_city = '<option value="'+val.name+'" id="kabkota_'+val.id+'" data-idkota="'+val.id+'">'+val.name+' ('+val.type+')</option>';
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
          // console.log(objData);
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

	$("#tmb_lanjutpembayaran").click(function() {
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
        'maaf, tolong pilih jenis paket pengirima dulu',
        'warning'
      )
		}
		else {
			var form_data = $("#form_order").serialize();
      Swal.fire({
        title: 'Peringatan cek kembali produk pilihan anda.',
        text: 'produk yang telah anda pilih tidak dapat diubah lagi, tapi data penerima dan alamat masih dapat diubah. lanjutkan ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((simpan) => {
        if (simpan.value) {
          $.ajax({
              url: "usrajax/simpan_penjualanuser.php",
              method: "POST",
              data: form_data,
              success:function(data) {
                window.location='?page=pembayaran&nopenjualan='+no_penjualan;
                // window.open("laporan/?page=nota_penjualan&no_pjl="+no_penjualan);
                // location.reload();
                // alert('berhasil');
              }
          })
        }
      })
		}
	})
</script>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>