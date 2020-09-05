<?php 
  require_once "koneksi.php";
  require_once "rajaongkir_api.php";
  session_start();
  // $_SESSION['username_plg'] = "Abdul";
  // session_unset();
  // session_destroy();
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap_4/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font_awesome/css/all.css">
    <link rel="stylesheet" href="assets/style/custom_style.css">
    <link rel="stylesheet" href="assets/sweetalert/dist/sweetalert2.min.css">

    <title>Black Shadow Distro</title>
  </head>
  <body>
    <div id="container">
      <div id="main">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand" href="./">Black Shadow</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if(@$_GET['page']=='') {echo 'active';} ?>">
                  <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item <?php if(@$_GET['page']=='produk') {echo 'active';} ?>">
                  <a class="nav-link" href="./#produk_semua">Produk</a>
                </li> -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php if(@$_GET['page']=='produk_semua' || @$_GET['page']=='produk_kaus' || @$_GET['page']=='produk_jaket' || @$_GET['page']=='produk_kemeja') {echo 'active';} ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategori Produk
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="?page=produk_semua#produk_semua">Semua</a>
                    <a class="dropdown-item" href="?page=produk_kaus#produk_semua">Kaus</a>
                    <a class="dropdown-item" href="?page=produk_jaket#produk_semua">Jaket</a>
                    <a class="dropdown-item" href="?page=produk_kemeja#produk_semua">Kemeja</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./#kontak">Hubungi kami</a>
                </li>
              </ul>
              <ul class="navbar-nav">
                <?php if(!@$_SESSION['username_plg']) { ?>
                <li class="nav-item" id="login_box">
                  <!-- <a href="?page=register"> -->
                    <button class="btn btn-outline-light my-2 my-sm-0" type="button" data-toggle="modal" data-target="#modal_login" id="tmb_masuk" style="font-size: 12px;">
                      Masuk
                    </button>
                  <!-- </a> -->
                </li>
                <?php } else { ?>
                <li class="nav-item">
                  <?php 
                    $kode_plg = $_SESSION['kode_plg'];
                    $query_krj = "SELECT id_krjdt FROM tbl_keranjangdetail INNER JOIN tbl_keranjang ON tbl_keranjangdetail.id_keranjang = tbl_keranjang.id_keranjang WHERE tbl_keranjang.kode_plg = '$kode_plg'";
                    $sql_krj = mysqli_query($conn, $query_krj) or die ($conn->error);
                    $rows = mysqli_num_rows($sql_krj);
                   ?>
                  <a class="nav-link <?php if($rows==0) {echo 'disabled';} ?>" href="?page=keranjang">
                    <i class="fas fa-shopping-cart"></i> Keranjang
                    <?php if($rows>0) { ?>
                    <span class="badge badge-light"><?php echo $rows; ?></span>
                    <?php } ?>
                  </a>
                </li>
                <li class="nav-item dropdown" id="user_info">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username_plg']; ?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?php 
                      $query_pjl = "SELECT * FROM tbl_penjualan WHERE kode_plg = '$kode_plg' AND metode_penjualan = 'Online' AND status_penjualan != 'Selesai'";
                      $sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
                      $count_semua = mysqli_num_rows($sql_pjl);

                      $query_alamat = "SELECT * FROM tbl_alamatplg WHERE kode_plg = '$kode_plg'";
                      $sql_alamat = mysqli_query($conn, $query_alamat) or die ($conn->error);
                      $count_alamat = mysqli_num_rows($sql_alamat);
                    ?>
                    <a class="dropdown-item" href="?page=datatransaksi"><i class="fas fa-box"></i> Transaksi <span class="badge badge-warning"><?php echo $count_semua; ?></span></a>
                    <a class="dropdown-item" href="?page=edit_profil&username=<?php echo $_SESSION['username_plg']; ?>">
                      <i class="fas fa-user-cog"></i> Ubah Profil
                    </a>
                    <a class="dropdown-item <?=$count_alamat > 0 ? null : 'disabled'?>" href="?page=daftar_alamatplg&kode_plg=<?php echo $_SESSION['kode_plg']; ?>">
                      <i class="fas fa-address-book"></i> Daftar Alamat
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" id="log_out">
                      <i class="fas fa-power-off"></i> Keluar
                    </a>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </nav>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/Jquery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="assets/bootstrap_4/js/bootstrap.min.js"></script>
        <script src="assets/sweetalert/dist/sweetalert2.min.js"></script>

        <div class="container">
          <?php 
            if(@$_GET['page']=='') {
              include 'page/home.php';
            }
            else if(@$_GET['page']=='register') {
              include 'page/register.php';
            }
            else if(@$_GET['page']=='edit_profil') {
              include 'page/edit_profil.php';
            }
            else if(@$_GET['page']=='daftar_alamatplg') {
              include 'page/daftar_alamatplg.php';
            }
            else if(@$_GET['page']=='produk') {
              include 'page/produk.php';
            }
            else if(@$_GET['page']=='produk_semua') {
              include 'page/home.php';
            }
            else if(@$_GET['page']=='produk_kaus') {
              include 'page/produk_kaus.php';
            }
            else if(@$_GET['page']=='produk_jaket') {
              include 'page/produk_jaket.php';
            }
            else if(@$_GET['page']=='produk_kemeja') {
              include 'page/produk_kemeja.php';
            }
            else if(@$_GET['page']=='keranjang') {
              include 'page/keranjang.php';
            }
            else if(@$_GET['page']=='pemesanan') {
              include 'page/pemesanan.php';
            }
            else if(@$_GET['page']=='datatransaksi') {
              include 'page/data_transaksi.php';
            }
            else if(@$_GET['page']=='pembayaran') {
              include 'page/pembayaran.php';
            }
            else if(@$_GET['page']=='konfirmasipembayaran') {
              include 'page/konfirmasi_pembayaran.php';
            }
            else if(@$_GET['page']=='detailpembayaran') {
              include 'page/detail_pembayaran.php';
            }
           ?>
        </div>
      </div>
    </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-6">
            <i class="far fa-copyright"></i> Black Shadow - Kebumen.
          </div>
          <div class="col-6 text-right">
            <a href="https://www.instagram.com/blackshadow_merchandise/" target="_blank" class="text-white"><i class="fab fa-instagram"></i></a>
            <!-- <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white"><i class="fab fa-facebook"></i></a> -->
          </div>
        </div>
      </div>
    </footer>

    <div class="modal fade modal_login" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login Box</h5>
            <button type="button" class="close" id="close_modal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-register">
              <h6>Masukkan username dan password untuk Log in</h6>
              <form autocomplete="off">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control form-control-sm" id="username" placeholder="masukkan username akun anda" autofocus="">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control form-control-sm" id="password" placeholder="masukkan password akun anda">
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <a href="?page=register">
              <button type="button" class="btn btn-link btn-sm">Belum punya akun? buat dulu</button>
            </a>
            <button type="button" class="btn btn-primary btn-sm" id="login_button">Masuk</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $("#login_button").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();

        if(username == "") {
          document.getElementById("username").focus();
          Swal.fire(
            'Data Belum Lengkap',
            'maaf, tolong isi username anda',
            'warning'
          )
        } 
        else if(password == "") {
          document.getElementById("password").focus();
          Swal.fire(
            'Data Belum Lengkap',
            'maaf, tolong isi password anda',
            'warning'
          )
        }
        else {
          $.ajax({
            type: "GET",
            url: "usrajax/ceklogin.php",
            data: "username="+username+"&password="+password,
            success: function(hasil) {
              console.log(hasil);
              if(hasil=="berhasil") {
                $("#close_modal").click();
                Swal.fire({
                  title: 'Selamat Datang '+username,
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok) => {
                  if (ok.value) {
                    location.reload();
                  }
                })
              } else {
                document.getElementById("username").focus();
                Swal.fire({
                  type: 'error',
                  title: 'Gagal',
                  text: 'Periksa kembali username dan password anda',
                  showConfirmButton: true
                  // timer: 1500
                })
              }
            }
          });
        }
      })

      $("#log_out").click(function() {
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan keluar dari akun anda',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
        }).then((tes) => {
          if (tes.value) {
            $.ajax({
              type: "POST",
              url: "usrajax/logout.php",
              success: function(hasil) {
                window.location='./';
              }
            })  
          }
        })
      })
    </script>
  </body>
</html>