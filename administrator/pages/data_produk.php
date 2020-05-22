<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Data Produk
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Produk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <a href="?page=tambah_produk">
        <button class="btn btn-primary btn-sm">
          Tambah Data
        </button>
      </a>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="tbl_dproduk" class="table table-bordered table-striped">
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
                  <button class="btn btn-xs btn-success tmb_detail" id="tmb_detail" title="detail" data-toggle="modal" data-target="#modal-default" 
                    data-idprd = "<?php echo $data_produk['id_prd']; ?>"
                    data-nama = "<?php echo $data_produk['nama_prd']; ?>"
                    data-kategori = "<?php echo $data_produk['kategori_prd']; ?>"
                    data-harga = "<?php echo number_format($data_produk['harga_prd']); ?>"
                    data-diskon = "<?php echo $data_produk['diskon_prd']; ?>"
                    data-stok = "<?php echo $data_produk['stok_prd']; ?>"
                    data-berat = "<?php echo $data_produk['berat_prd']; ?>"
                    data-deskripsi = "<?php echo $data_produk['deskripsi_prd']; ?>"
                    data-gambar = "<?php echo $data_produk['gambar_prd']; ?>"
                    <?php 
                      $id_prd = $data_produk['id_prd'];
                      $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd'";
                      $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
                      $count = mysqli_num_rows($sql_ukuran);
                    ?>
                      data-ukuran = "<?php echo $count ?>"
                    <?php
                      $i = 1;
                      if($count>0) {
                        while($data_ukuran = mysqli_fetch_array($sql_ukuran)) {
                    ?>
                          data-ktukr<?php echo $i; ?> = "<?php echo $data_ukuran['keterangan_ukr'] ?>"
                          data-stukr<?php echo $i; ?> = "<?php echo $data_ukuran['stok_ukr'] ?>"
                    <?php
                          $i++;
                        }
                      }
                    ?>
                    >
                    <i class="fa fa-eye"></i>
                  </button>
                  <button class="btn btn-xs btn-danger tmb_hapus" id="<?php echo $data_produk['id_prd']; ?>" name="tmb_hapus">
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
    <div class="box-footer"></div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Produk</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5 col-xs-12">
            <div class="card">
              <img src="../img/produk/5154ca2a646e0e771711ff327e3f63ca.jpg" class="card-img-top" alt="..." id="dt_gambar">
            </div>
          </div>
          <div class="col-md-7 col-xs-12 kolom-infoproduk">
            <table class="table table-bordered">
              <tr>
                <th width="20%">Kode Produk</th>
                <td id="dt_idprd">PRD001</td>
              </tr>
              <tr>
                <th>Nama Produk</th>
                <td id="dt_nama">Jaket Hold Your Pinky</td>
              </tr>
              <tr>
                <th>Harga</th>
                <td>Rp <span id="dt_harga"></span></td>
              </tr>
              <tr>
                <th>Diskon</th>
                <td><span id="dt_diskon"></span>%</td>
              </tr>
              <tr>
                <th>Kategori</th>
                <td id="dt_kategori">Jaket</td>
              </tr>
              <tr>
                <th>Berat</th>
                <td><span id="dt_berat"></span> gram</td>
              </tr>
              <tr>
                <th>Ukuran</th>
                <td id="dt_ukuran">
                  (S) - 21 pcs <br>
                  (M) - 16 pcs <br>
                  (L) - 13 pcs <br>
                  (XL) - 23 pcs <br>
                </td>
              </tr>
              <tr>
                <th>Total Stok</th>
                <td id="dt_stok">73 pcs</td>
              </tr>
              <tr>
                <th>Deskripsi</th>
                <td id="dt_deskripsi">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, maiores porro. Asperiores soluta, natus iste quas nisi magnam temporibus, perspiciatis.</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="" id="link_edit">
          <button type="button" class="btn btn-primary">Edit</button>
        </a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $(document).on("click", "#tmb_detail", function() {
    var id = $(this).data('idprd');
    var nama = $(this).data('nama');
    var kategori = $(this).data('kategori');
    var harga = $(this).data('harga');
    var diskon = $(this).data('diskon');
    var berat = $(this).data('berat');
    var stok = $(this).data('stok');
    var berat = $(this).data('berat');
    var deskripsi = $(this).data('deskripsi');
    var gambar = $(this).data('gambar');
    var ukuran = $(this).data('ukuran');

    $("#dt_idprd").text(id);
    $("#dt_nama").text(nama);
    $("#dt_harga").text(harga);
    $("#dt_diskon").text(diskon);
    $("#dt_kategori").text(kategori);
    $("#dt_berat").text(berat);
    $("#dt_ukuran").html('');
    if(ukuran>0) {
      for(var i=1; i<=ukuran; i++) {
        var ktukr = $(this).data('ktukr'+i+'');
        var stukr = $(this).data('stukr'+i+'');
        $("#dt_ukuran").append(ktukr+" - "+stukr+" stok <br>");
      }
    }
    $("#dt_stok").text(stok);
    $("#dt_deskripsi").text(deskripsi);
    $("#dt_gambar").attr('src','../img/produk/'+gambar);
    $("#link_edit").attr('href','?page=edit_produk&id_prd='+id);
  })

  $(document).on("click", ".tmb_hapus", function() {
    var id_prd = $(this).attr('id');
    Swal.fire({
      title: 'Anda akan menghapus '+id_prd,
      text: "Data yang telah dihapus tidak dapat dipulihkan kembali",
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
          url: "ajax/proses_hapus.php?page=produk",
          data: "key="+id_prd,
          success:function(hasil) {
            Swal.fire({
              title: 'Berhasil',
              text: 'Data Berhasil Dihapus',
              type: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((ok) => {
              if (ok.value) {
                window.location='?page=produk';
              }
            })
          }
        })
      }
    })
  })
</script>