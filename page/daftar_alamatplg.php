<?php 
	$kode_plg = @$_GET['kode_plg'];
  if($kode_plg && @$_SESSION['kode_plg'] && @$_SESSION['kode_plg']==$kode_plg) {
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Alamat</li>
  </ol>
</nav>
<div class="row kontainer-register">
  <h5>Daftar Alamat Tersimpan</h5>
  <div class="table-responsive">
	  <table class="table table-bordered" id="example1" style="font-size: 12px;">
	  	<thead>
	  		<tr>
	  			<th>#</th>
	  			<th>Penerima</th>
	  			<th>Alamat</th>
	  			<th>Kode Pos</th>
	  			<th>Provinsi</th>
	  			<th>Kab/kota</th>
	  			<th>Status</th>
	  			<th>Opsi</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<?php 
	  			$nomor = 1;
	  			$query_alamat = "SELECT * FROM tbl_alamatplg WHERE kode_plg = '$kode_plg'";
          $sql_alamat = mysqli_query($conn, $query_alamat) or die ($conn->error);
          while($data_alamat = mysqli_fetch_array($sql_alamat)) {
	  		?>
	  				<tr>
	  					<td><?=$nomor++?></td>
	  					<td><?=$data_alamat['nama_alamatplg']?> <br> <small><i>(<?=$data_alamat['nohp_alamatplg']?>)</i></small></td>
	  					<td><?=$data_alamat['alamat_plg']?></td>
	  					<td><?=$data_alamat['kodepos_alamatplg']?></td>
	  					<td><?=$data_alamat['provinsi_alamatplg']?></td>
	  					<td><?=$data_alamat['kabkota_alamatplg']?></td>
	  					<td><?=$data_alamat['status_alamatplg']?></td>
	  					<td align="center">
	  						<button class="btn btn-sm btn-info tmb_edit" style="font-size: 10px;" title="ubah alamat" data-toggle="modal" data-target="#modal_ubahalamat"
	  							data-id_alamatplg = "<?=$data_alamat['id_alamatplg']?>"
	  							data-nama_alamatplg = "<?=$data_alamat['nama_alamatplg']?>"
	  							data-nohp_alamatplg = "<?=$data_alamat['nohp_alamatplg']?>"
	  							data-alamat_plg = "<?=$data_alamat['alamat_plg']?>"
	  							data-kodepos_alamatplg = "<?=$data_alamat['kodepos_alamatplg']?>"
	  							data-provinsi_alamatplg = "<?=$data_alamat['provinsi_alamatplg']?>"
	  							data-id_provinsi = "<?=$data_alamat['id_provinsi']?>"
	  							data-status_alamatplg = "<?=$data_alamat['status_alamatplg']?>"
	  						>
	  							<i class="fas fa-edit"></i> ubah
	  						</button>
	  					</td>
	  				</tr>
	  		<?php 
	  			} 
	  		?>
	  	</tbody>
	  </table>
  </div>
</div>

<div class="modal fade modal_ubahalamat" id="modal_ubahalamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Ubah Data Alamat</h6>
        <button type="button" class="close" id="close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_ubahalamat">
          <form method="POST" autocomplete="off" id="form_ubahalamat" enctype="multipart/form-data" style="font-size: 12px;">
            <div class="form-group">
					  	<input type="hidden" id="id_alamatplg" name="id_alamatplg">
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
		          <label for="status_alamatplg">Status</label>
		          <div class="form-check">
		            <input class="form-check-input" type="radio" name="status_alamatplg" id="alamat_aktif" value="Aktif">
		            <label class="form-check-label" for="alamat_aktif">
		              Aktif
		            </label>
		          </div>
		          <div class="form-check">
		            <input class="form-check-input" type="radio" name="status_alamatplg" id="alamat_nonaktif" value="Non-aktif">
		            <label class="form-check-label" for="alamat_nonaktif">
		              Non-aktif
		            </label>
		          </div>
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
  $(".tmb_edit").click(function() {
  	var id_alamatplg = $(this).data('id_alamatplg');
  	var nama_alamatplg = $(this).data('nama_alamatplg');
  	var nohp_alamatplg = $(this).data('nohp_alamatplg');
  	var alamat_plg = $(this).data('alamat_plg');
  	var kodepos_alamatplg = $(this).data('kodepos_alamatplg');
  	var id_provinsi = $(this).data('id_provinsi');
  	var provinsi_alamatplg = $(this).data('provinsi_alamatplg');
  	var status_alamatplg = $(this).data('status_alamatplg');

  	$("#id_alamatplg").val(id_alamatplg);
  	$("#nm_penerima").val(nama_alamatplg);
  	$("#no_hpaktif").val(nohp_alamatplg);
  	$("#almt_lengkap").val(alamat_plg);
  	$("#kd_pos").val(kodepos_alamatplg);
  	if(status_alamatplg == 'Aktif') {
  		$("#alamat_aktif").attr("checked", true);
  		$("#alamat_nonaktif").attr("checked", false);
  	} else if(status_alamatplg == 'Non-aktif') {
  		$("#alamat_nonaktif").attr("checked", true);
  		$("#alamat_aktif").attr("checked", false);
  	}

  	$("#provinsi_tujuan").val(id_provinsi);
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
	})

	$("#tmb_simpanperubahan").click(function() {
		var nm_penerima = $("#nm_penerima").val();
		var no_hpaktif = $("#no_hpaktif").val();
		var almt_lengkap = $("#almt_lengkap").val();
		var kd_pos = $("#kd_pos").val();
		var ip_provinsi = $("#ip_provinsi").val();

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
		else {
			var form_data = $("#form_ubahalamat").serialize();
      $.ajax({
        url: "usrajax/ubah_alamatplg.php",
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
</script>
<?php } else {?>
  <script>
    window.location="./";
  </script>
<?php } ?>