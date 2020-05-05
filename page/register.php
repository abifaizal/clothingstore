<?php if(!@$_SESSION['username_plg']) { ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Register</li>
  </ol>
</nav>
<div class="row kontainer-register">
  <div class="col-lg-6 offset-lg-3">
    <div class="form-register">
      <h6>Tolong Lengkapi Form Berikut untuk membuat akun baru</h6>
      <form method="POST" id="form_register" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nama_plg">Nama Lengkap</label>
          <input type="text" class="form-control form-control-sm" name="nama_plg" id="nama_plg" placeholder="cth: Budi Ramadhan" autofocus="">
        </div>
        <div class="form-group">
          <label for="gender_plg">Jenis Kelamin</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender_plg" id="gender_plg_l" value="Laki-laki"  checked="">
            <label class="form-check-label" for="gender_plg_l">
              Laki-laki
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender_plg" id="gender_plg_p" value="Perempuan">
            <label class="form-check-label" for="gender_plg_p">
              Perempuan
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email_plg">Email</label>
          <input type="email" class="form-control form-control-sm" name="email_plg" id="email_plg" placeholder="cth: budi_ramadhan@gmail.com">
        </div>
        <div class="form-group">
          <label for="username_plg">Username</label>
          <input type="text" class="form-control form-control-sm" name="username_plg" id="username_plg" placeholder="cth: budi_ramadhan">
        </div>
        <div class="form-group">
          <label for="password_plg">Password</label>
          <div class="input-group input-group-sm input-group-password">
            <input type="password" class="form-control form-control-sm" name="password_plg" id="password_plg" placeholder="cth: budi_ramadhan">
            <div class="input-group-append">
              <span class="input-group-text" id="lihat_pass" title="lihat password"><i class="fas fa-eye"></i></span>
            </div>
          </div>
        </div>
        <div class="form-group" style="text-align: right;">
          <input type="submit" class="btn btn-dark" name="submit_regsiter" id="submit_regsiter" value="Buat Akun Baru" style="font-size: 14px;">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var status_password = 0;
  $("#lihat_pass").click(function() {
    // alert();
    if(status_password==0) {
      $('.input-group-password').find('input:password').prop({type:"text"});
      status_password = 1;
    } else if(status_password==1) {
      $('.input-group-password').find('input:text').prop({type:"password"});
      status_password = 0;
    }
  })

  $("#form_register").on("submit", function() {
    event.preventDefault();
    var nama_plg = $("#nama_plg").val();
    var email_plg = $("#email_plg").val();
    var username_plg = $("#username_plg").val();
    var password_plg = $("#password_plg").val();

    if(nama_plg == "") {
      document.getElementById("nama_plg").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi nama anda dengan benar',
        'warning'
      )
    }
    else if(email_plg == "") {
      document.getElementById("email_plg").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi email anda dengan benar',
        'warning'
      )
    }
    else if(username_plg == "") {
      document.getElementById("username_plg").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi username anda dengan benar',
        'warning'
      )
    }
    else if(password_plg == "") {
      document.getElementById("password_plg").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong lengkapi password anda dengan benar',
        'warning'
      )
    }
    else {
      $.ajax({
        url: "usrajax/simpan_pelanggan.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success:function(hasil) {
          if(hasil=="gagal-username") {
            document.getElementById("username_plg").focus();
            Swal.fire(
              'Peringatan',
              'Username Telah Digunakan, Ganti Username Anda',
              'warning'
            )
          } else if(hasil=="berhasil") {
            Swal.fire({
              title: 'Berhasil',
              text: 'Data Berhasil Disimpan',
              type: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((ok) => {
              if (ok.value) {
                // location.reload();
                window.location='./';
              }
            })
          }
        }
      })
    }
  })
</script>

<?php 
  } else {
?>
    <script>
      window.location="./";
    </script>
<?php } ?>