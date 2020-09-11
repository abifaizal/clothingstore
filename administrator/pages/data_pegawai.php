<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Halaman Data Pegawai
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li class="active">Data Pegawai</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <a href="?page=tambah_pegawai">
        <button class="btn btn-primary btn-sm">
          Tambah Data
        </button>
      </a>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID Pegawai</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Posisi</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $query_pegawai = "SELECT * FROM tbl_pegawai ORDER BY nama_pgw ASC";
            $sql_pegawai = mysqli_query($conn, $query_pegawai) or die ($conn->error);
            while($data_pegawai = mysqli_fetch_array($sql_pegawai)) {
          ?>
            <tr>
              <td><?php echo $data_pegawai['id_pgw']; ?></td>
              <td><?php echo $data_pegawai['nama_pgw']; ?></td>
              <td><?php echo $data_pegawai['gender_pgw']; ?></td>
              <td><?php echo $data_pegawai['posisi_pgw']; ?></td>
              <td>
                <small class="label <?=$data_pegawai['aktif_pgw'] == 'Aktif' ? 'bg-blue' : 'bg-red' ?>">
                  <?php echo $data_pegawai['aktif_pgw']; ?>
                </small>
              </td>
              <td class="text-center">
                <button class="btn btn-xs btn-success tmb_detail" id="tmb_detail" title="detail" data-toggle="modal" data-target="#modal-default" 
                  data-idpgw = "<?php echo $data_pegawai['id_pgw']; ?>"
                  data-nama = "<?php echo $data_pegawai['nama_pgw']; ?>"
                  data-gender = "<?php echo $data_pegawai['gender_pgw']; ?>"
                  data-lahir = "<?php echo $data_pegawai['lahir_pgw']; ?>"
                  data-posisi = "<?php echo $data_pegawai['posisi_pgw']; ?>"
                  data-alamat = "<?php echo $data_pegawai['alamat_pgw']; ?>"
                  data-username = "<?php echo $data_pegawai['username_pgw']; ?>"
                  data-password = "<?php echo $data_pegawai['password_pgw']; ?>"
                  data-aktif = "<?php echo $data_pegawai['aktif_pgw']; ?>"
                  >
                  <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-xs btn-danger tmb_hapus" id="<?php echo $data_pegawai['id_pgw']; ?>" name="tmb_hapus" title="hapus">
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
      <style>
        
      </style>
      <div class="modal-body">
        <table class="tabel-detailpegawai">
          <tr>
            <th>ID Pegawai</th>
            <td id="dt_idpgw">PGW001</td>
          </tr>
          <tr>
            <th>Nama</th>
            <td id="dt_namapgw">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Jenis Kelamin</th>
            <td id="dt_jkpgw">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Tanggal Lahir</th>
            <td id="dt_lahirpgw">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Posisi</th>
            <td id="dt_posisipgw">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td id="dt_alamatpgw">Jalan Siliwangi, Jl. Ring Road Utara Jl. Jombor Lor, Mlati Krajan, Sendangadi, Kec. Mlati, Kabupaten Sleman</td>
          </tr>
          <tr>
            <th>Username</th>
            <td id="dt_usernamepgw">Rangga Putra Rizdillah</td>
          </tr>
          <tr>
            <th>Password</th>
            <td id="dt_passwordpgw">Rangga Putra Rizdillah</td>
          </tr>
        </table>
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
  $(document).on("click", ".tmb_detail", function() {
    var id_pgw = $(this).data('idpgw');
    var nama_pgw = $(this).data('nama');
    var gender = $(this).data('gender');
    var lahir = $(this).data('lahir');
    var posisi = $(this).data('posisi');
    var alamat = $(this).data('alamat');
    var username = $(this).data('username');
    var password = $(this).data('password');

    $("#dt_idpgw").text(id_pgw);
    $("#dt_namapgw").text(nama_pgw);
    $("#dt_jkpgw").text(gender);
    $("#dt_lahirpgw").text(lahir);
    $("#dt_posisipgw").text(posisi);
    $("#dt_alamatpgw").text(alamat);
    $("#dt_usernamepgw").text(username);
    $("#dt_passwordpgw").text(password);

    $("#link_edit").attr('href','?page=edit_pegawai&id_pgw='+id_pgw);
  })

  $(".tmb_hapus").click(function() {
    var id_pgw = $(this).attr('id');
    Swal.fire({
      title: 'Anda akan menghapus '+id_pgw,
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
          url: "ajax/proses_hapus.php?page=pegawai",
          data: "key="+id_pgw,
          success:function(hasil) {
            Swal.fire({
              title: 'Berhasil',
              text: 'Data Berhasil Dihapus',
              type: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((ok) => {
              if (ok.value) {
                window.location='?page=pegawai';
              }
            })
          }
        })
      }
    })
  })
</script>

