<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Data Penjualan Offline
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Penjualan Offline</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <a href="?page=transaksi_offline">
        <button class="btn btn-primary btn-sm">
          Transaksi Baru
        </button>
      </a>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No Penjualan</th>
              <th>Waktu</th>
              <th>Pegawai</th>
              <th>Total</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $query_pjl = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_pgw = tbl_pegawai.id_pgw WHERE tbl_penjualan.metode_penjualan = 'Offline' ORDER BY tbl_penjualan.tgl_penjualan DESC, tbl_penjualan.jam_penjualan DESC";
            $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
            while($data_pjl = mysqli_fetch_array($sql_pjl)) {
          ?>
              <tr>
                <td><?php echo $data_pjl['no_penjualan']; ?></td>
                <td><?php echo $data_pjl['tgl_penjualan']; ?> [<?php echo $data_pjl['jam_penjualan']; ?>]</td>
                <td><?php echo $data_pjl['username_pgw']; ?></td>
                <td><?php echo $data_pjl['total_penjualan']; ?></td>
                <td class="text-center">
                <button class="btn btn-xs btn-success tmb_detail" id="tmb_detail" title="detail" data-toggle="modal" data-target="#modal-detail_penjualan" 
                  data-nopenjualan = "<?php echo $data_pjl['no_penjualan']; ?>"
                  data-tglpenjualan = "<?php echo $data_pjl['tgl_penjualan']; ?>"
                  data-jampenjualan = "<?php echo $data_pjl['jam_penjualan']; ?>"
                  data-usernamepgw = "<?php echo $data_pjl['username_pgw']; ?>"
                  data-totalpenjualan = "<?php echo number_format($data_pjl['total_penjualan']);?>"
                  data-diskonpenjualan = "<?php echo $data_pjl['diskon_penjualan']; ?>"
                  data-bayarpenjualan = "<?php echo number_format($data_pjl['bayar_penjualan']);?>"
                  >
                  <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-xs btn-danger tmb_hapus" id="<?php echo $data_pjl['no_penjualan']; ?>" data-status = "<?php echo $data_pjl['status_penjualan']; ?>" name="tmb_hapus" title="hapus">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <!-- Footer -->
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<div class="modal fade" id="modal-detail_penjualan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Penjualan</h4>
      </div>
      <div class="modal-body">
        <table class="tabel-detail-keranjang">
          <tr>
            <th>No Penjualan</th>
            <td id="dt_nopenjualan">KRJ002</td>
          </tr>
          <tr>
            <th>Waktu</th>
            <td id="dt_wktpjl">2020-04-03 [15:09:29]</td>
          </tr>
          <tr>
            <th>Pegawai</th>
            <td id="dt_usernamepgw">Rangga Putra Rizdillah</td>
          </tr>
        </table>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $(document).on("click", ".tmb_detail", function() {
    var no_penjualan = $(this).data('nopenjualan');
    var tgl_penjualan = $(this).data('tglpenjualan');
    var jam_penjualan = $(this).data('jampenjualan');
    var username_pgw = $(this).data('usernamepgw');
    var diskon_pjl = $(this).data('diskonpenjualan');
    var total_penjualan = $(this).data('totalpenjualan');

    $("#dt_nopenjualan").text(no_penjualan);
    $("#dt_wktpjl").text(tgl_penjualan+" ["+jam_penjualan+"]");
    $("#dt_usernamepgw").text(username_pgw);
    $("#dt_diskonpjl").text(diskon_pjl);
    $("#dt_totalpjl").text(total_penjualan);

    $("#data_detailkrj").html("");
    $.ajax({
      type: "GET",
      url: "ajax/detail.php?page=penjualan",
      data: "no_penjualan="+no_penjualan,
      success : function(data) {
        var objData = JSON.parse(data);
        var total = 0;
        console.log(objData);
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

  $(".tmb_hapus").click(function() {
    var no_penjualan = $(this).attr('id');
    var status = $(this).data('status');
    Swal.fire({
      title: 'Anda akan menghapus penjualan '+no_penjualan,
      text: "Peringatan : Data yang telah dihapus tidak dapat dipulihkan kembali",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "ajax/proses_hapus.php?page=penjualan",
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
                window.location='?page=data_transaksi_offline';
              }
            })
          }
        })
      }
    })
  })
</script>

