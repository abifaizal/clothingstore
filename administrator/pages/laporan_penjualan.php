<section class="content-header">
  <h1>
    Halaman Membuat Laporan Penjualan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Laporan Penjualan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      
    </div>
    <style>
    	#form_laporanpenjualan label {
    		text-align: left;
    	}
    </style>
    <form class="form-horizontal" action="" method="POST" target="blank" id="form_laporanpenjualan" autocomplete="off">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box-body">
            <div class="form-group">
            	<div class="col-sm-3">
	              <label for="jns_periode" class="control-label">Jenis Periode</label>
	            </div>
              <div class="col-sm-9">
                <div class="row">
                	<div class="col-sm-4 radio">
	                  <label>
	                    <input type="radio" name="jns_periode" id="hari_ini" value="Hari ini" checked=""> Hari ini
	                  </label>
	                </div>
	                <div class="col-sm-4 radio">
	                  <label>
	                    <input type="radio" name="jns_periode" id="bulan_ini" value="Bulan ini"> Bulan ini
	                  </label>
	                </div>
	                <div class="col-sm-4 radio">
	                  <label>
	                    <input type="radio" name="jns_periode" id="tahun_ini" value="Tahun ini"> Tahun ini
	                  </label>
	                </div>
	                <div class="col-sm-4 radio">
	                  <label>
	                    <input type="radio" name="jns_periode" id="per_tanggal" value="per_tanggal"> Pilih Tanggal
	                  </label>
	                </div>
	                <div class="col-sm-4 radio">
	                  <label>
	                    <input type="radio" name="jns_periode" id="per_bulan" value="per_bulan"> Pilih Bulan
	                  </label>
	                </div>
	                <div class="col-sm-4 radio">
	                  <label>
	                    <input type="radio" name="jns_periode" id="per_tahun" value="per_tahun"> Pilih Tahun
	                  </label>
	                </div>
                </div>
              </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-3">
              	<label for="tgl_awal" class="control-label">Pilih Tanggal</label>
              	<div id="div_tglakhir" style="display: none;">
              		<input type="checkbox" name="tglakhir_aktif" id="tglakhir_aktif" value="aktif"> tanggal akhir
              	</div>
              </div>
              <div class="col-sm-9">
                <div class="input-group" style="margin-bottom: 5px;">
	                <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" readonly>
	                <span class="input-group-addon">tanggal awal</span>
	              </div>
                <div class="input-group">
	                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" readonly>
	                <span class="input-group-addon">tanggal akhir</span>
	              </div>
              </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-3">
              	<label for="bulan_awal" class="control-label">Pilih Bulan</label>
              	<div id="div_blnakhir" style="display: none;">
              		<input type="checkbox" name="blnakhir_aktif" id="blnakhir_aktif" value="aktif"> bulan akhir
              	</div>
              </div>
              <div class="col-sm-9">
                <div class="row">
                	<div class="col-xs-6">
                		<select name="bulan_awal" id="bulan_awal" class="form-control" readonly style="margin-bottom: 5px;">
							      	<option value="01">Januari</option>
							      	<option value="02">Februari</option>
							      	<option value="03">Maret</option>
							      	<option value="04">April</option>
							      	<option value="05">Mei</option>
							      	<option value="06">Juni</option>
							      	<option value="07">Juli</option>
							      	<option value="08">Agustus</option>
							      	<option value="09">September</option>
							      	<option value="10">Oktober</option>
							      	<option value="11">November</option>
							      	<option value="12">Desember</option>
							      </select>
							      <select name="bulan_akhir" id="bulan_akhir" class="form-control" readonly>
							      	<option value="01">Januari</option>
							      	<option value="02">Februari</option>
							      	<option value="03">Maret</option>
							      	<option value="04">April</option>
							      	<option value="05">Mei</option>
							      	<option value="06">Juni</option>
							      	<option value="07">Juli</option>
							      	<option value="08">Agustus</option>
							      	<option value="09">September</option>
							      	<option value="10">Oktober</option>
							      	<option value="11">November</option>
							      	<option value="12">Desember</option>
							      </select>
                	</div>
                	<div class="col-xs-4">
                		<select name="bulanthn_awal" id="bulanthn_awal" class="form-control" readonly style="margin-bottom: 5px;">
							      	<?php 
							      		$tahun_ini = date('Y');
							      		for($i=$tahun_ini; $i>=2016; $i--) {
							      	?>
								      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								     	<?php } ?>
							      </select>
							      <select name="bulanthn_akhir" id="bulanthn_akhir" class="form-control" readonly >
								    	<?php 
							      		$tahun_ini = date('Y');
							      		for($i=$tahun_ini; $i>=2016; $i--) {
							      	?>
								      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								     	<?php } ?>
							      </select>
                	</div>
                </div>
              </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-3">
              	<label for="tahun_awal" class="control-label">Pilih Tahun</label>
              	<div id="div_thnakhir" style="display: none;">
              		<input type="checkbox" name="thnakhir_aktif" id="thnakhir_aktif" value="aktif"> tahun akhir
              	</div>
              </div>
              <div class="col-sm-3">
            		<select name="tahun_awal" id="tahun_awal" class="form-control" readonly style="margin-bottom: 5px;">
					      	<?php 
					      		$tahun_ini = date('Y');
					      		for($i=$tahun_ini; $i>=2016; $i--) {
					      	?>
						      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						     	<?php } ?>
					      </select>
					      <select name="tahun_akhir" id="tahun_akhir" class="form-control" readonly>
						    	<?php 
					      		$tahun_ini = date('Y');
					      		for($i=$tahun_ini; $i>=2016; $i--) {
					      	?>
						      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						     	<?php } ?>
					      </select>
            	</div>
            </div>
            <div class="form-group">
            	<div class="col-sm-3">
	              <label for="jns_transaksi" class="control-label">Jenis Transaksi</label>
	            </div>
              <div class="col-sm-9">
              	<div class="radio">
                  <label>
                    <input type="radio" name="jns_transaksi" id="semua_trans" value="Semua" checked=""> Semua
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="jns_transaksi" id="offline_trans" value="Offline"> Offline
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="jns_transaksi" id="online_trans" value="Online"> Online
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-3">
                <label for="bt_laporan" class="control-label">Bentuk Laporan</label>
              </div>
              <div class="col-sm-9">
                <div class="radio">
                  <label>
                    <input type="radio" name="bt_laporan" id="laporan_rangkuman" value="Rangkuman" checked=""> Rangkuman
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="bt_laporan" id="laporan_detail" value="Detail"> Detail
                  </label>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-right">
            <!-- <button type="button" class="btn btn-success">Simpan</button> -->
            <input type="button" name="cetak" id="cetak" class="btn btn-success" value="Cetak Laporan">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<script>
	var id_tglakhir = 0;
  var id_bulanakhir = 0;
  var id_tahunakhir = 0;

  function alldisable() {
    $("#tgl_awal").attr("readonly", true);
    $("#tgl_akhir").attr("readonly", true);
    $("#bulan_awal").attr("readonly", true);
    $("#bulanthn_awal").attr("readonly", true);
    $("#bulan_akhir").attr("readonly", true);
    $("#bulanthn_akhir").attr("readonly", true);
    $("#tahun_awal").attr("readonly", true);
    $("#tahun_akhir").attr("readonly", true);
    $("#div_tglakhir").hide();
    $("#div_blnakhir").hide();
    $("#div_thnakhir").hide();
    $("#tglakhir_aktif").prop('checked', false);
    id_tglakhir = 0;
    $("#blnakhir_aktif").prop('checked', false);
    id_bulanakhir = 0;
    $("#thnakhir_aktif").prop('checked', false);
    id_tahunakhir = 0;
  };

  $('#hari_ini').click(function() {
    alldisable();
  });

  $('#bulan_ini').click(function() {
    alldisable();
  });

  $('#tahun_ini').click(function() {
    alldisable();
  });

  $('#per_tanggal').click(function() {
    alldisable();
    $("#tgl_awal").attr("readonly", false);
    $("#div_tglakhir").show();
  });

  $('#per_bulan').click(function() {
    alldisable();
    $("#bulan_awal").attr("readonly", false);
    $("#bulanthn_awal").attr("readonly", false);
    $("#div_blnakhir").show();
  });

  $('#per_tahun').click(function() {
    alldisable();
    $("#tahun_awal").attr("readonly", false);
    $("#div_thnakhir").show();
  });

  $("#tglakhir_aktif").click(function() {
    if(id_tglakhir == 0) {
      $("#tgl_akhir").attr("readonly", false);
      id_tglakhir = 1;
    } else {
      $("#tgl_akhir").attr("readonly", true);
      $("#tgl_akhir").val("");
      id_tglakhir = 0;
    }
  });

  $("#blnakhir_aktif").click(function() {
    if(id_bulanakhir == 0) {
      $("#bulan_akhir").attr("readonly", false);
      $("#bulanthn_akhir").attr("readonly", false);
      id_bulanakhir = 1;
    } else {
      $("#bulan_akhir").attr("readonly", true);
      $("#bulanthn_akhir").attr("readonly", true);
      id_bulanakhir = 0;
    }
  });

  $("#thnakhir_aktif").click(function() {
    if(id_tahunakhir == 0) {
      $("#tahun_akhir").attr("readonly", false);
      id_tahunakhir = 1;
    } else {
      $("#tahun_akhir").attr("readonly", true);
      id_tahunakhir = 0;
    }
  });

  function cetak(action) {
    var form = document.getElementById("form_laporanpenjualan");
    form.action = action;
    form.submit();
  }

  $("#cetak").click(function() {
    var bentuk = $("input[name='bt_laporan']:checked").val();
    var form_data = $("#form_laporanpenjualan").serialize();
    $.ajax({
      url: 'ajax/cek_laporanpenjualan.php',
      method: 'POST',
      data: form_data,
      success:function(data) {
        if(data=="kosong") {
          Swal.fire({
            title: 'Kosong',
            text: 'maaf, tidak ditemukan transaksi dengan kriteria tersebut',
            type: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          }).then((ok) => {})
        } 
        else {
          if(bentuk == "Detail") {  
            cetak('../arsip/?page=laporan_penjualan_detail');
          }
          else {
            cetak('../arsip/?page=laporan_penjualan_rangkuman');
          }
        }
      }
    });
  });
</script>