
<section class="content-header">
  <h1>
    Halaman Tambah Data Pegawai
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./">Dashboard</a></li>
    <li><a href="?page=pegawai">Data Pegawai</a></li>
    <li class="active">Tambah Pegawai</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header text-right">
      <a href="?page=pegawai">
        <button class="btn btn-primary btn-sm">
          Daftar Pegawai
        </button>
      </a>
    </div>
    <form method="POST" id="form_tmbpegawai" autocomplete="off">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box-body">
            <div class="form-group">
              <label for="nama_pgw">Nama Pegawai</label>
              <input type="text" class="form-control" name="nama_pgw" id="nama_pgw" placeholder="masukkan nama pegawai" autofocus="">
            </div>
            <div class="form-group">
              <label for="gender_pgw">Jenis Kelamin</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="gender_pgw" id="laki" value="Laki-laki" checked>
                    Laki-laki
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="gender_pgw" id="perempuan" value="Perempuan">
                    Perempuan
                  </label>
                </div>
            </div>
            <div class="form-group">
              <label for="lahir_pgw">Tanggal Lahir</label>
              <input type="date" class="form-control" name="lahir_pgw" id="lahir_pgw">
            </div>
            <div class="form-group">
              <label for="posisi_pgw">Posisi Pegawai</label>
              <select class="form-control" name="posisi_pgw" id="posisi_pgw">
              	<option value="0">pilih posisi</option>
              	<option value="Manager">Manager</option>
              	<option value="Kasir">Kasir</option>
              </select>
            </div>
            <div class="form-group">
              <label for="alamat_pgw">Alamat Pegawai</label>
              <textarea class="form-control" name="alamat_pgw" id="alamat_pgw" rows="3" placeholder="masukkan alamat pegawai"></textarea>
            </div>
            <div class="form-group">
              <label for="username_pgw">Username Pegawai</label>
              <input type="text" class="form-control" name="username_pgw" id="username_pgw" placeholder="masukkan username pegawai">
            </div>
            <div class="form-group">
              <label for="password_pgw">Password Pegawai</label>
              <div class="input-group input-group-password">
                <input type="password" class="form-control" name="password_pgw" id="password_pgw" placeholder="masukkan password">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default btn-flat" id="lihat_pass"><i class="fa fa-eye"></i></button>
                </span>
              </div>
              <!-- <input type="password" class="form-control" name="password_pgw" id="password_pgw" placeholder="masukkan password"> -->
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-right">
            <!-- <button type="button" class="btn btn-success">Simpan</button> -->
            <input type="submit" name="simpan_produk" id="simpan_produk" class="btn btn-success" value="Simpan">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

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
  
	$("#form_tmbpegawai").on("submit", function() {
		event.preventDefault();
		var nama = $("#nama_pgw").val();
		var tgl_lahir = $("#lahir_pgw").val();
		var posisi = $("#posisi_pgw").val();
		var alamat_pgw = $("#alamat_pgw").val();
		var username_pgw = $("#username_pgw").val();
		var password_pgw = $("#password_pgw").val();

		if(nama == '') {
			document.getElementById("nama_pgw").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong lengkapi nama pegawai dengan benar',
			  'warning'
			)
		}
		else if(tgl_lahir == '') {
			document.getElementById("lahir_pgw").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong lengkapi tanggal lahir pegawai',
			  'warning'
			)
		}
		else if(posisi == '0') {
			document.getElementById("posisi_pgw").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih posisi pegawai',
			  'warning'
			)
		} 
		else if(alamat_pgw == '') {
			document.getElementById("alamat_pgw").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong lengkapi alamat pegawai',
			  'warning'
			)
		} 
		else if(username_pgw == '') {
			document.getElementById("username_pgw").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong lengkapi username pegawai',
			  'warning'
			)
		} 
		else if(password_pgw == '') {
			document.getElementById("password_pgw").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong lengkapi password',
			  'warning'
			)
		}
		else {
			$.ajax({
	      url: "ajax/simpan_pegawai.php",
	      method: "POST",
	      data: new FormData(this),
	      contentType: false,
	      processData: false,
	      success:function(hasil) {
	      	if(hasil=="gagal-username") {
	      		document.getElementById("username_pgw").focus();
            Swal.fire(
              'Peringatan',
              'Username Telah Digunakan, Ganti Username Pegawai',
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
  	            window.location='?page=pegawai';
  	          }
  	        })
          }
	      }
	    })
		} 
	})
</script>