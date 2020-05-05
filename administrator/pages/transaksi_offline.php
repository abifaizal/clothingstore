<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Transaksi Penjualan Offline
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li><a href="?page=data_transaksi_offline">Data Penjualan Offline</a></li>
    <li class="active">Transaksi Penjualan Offline</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box box-transaksi">
    <div class="box-header text-right">
      <a href="?page=data_transaksi_offline">
        <button class="btn btn-primary btn-sm">
          Daftar Transaksi
        </button>
      </a>
    </div>
    <div class="box-body">
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
      <form action="" autocomplete="off" id="form_transaksi_penjualan">
        <div class="row bagian-atas">
          <div class="col-md-4">
            <div class="form-group">
              <label>No Penjualan :</label> <span><?php echo $no_penjualan; ?></span>
              <input type="hidden" id="no_penjualan" name="no_penjualan" value="<?php echo $no_penjualan; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal :</label> <span><?php echo date('d M Y'); ?></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pegawai :</label> <span><?php echo $_SESSION['username_pgw']; ?></span>
            </div>
          </div>
        </div>
        <div class="row bagian-bawah">
          <div class="col-md-3 form-produk">
            <div class="form-group">
              <label for="id_prd">ID Produk</label>
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" id="id_prd" placeholder="masukkan ID produk" autofocus="">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default btn-flat" id="tmb_produk" title="daftar produk" data-toggle="modal" data-target="#modal_daftarproduk">cari</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="nama_prd">Nama Produk</label>
              <input type="text" class="form-control input-sm" id="nama_prd" placeholder="nama produk" readonly="">
            </div>
            <div class="form-group">
              <label for="harga_prd">Harga <span style="display: none;" id="tag_diskon">(diskon <span id="besar_diskon"></span>%)</span></label>
              <input type="number" class="form-control input-sm" id="harga_prd" placeholder="harga produk" readonly="">
            </div>
            <div class="form-group">
              <label for="ukuran_beli">Pilih Ukuran</label>
              <select class="form-control input-sm" id="ukuran_beli">
                <option value="0">pilih ukuran</option>
              </select>
              <input type="hidden" id="stok_produk">
            </div>
            <div class="form-group">
              <label for="jml_beli">Jumlah</label>
              <input type="number" class="form-control input-sm" id="jml_beli" placeholder="masukkan jumlah">
            </div>
            <div class="form-group">
              <label for="subtotal_beli">Subtotal</label>
              <input type="number" class="form-control input-sm" id="subtotal_beli" placeholder="jumlah subtotal" readonly="">
            </div>
            <div class="form-group text-right">
              <button type="button" class="btn btn-danger btn-sm" id="tmb_reset">RESET</button>
               <button type="button" class="btn btn-success btn-sm" id="tmb_keranjang">TAMBAH</button>
            </div>
          </div>
          <div class="col-md-9 tbl-keranjang">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody id="tbody_keranjang">
                  
                </tbody>
                <tfoot>
                  <tr id="tr_nodata">
                    <td colspan="6" class="text-center">belum ada data</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div style="border: 1px solid #D2D6DE; margin: 5px 0;"></div>
        <div class="row bagian-bayar">
          <div class="col-md-2 col-md-offset-4">
            <div class="form-group">
              <label for="total_trans">Total</label>
              <!-- <input type="number" class="form-control input-sm" id="total_trans" placeholder="total transaksi" readonly=""> -->
              <div class="total-trans">
                Rp <span id="total_trans">0</span>
                <input type="hidden" id="total_penjualan" name="total_penjualan">
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="diskon_tran">Diskon</label>
              <div class="input-group">
                <input type="number" class="form-control input-sm" id="diskon_tran" name="diskon_tran" placeholder="0">
                <span class="input-group-addon">%</span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="jml_bayar">Bayar</label>
              <input type="number" class="form-control input-sm" id="jml_bayar" name="jml_bayar" placeholder="jumlah uang">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="kembalian_tran">Kembalian</label>
              <input type="text" class="form-control input-sm" id="kembalian_tran" name="kembalian_tran" placeholder="jumlah kembalian" readonly="">
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-right">
      <button type="button" class="btn btn-primary" id="simpan_penjualan">SIMPAN TRANSAKSI</button>
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<div class="modal fade" id="modal_daftarproduk">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Daftar Produk</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped" style="font-size: 12px;">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 1;
              $qry_produk = "SELECT * FROM tbl_produk ORDER BY nama_prd ASC";
              $sql_produk = mysqli_query($conn, $qry_produk) or die ($conn->error);
              while($data_produk = mysqli_fetch_array($sql_produk)) {
                $gambar = $data_produk['gambar_prd'];
            ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data_produk['id_prd']; ?></td>
                  <td><?php echo $data_produk['nama_prd']; ?></td>
                  <td>
                    <div class="foto-produk" >
                      <img src="../img/produk/<?php echo $gambar; ?>" class="card-img-top" alt="..." style="width: 40px;">
                    </div>
                  </td>
                  <td><?php echo $data_produk['stok_prd']; ?></td>
                  <td><?php echo $data_produk['kategori_prd']; ?></td>
                  <td><?php echo number_format($data_produk['harga_prd']); ?></td>
                  <td><?php echo $data_produk['diskon_prd']; ?>%</td>
                  <td class="text-center">
                    <button class="btn btn-xs btn-primary tmb_pilih_produk" id="tmb_pilih_produk" title="detail" 
                      data-idprd = "<?php echo $data_produk['id_prd']; ?>"
                      data-nama = "<?php echo $data_produk['nama_prd']; ?>"
                      data-harga = "<?php echo $data_produk['harga_prd']; ?>"
                      data-diskon = "<?php echo $data_produk['diskon_prd']; ?>"
                      data-stok = "<?php echo $data_produk['stok_prd']; ?>"
                      <?php 
                        $id_prd = $data_produk['id_prd'];
                        $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND stok_ukr > 0";
                        $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
                        $count = mysqli_num_rows($sql_ukuran);
                      ?>
                        data-ukuran = "<?php echo $count ?>"
                      <?php
                        $i = 1;
                        if($count>0) {
                          while($data_ukuran = mysqli_fetch_array($sql_ukuran)) {
                      ?>
                            data-idukr<?php echo $i; ?> = "<?php echo $data_ukuran['id_ukuran'] ?>"
                            data-ktukr<?php echo $i; ?> = "<?php echo $data_ukuran['keterangan_ukr'] ?>"
                            data-stukr<?php echo $i; ?> = "<?php echo $data_ukuran['stok_ukr'] ?>"
                      <?php
                            $i++;
                          }
                        }
                      ?>
                      >
                      pilih
                    </button>
                  </td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  var count = 0;
  var total_jual = 0;

  function reset() {
    $("#id_prd").val('');
    $("#nama_prd").val('');
    $("#harga_prd").val('');
    $("#jml_beli").val('');
    $("#subtotal_beli").val('');
    $("#ukuran_beli").html('<option value="0">pilih ukuran</option>');
    $("#stok_produk").val('');
    $("#tag_diskon").hide();
    document.getElementById("id_prd").focus();
  }

  $(document).on("click", "#tmb_pilih_produk", function() {
    var id = $(this).data('idprd');
    var nama = $(this).data('nama');
    var harga = Number($(this).data('harga'));
    var diskon = Number($(this).data('diskon'));
    var stok = $(this).data('stok');
    var ukuran = $(this).data('ukuran');

    $("#id_prd").val(id);
    $("#nama_prd").val(nama);
    if(diskon > 0) {
      $("#tag_diskon").show();
      $("#besar_diskon").text(diskon);
      harga = harga - (harga * (diskon / 100));
    } else {
      $("#tag_diskon").hide();
      $("#besar_diskon").text(diskon);
    }
    $("#harga_prd").val(harga);
    $("#jml_beli").val('1');
    $("#subtotal_beli").val(harga);

    $("#ukuran_beli").html('');
    if(ukuran>0) {
      for(var i=1; i<=ukuran; i++) {
        var idukr = $(this).data('idukr'+i+'');
        var ktukr = $(this).data('ktukr'+i+'');
        var stukr = $(this).data('stukr'+i+'');
        var option = '';
        option = '<option value="'+idukr+'" data-nmukr="'+ktukr+'" data-stok="'+stukr+'">'+ktukr+' ('+stukr+')</option>';
        $("#ukuran_beli").append(option);
        if(i==1) {
          $("#stok_produk").val(stukr);
        }
      }
    }

    $("#modal_close").click();
  })

  $("#id_prd").keyup(function() {
    var id_prd = $(this).val();
    event.preventDefault();
    if (event.keyCode === 13) {
      $("#nama_prd").val('');
      $("#harga_prd").val('');
      $("#jml_beli").val('');
      $("#subtotal_beli").val('');
      $("#stok_produk").val('');
      $("#ukuran_beli").html('<option value="0">pilih ukuran</option>');

      if(id_prd == '') {
        document.getElementById("id_prd").focus();
        Swal.fire(
          'Peringatan Belum Lengkap',
          'mohon masukkan id produk',
          'warning'
        )
      } 
      else {
        $.ajax({
          type : "GET",
          url : "ajax/cariproduk.php?page=data_produk",
          data : 'id_prd='+id_prd,
          success:function(data_produk)
          {
            var objData = JSON.parse(data_produk);
            if(objData=="") {
              Swal.fire(
                'Peringatan Kesalahan',
                'ID Produk tersebut tidak ditemukan',
                'warning'
              )
            } else {
              // console.log(objData);
              $.each(objData, function(key, val) {
                $("#nama_prd").val(val.nama_prd);
                var harga = Number(val.harga_prd);
                var diskon = Number(val.diskon_prd);
                if(diskon > 0) {
                  $("#tag_diskon").show();
                  $("#besar_diskon").text(diskon);
                  harga = harga - (harga * (diskon / 100));
                } else {
                  $("#tag_diskon").hide();
                  $("#besar_diskon").text(diskon);
                }
                $("#harga_prd").val(harga);
                $("#jml_beli").val('1');
                $("#subtotal_beli").val(harga);
              })
              $.ajax({
                type : "GET",
                url : "ajax/cariproduk.php?page=data_ukuran",
                data : 'id_prd='+id_prd,
                success:function(data_ukuran)
                {
                  var objData2 = JSON.parse(data_ukuran);
                  // console.log(objData2);
                  var i = 1;
                  $("#ukuran_beli").html('');
                  $.each(objData2, function(key, val) {
                    var option = '';
                    option = '<option value="'+val.id_ukuran+'" data-nmukr="'+val.keterangan_ukr+'" data-stok="'+val.stok_ukr+'">'+val.keterangan_ukr+' ('+val.stok_ukr+')</option>';
                    $("#ukuran_beli").append(option);
                    if(i==1) {
                      $("#stok_produk").val(val.stok_ukr);
                    }
                    i++;
                  })
                }
              })
            }
          }
        })
      }
    }
  })

  $("#ukuran_beli").change(function() {
    var stok = $(this).find(':selected').data('stok');
    $("#stok_produk").val(stok);
  });

  function total(jml_beli) {
    var harga = Number($("#harga_prd").val());
    if(harga>0 && jml_beli<=0) {
      $("#jml_beli").val('1');
      $("#subtotal_beli").val(harga);
    } 
    else if(harga>0 && jml_beli>0) {
      var subtotal = harga * jml_beli;
      $("#subtotal_beli").val(subtotal);
    }
  }

  $("#jml_beli").change(function() {
    var jml_beli = Number($("#jml_beli").val());
    total(jml_beli);
  })
  $("#jml_beli").keyup(function() {
    var jml_beli = Number($("#jml_beli").val());
    total(jml_beli);
  })

  $("#tmb_reset").click(function() {
    reset();
    // apasaja
  })

  $("#tmb_keranjang").click(function() {
    var id_prd = $("#id_prd").val();
    var nama_prd = $("#nama_prd").val();
    var harga_prd = Number($("#harga_prd").val());
    var diskon_prd = Number($("#besar_diskon").text());
    var id_ukuran_beli = $("#ukuran_beli").val();
    var nm_ukuran_beli = $("#ukuran_beli").find(':selected').data('nmukr');
    var jml_beli = Number($("#jml_beli").val());
    var subtotal_beli = Number($("#subtotal_beli").val());
    var stok_produk = Number($("#stok_produk").val());

    if(id_prd == '') {
      document.getElementById("id_prd").focus();
      Swal.fire(
        'Peringatan Belum Lengkap',
        'mohon masukkan id produk',
        'warning'
      )
    }
    else if(nama_prd == '') {
      document.getElementById("id_prd").focus();
      Swal.fire(
        'Peringatan Belum Lengkap',
        'nama produk belum lengkap',
        'warning'
      )
    }
    else if (id_ukuran_beli == '' || id_ukuran_beli == '0') {
      document.getElementById("ukuran_beli").focus();
      Swal.fire(
        'Peringatan Belum Lengkap',
        'mohon pilih ukuran produk',
        'warning'
      )
    }
    else if (jml_beli == '' || jml_beli <= '0') {
      document.getElementById("jml_beli").focus();
      Swal.fire(
        'Peringatan Belum Lengkap',
        'mohon masukkan jumlah produk',
        'warning'
      )
    }
    else if (jml_beli > stok_produk) {
      document.getElementById("jml_beli").focus();
      Swal.fire(
        'Peringatan Stok',
        'maaf stok tidak mencukupi',
        'warning'
      )
    }
    else {
      count++;
      var baris = "";
      baris  = '<tr id="row_'+count+'">';
      baris +=    '<td>'+nama_prd+' <input type="hidden" name="hidden_id_prd[]" id="td_id_prd'+count+'" class="td_id_prd" value="'+id_prd+'"><input type="hidden" name="hidden_nama_prd[]" id="td_nama_prd'+count+'" class="td_nama_prd" value="'+nama_prd+'"></td>';
      baris +=    '<td>'+harga_prd+' <input type="hidden" name="hidden_harga_prd[]" id="td_harga_prd'+count+'" class="td_harga_prd" value="'+harga_prd+'"><input type="hidden" name="hidden_diskon_prd[]" id="td_diskon_prd'+count+'" class="td_diskon_prd" value="'+diskon_prd+'"></td>';
      baris +=    '<td>'+nm_ukuran_beli+' <input type="hidden" name="hidden_ukuran_beli[]" id="td_ukuran_beli'+count+'" class="td_ukuran_beli" value="'+id_ukuran_beli+'"></td>';
      baris +=    '<td>'+jml_beli+' <input type="hidden" name="hidden_jml_beli[]" id="td_jml_beli'+count+'" class="td_jml_beli" value="'+jml_beli+'"></td>';
      baris +=    '<td>'+subtotal_beli+' <input type="hidden" name="hidden_subtotal_beli[]" id="td_subtotal_beli'+count+'" class="td_subtotal_beli" value="'+subtotal_beli+'"></td>';
      baris +=    '<td class="text-center"><button type="button" class="hapus_produk btn btn-danger btn-xs" name="hapus_produk" id="'+count+'" title="hapus produk ini" style="font-size : 10px;">hapus</button></td>';
      baris += '</tr>';

      $("#tr_nodata").hide();
      $("#tbody_keranjang").append(baris);
      total_jual = total_jual + subtotal_beli;
      $("#total_trans").text(total_jual);
      $("#total_penjualan").val(total_jual);

      $("#diskon_tran").change();
      $("#jml_bayar").change();
      reset();
    }
  })

  $(document).on("click", ".hapus_produk", function() {
    var num = $(this).attr('id');
    var subtotal_beli = Number($("#td_subtotal_beli"+num).val());
    total_jual = total_jual - subtotal_beli;
    $("#total_trans").text(total_jual);
    $("#total_penjualan").val(total_jual);
    $("#tbody_keranjang > #row_"+num).remove();
    if(total_jual == 0) {
      $("#tr_nodata").show();
    }

    $("#diskon_tran").change();
    $("#jml_bayar").change();
  })

  function hitung_diskon(diskon) {
    if(total_jual > 0 && diskon > 0 && diskon <= 100) {
      hasil_diskon = total_jual - (total_jual * (diskon / 100));
      $("#total_trans").text(hasil_diskon);
      $("#total_penjualan").val(hasil_diskon);
    }
    else if(diskon <= 0 || diskon > 100) {
      $("#total_trans").text(total_jual);
      $("#total_penjualan").val(total_jual);
      $("#diskon_tran").val('0');
    }
  }

  function hitung_kembalian(bayar) {
    var total_akhir = Number($("#total_trans").text());
    if (bayar >= total_akhir) {
      var kembalian = bayar - total_akhir;
      $("#kembalian_tran").val(kembalian);
    } 
    else if(bayar < total_akhir) {
      $("#kembalian_tran").val('nominal tidak cukup');
    }
    if(bayar < 0) {
      $("#jml_bayar").val('0');
      $("#kembalian_tran").val('nominal tidak cukup');
    }
  }

  $("#diskon_tran").change(function() {
    var diskon = Number($("#diskon_tran").val());
    var bayar = Number($("#jml_bayar").val());
    hitung_diskon(diskon);
    hitung_kembalian(bayar);
  })
  $("#diskon_tran").keyup(function() {
    var diskon = Number($("#diskon_tran").val());
    var bayar = Number($("#jml_bayar").val());
    hitung_diskon(diskon);
    hitung_kembalian(bayar);
  })

  $("#jml_bayar").change(function() {
    var bayar = Number($("#jml_bayar").val());
    hitung_kembalian(bayar);
  })
  $("#jml_bayar").keyup(function() {
    var bayar = Number($("#jml_bayar").val());
    hitung_kembalian(bayar);
  })

  $("#simpan_penjualan").click(function() {
    var diskon = Number($("#diskon_tran").val());
    var bayar = Number($("#jml_bayar").val());
    var total_akhir = Number($("#total_trans").text());
    if(total_jual == 0) {
      document.getElementById("id_prd").focus();
      Swal.fire(
        'Peringatan Belum Lengkap',
        'belum ada produk yang dipilih',
        'warning'
      )
    }
    else if(bayar < total_akhir) {
      document.getElementById("jml_bayar").focus();
      Swal.fire(
        'Peringatan Kesalahan',
        'jumlah uang tidak mencukupi',
        'warning'
      )
    }
    else {
      // alert();
      var form_data = $("#form_transaksi_penjualan").serialize();
      Swal.fire({
        title: 'Simpan ?',
        text: 'apakah anda telah mengisi data transaksi dengan benar ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((simpan) => {
        if (simpan.value) {
          $.ajax({
              url: "ajax/simpan_penjualan.php",
              method: "POST",
              data: form_data,
              success:function(data) {
                  Swal.fire({
                    title: 'Berhasil',
                    text: 'Transaksi Berhasil Disimpan',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  }).then((ok) => {
                    if (ok.value) {
                      // window.location='?page=entry_datapenjualan';
                      // window.open("laporan/?page=nota_penjualan&no_pjl="+no_penjualan);
                      location.reload();
                      // alert('berhasil');
                    }
                  })
              }
          })
        }
      })
    }
  })
</script>

