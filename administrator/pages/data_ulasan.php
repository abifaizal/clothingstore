<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Data Ulasan Pelanggan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Ulasan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Pelanggan</th>
              <th>No Transaksi</th>
              <th>Ulasan</th>
              <th>Waktu</th>
              <th>Balasan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1;
              $query_ulasan = "SELECT * FROM tbl_ulasan INNER JOIN tbl_pelanggan ON tbl_ulasan.kode_plg = tbl_pelanggan.kode_plg INNER JOIN tbl_penjualan ON tbl_ulasan.no_penjualan = tbl_penjualan.no_penjualan INNER JOIN tbl_datapenerima ON tbl_penjualan.no_penjualan = tbl_datapenerima.no_penjualan ORDER BY tbl_ulasan.tgl_ulasan";
              $sql_ulasan = mysqli_query($conn, $query_ulasan) or die ($conn->error);
              while($data_ulasan = mysqli_fetch_array($sql_ulasan)) {
            ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td>
                    <?php echo $data_ulasan['nama_plg']; ?> <br>
                    <small><i>(<?php echo $data_ulasan['kabkota_penerima']; ?>)</i></small>
                  </td>
                  <td><?php echo $data_ulasan['no_penjualan']; ?></td>
                  <td>
                    <?php 
                      $bintang = $data_ulasan['rating_ulasan'];
                      for($i=0; $i<$bintang; $i++) {
                    ?>
                        <i class="fa fa-star" style="color: #f5a82c"></i>
                    <?php } ?>
                    <?php 
                      $bintang = $data_ulasan['rating_ulasan'];
                      for($i=0; $i<5-$bintang; $i++) {
                    ?>
                        <i class="fa fa-star" style="color: #bab3a8"></i>
                    <?php } ?>
                    <br>
                    <p>
                      <?php echo $data_ulasan['komentar_ulasan']; ?>
                    </p>
                  </td>
                  <td>
                    <?php echo tgl_indo($data_ulasan['tgl_ulasan']); ?> [<?php echo $data_ulasan['jam_ulasan']; ?>]
                  </td>
                  <td>
                    <?php 
                      $status_balasan = $data_ulasan['status_balasan'];
                      if($status_balasan == "Ada") {
                    ?>
                        <small class="label bg-blue">Sudah dibalas</small>
                    <?php
                      } else {
                    ?>
                        <small class="label bg-yellow">Belum dibalas</small>
                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-xs btn-success tmb_detail" title="lihat balasan" data-toggle="modal" data-target="#modal-default"
                      data-nama_plg = "<?php echo $data_ulasan['nama_plg']; ?>"
                      data-waktu_ulasan = "<?php echo tgl_indo($data_ulasan['tgl_ulasan']); ?> [<?php echo $data_ulasan['jam_ulasan']; ?>]"
                      data-rating_ulasan = "<?php echo $data_ulasan['rating_ulasan'] ?>"
                      data-komentar_ulasan = "<?php echo $data_ulasan['komentar_ulasan'] ?>"
                      data-no_penjualan = "<?php echo $data_ulasan['no_penjualan'] ?>"
                      data-status_balasan = "<?php echo $data_ulasan['status_balasan'] ?>"
                    >
                      <i class="fa fa-comment"></i>
                    </button>
                    <button class="btn btn-xs btn-danger tmb_hapus" title="hapus" id="<?php echo $data_ulasan['no_penjualan'] ?>">
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
      <div class="modal-body" style="font-size: 14px;">
        <div class="ulasan-pelanggan">
          <div class="panel panel-default">
            <div class="panel-heading">
              <b id="nama_plg_ulasan">Anda</b> - <small id="waktu_ulasan_plg">10 Juli 2020 [13:17:02]</small>
            </div>
            <div class="panel-body">
              <span class="rating_star" id="rating_ulasan_plg">
                <i class="fa fa-star" style="color: #f5a82c;"></i>
                <i class="fa fa-star" style="color: #f5a82c;"></i>
                <i class="fa fa-star" style="color: #f5a82c;"></i>
                <i class="fa fa-star" style="color: #f5a82c;"></i>
                <i class="fa fa-star" style="color: #bab3a8;"></i>
              </span>
              <p class="komentar-text" id="kometar_ulasan_plg" style="margin-top: 1%;">
                <small><i>(tidak ada komentar)</i></small>
              </p>
            </div>
          </div>
        </div>

        <div class="div-form-balasan-ulasan" id="div_form_balasan_ulasan" style="margin-top: 10px; margin-left: 1%; padding-left: 4%; border-left: 2px solid #DCDCDC; display: none;">
          <div class="panel panel-default">
            <div class="panel-heading">
              <b><?php echo $_SESSION['nama_pgw']; ?></b>
            </div>
            <div class="panel-body">
              <form action="" id="form_balasan" autocomplete="off">
                <div class="form-group">
                  <label for="input_komentar_balasan">Komentar Balasan</label>
                  <textarea class="form-control" id="input_komentar_balasan" name="input_komentar_balasan" rows="2" placeholder="masukkan komentar balasan . . ." required=""></textarea>
                  <input type="hidden" id="no_penjualan_balasan" name="no_penjualan_balasan">
                </div>
                <div class="form-group" align="right">
                  <button type="submit" class="btn btn-xs btn-success">submit balasan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="balasan-ulasan" id="balasan-ulasan" style="margin-top: 10px; margin-left: 1%; padding-left: 4%; border-left: 2px solid #DCDCDC; display: none;">
          <div class="panel panel-default">
            <div class="panel-heading">
              <b id="nama_pgw_balasan">Blackshadow</b> - <small id="waktu_balasan">11 Juli 2020 [09:21:16]</small>
            </div>
            <div class="panel-body">
              <p class="komentar-text" id="komentar_balasan">
                Terima kasih telah memberi ulasan positif terhadap pelayanan kami.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $(document).on("click", ".tmb_detail", function() {
    var nama_plg = $(this).data('nama_plg');
    var waktu_ulasan = $(this).data('waktu_ulasan');
    var rating_ulasan = Number($(this).data('rating_ulasan'));
    var komentar_ulasan = $(this).data('komentar_ulasan');
    var no_penjualan = $(this).data('no_penjualan');
    var status_balasan = $(this).data('status_balasan');

    $("#nama_plg_ulasan").text(nama_plg);
    $("#waktu_ulasan_plg").text(waktu_ulasan);
    $("#rating_ulasan_plg").html("");
    for(var i = 0; i < rating_ulasan; i++) {
      var bintang = '<i class="fa fa-star" style="color: #f5a82c;"></i>';
      $("#rating_ulasan_plg").append(bintang);
    }
    for(var i = 0; i < 5-rating_ulasan; i++) {
      var bintang = '<i class="fa fa-star" style="color: #bab3a8;"></i>';
      $("#rating_ulasan_plg").append(bintang);
    }
    if(komentar_ulasan == "") {
      $("#kometar_ulasan_plg").html('<small><i>(tidak ada komentar)</i></small>');
    } else {
      $("#kometar_ulasan_plg").html(komentar_ulasan);
    }
    if(status_balasan == "Ada") {
      $("#balasan-ulasan").show();
      $("#div_form_balasan_ulasan").hide();
      $.ajax({
        type: "GET",
        url: "ajax/detail.php?page=balasan",
        data: "no_penjualan="+no_penjualan,
        success : function(data) {
          var objData = JSON.parse(data);
          // console.log(objData);
          $.each(objData, function(key,val){
            $("#nama_pgw_balasan").text(val.nama_pgw);
            $("#waktu_balasan").text(val.tglformat_balasan+" ["+val.jam_balasan+"]");
            $("#komentar_balasan").text(val.komentar_balasan);
          })
        }
      });
    } else {
      $("#balasan-ulasan").hide();
      $("#div_form_balasan_ulasan").show();
      $("#input_komentar_balasan").val("");
      $("#no_penjualan_balasan").val(no_penjualan);
    }
  })

  $("#form_balasan").submit(function() {
    event.preventDefault();
    var form_data = $(this).serialize();
    // console.log(form_data);
    $.ajax({
      type: "POST",
      url: "ajax/simpan_balasan.php",
      data: form_data,
      success : function(data) {
        location.reload();
      }
    })
  })

  $(".tmb_hapus").click(function() {
    var no_penjualan = $(this).attr("id");
    Swal.fire({
      title: 'Peringatan',
      text: "Data yang telah dihapus tidak dapat dipulihkan kembali",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "ajax/proses_hapus.php?page=ulasan_dan_balasan",
          data: "key="+no_penjualan,
          success:function(hasil) {
            Swal.fire({
              title: 'Berhasil',
              text: 'Data Berhasil Dihapus',
              type: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((ok) => {
              if (ok.value) {
                location.reload();
              }
            })
          }
        })
      }
    })
  })
</script>

