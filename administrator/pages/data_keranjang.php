<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Data Keranjang Pelanggan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Keranjang</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <!-- <a href="?page=tambah_pegawai">
        <button class="btn btn-primary btn-sm">
          Tambah Data
        </button>
      </a> -->
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kode Keranjang</th>
              <th>Waktu</th>
              <th>Pelanggan</th>
              <th>Jumlah Item</th>
              <th>Total</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $query_krj = "SELECT * FROM tbl_keranjang INNER JOIN tbl_pelanggan ON tbl_keranjang.kode_plg = tbl_pelanggan.kode_plg ORDER BY tanggal_krj DESC";
            $sql_krj = mysqli_query($conn, $query_krj) or die ($conn->error);
            while($data_krj = mysqli_fetch_array($sql_krj)) {
              $id_keranjang = $data_krj['id_keranjang'];
              $query_krjdt = "SELECT jml_prd, harga_prd, diskon_prd FROM tbl_keranjangdetail INNER JOIN tbl_produk ON tbl_keranjangdetail.id_prd = tbl_produk.id_prd WHERE tbl_keranjangdetail.id_keranjang = '$id_keranjang'";
              $sql_krjdt = mysqli_query($conn, $query_krjdt) or die ($conn->error);
              $jml_item = 0;
              $total_krj = 0;
              while($data_krjdt = mysqli_fetch_array($sql_krjdt)) {
                $jml_prd = $data_krjdt['jml_prd'];
                $harga_prd = $data_krjdt['harga_prd'];
                $diskon_prd = $data_krjdt['diskon_prd'];

                $jml_item = $jml_item + $jml_prd;
                $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
                $subtotal = $harga_akhir * $jml_prd;
                $total_krj = $total_krj + $subtotal;
              }
          ?>
            <tr>
              <td><?php echo $data_krj['id_keranjang']; ?></td>
              <td><?php echo $data_krj['tanggal_krj']." [".$data_krj['jam_krj']."]"; ?></td>
              <td><?php echo $data_krj['nama_plg']; ?></td>
              <td><?php echo $jml_item;?></td>
              <td>Rp <?php echo number_format($total_krj);?></td>
              <td class="text-center">
                <button class="btn btn-xs btn-success tmb_detail" id="tmb_detail" title="detail" data-toggle="modal" data-target="#modal-default" 
                  data-idkrj = "<?php echo $data_krj['id_keranjang']; ?>"
                  data-tglkrj = "<?php echo $data_krj['tanggal_krj']; ?>"
                  data-jamkrj = "<?php echo $data_krj['jam_krj']; ?>"
                  data-namaplg = "<?php echo $data_krj['nama_plg']; ?>"
                  data-totalkrj = "<?php echo number_format($total_krj);?>"
                  >
                  <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-xs btn-danger tmb_hapus" id="<?php echo $data_krj['id_keranjang']; ?>" name="tmb_hapus" title="hapus">
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Pegawai</h4>
      </div>
      <div class="modal-body">
        <table class="tabel-detail-keranjang">
          <tr>
            <th>Kode Keranjang</th>
            <td id="dt_kdkrj">KRJ002</td>
          </tr>
          <tr>
            <th>Waktu</th>
            <td id="dt_wktkrj">2020-04-03 [15:09:29]</td>
          </tr>
          <tr>
            <th>Pelanggan</th>
            <td id="dt_namaplg">Rangga Putra Rizdillah</td>
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
                <div class="foto-produk">
                  <img src="../img/produk/prd-1584967402.jpg" class="card-img-top" alt="...">
                </div>
              </td>
              <td>
                Kemeja Hitam Lengan Panjang <br>
                Size : M <br>
                Harga : Rp 120,000
              </td>
              <td>1</td>
              <td>Rp 120,000</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"></td>
              <th>Rp <span id="dt_totalkrj">120,000</span></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <a href="" id="link_edit">
          <button type="button" class="btn btn-primary">Edit</button>
        </a> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $(document).on("click", ".tmb_detail", function() {
    var kode_krj = $(this).data('idkrj');
    var tglkrj = $(this).data('tglkrj');
    var jamkrj = $(this).data('jamkrj');
    var namaplg = $(this).data('namaplg');
    var totalkrj = $(this).data('totalkrj');

    $("#dt_kdkrj").text(kode_krj);
    $("#dt_wktkrj").text(tglkrj+" ["+jamkrj+"]");
    $("#dt_namaplg").text(namaplg);
    $("#dt_totalkrj").text(totalkrj);

    $("#data_detailkrj").html("");
    $.ajax({
      type: "GET",
      url: "ajax/detail.php?page=keranjang",
      data: "id_krj="+kode_krj,
      success : function(data) {
        var objData = JSON.parse(data);
        // console.log(objData);
        $.each(objData, function(key,val){
          var baris_baru = '';
          baris_baru += '<tr>';
          baris_baru +=   '<td class="td-foto">';
          baris_baru +=   ' <div class="foto-produk">';
          baris_baru +=   '   <img src="../img/produk/'+val.gambar_prd+'" class="card-img-top" alt="...">';
          baris_baru +=   ' </div>';
          baris_baru +=   '</td>';
          baris_baru +=   '<td>'+val.nama_prd+'<br>Ukuran : '+val.keterangan_ukr+'<br>Harga : Rp '+val.harga_akhir+'</td>';
          baris_baru +=   '<td>'+val.jml_prd+'</td>';
          baris_baru +=   '<td>Rp '+val.subtotal+'</td>';
          baris_baru += '</tr>';

          $("#data_detailkrj").append(baris_baru);
        })
      }
    });
  })
</script>

