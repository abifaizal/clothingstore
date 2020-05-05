<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Data Pelanggan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Pelanggan</li>
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
              <th>Kode Pelanggan</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Email</th>
              <th>Username</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $query_pelanggan = "SELECT * FROM tbl_pelanggan ORDER BY nama_plg ASC";
            $sql_pelanggan = mysqli_query($conn, $query_pelanggan) or die ($conn->error);
            while($data_pelanggan = mysqli_fetch_array($sql_pelanggan)) {
          ?>
            <tr>
              <td><?php echo $data_pelanggan['kode_plg']; ?></td>
              <td><?php echo $data_pelanggan['nama_plg']; ?></td>
              <td><?php echo $data_pelanggan['gender_plg']; ?></td>
              <td><?php echo $data_pelanggan['email_plg']; ?></td>
              <td><?php echo $data_pelanggan['username_plg']; ?></td>
              <td class="text-center">
                <button class="btn btn-xs btn-success tmb_detail" id="tmb_detail" title="detail" data-toggle="modal" data-target="#modal-detailplg" 
                  data-kodeplg = "<?php echo $data_pelanggan['kode_plg']; ?>"
                  data-nama = "<?php echo $data_pelanggan['nama_plg']; ?>"
                  data-gender = "<?php echo $data_pelanggan['gender_plg']; ?>"
                  data-email = "<?php echo $data_pelanggan['email_plg']; ?>"
                  data-username = "<?php echo $data_pelanggan['username_plg']; ?>"
                  data-tglregis = "<?php echo $data_pelanggan['tglregis_plg']; ?>"
                  >
                  <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-xs btn-danger tmb_hapus" id="<?php echo $data_pegawai['kode_plg']; ?>" name="tmb_hapus" title="hapus">
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

<div class="modal fade" id="modal-detailplg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Pelanggan</h4>
      </div>
      <style>
        
      </style>
      <div class="modal-body">
        <table class="tabel-detailpegawai">
          <tr>
            <th>Kode Pelanggan</th>
            <td id="dt_kdplg">PGW001</td>
          </tr>
          <tr>
            <th>Nama</th>
            <td id="dt_namaplg">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Jenis Kelamin</th>
            <td id="dt_jkplg">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Email</th>
            <td id="dt_emailplg">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Username</th>
            <td id="dt_usernameplg">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Tanggal Registrasi</th>
            <td id="dt_tglregisplg">Rangga Putra Rizdillah</td>
          </tr>
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
    var kd_plg = $(this).data('kodeplg');
    var nama_plg = $(this).data('nama');
    var gender = $(this).data('gender');
    var email = $(this).data('email');
    var username = $(this).data('username');
    var tglregis = $(this).data('tglregis');

    $("#dt_kdplg").text(kd_plg);
    $("#dt_namaplg").text(nama_plg);
    $("#dt_jkplg").text(gender);
    $("#dt_emailplg").text(email);
    $("#dt_usernameplg").text(username);
    $("#dt_tglregisplg").text(tglregis);

    // $("#link_edit").attr('href','?page=edit_pegawai&id_pgw='+id_pgw);
  })

  // $(".tmb_hapus").click(function() {
  //   var id_pgw = $(this).attr('id');
  //   Swal.fire({
  //     title: 'Anda akan menghapus '+id_pgw,
  //     text: "Data yang telah dihapus tidak dapat dipulihkan kembali",
  //     icon: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     confirmButtonText: 'Hapus',
  //     cancelButtonText: 'Tidak'
  //   }).then((result) => {
  //     if (result.value) {
  //       $.ajax({
  //         type: "POST",
  //         url: "ajax/proses_hapus.php?page=pegawai",
  //         data: "key="+id_pgw,
  //         success:function(hasil) {
  //           Swal.fire({
  //             title: 'Berhasil',
  //             text: 'Data Berhasil Dihapus',
  //             type: 'success',
  //             confirmButtonColor: '#3085d6',
  //             confirmButtonText: 'OK'
  //           }).then((ok) => {
  //             if (ok.value) {
  //               window.location='?page=pegawai';
  //             }
  //           })
  //         }
  //       })
  //     }
  //   })
  // })
</script>

