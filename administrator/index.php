<?php 
  require_once "../koneksi.php";
  session_start();
  if(!@$_SESSION['id_pgw']) {
    echo "<script>window.location='login.php';</script>";
  } else {
 ?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>Black Shadow | Administrator</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
	  <!-- DataTables -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="assets/adminLTE/dist/css/AdminLTE.min.css">
	  <!-- Morris chart -->
  	<link rel="stylesheet" href="assets/adminLTE/bower_components/morris.js/morris.css">
  	<!-- jvectormap -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/jvectormap/jquery-jvectormap.css">
	  <!-- Date Picker -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	  <!-- Daterange picker -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	  <!-- bootstrap wysihtml5 - text editor -->
	  <link rel="stylesheet" href="assets/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	  <link rel="stylesheet" href="assets/adminLTE/dist/css/skins/_all-skins.min.css">

	  <link rel="stylesheet" href="assets/googlefont/googlefont.css">

	  <link rel="stylesheet" href="assets/style/admin_style.css">

	  <link rel="stylesheet" href="../assets/sweetalert/dist/sweetalert2.min.css">
		
		<!-- Select 2 -->
	  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/select2/dist/css/select2.min.css">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

	  <header class="main-header">
	    <!-- Logo -->
	    <a href="./" class="logo">
	      <!-- mini logo for sidebar mini 50x50 pixels -->
	      <span class="logo-mini" style="font-size: 14px;">BSB</span>
	      <!-- logo for regular state and mobile devices -->
	      <span class="logo-lg">Black Shadow | distro</span>
	    </a>
	    <!-- Header Navbar: style can be found in header.less -->
	    <nav class="navbar navbar-static-top">
	      <!-- Sidebar toggle button-->
	      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </a>

	      <div class="navbar-custom-menu">
	        <ul class="nav navbar-nav">
	          <!-- User Account: style can be found in dropdown.less -->
	          <li class="dropdown user user-menu">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	              <img src="assets/adminLTE/dist/img/avatar6.jpg" class="user-image" alt="User Image">
	              <span class="hidden-xs"><?php echo $_SESSION['nama_pgw']; ?></span>
	            </a>
	            <ul class="dropdown-menu">
	              <!-- User image -->
	              <li class="user-header">
	                <img src="assets/adminLTE/dist/img/avatar6.jpg" class="img-circle" alt="User Image">

	                <p>
	                  <?php echo $_SESSION['username_pgw']; ?> - <?php echo $_SESSION['posisi_pgw']; ?> <br>
	                  <span class="text-white tanggal-jam" id="tanggal"><?php echo date('d M Y'); ?> - </span><span class="text-white tanggal-jam" id="jam"></span>
	                </p>
	              </li>
	              <!-- Menu Footer-->
	              <li class="user-footer">
	                <div class="pull-left">
	                  <a href="?page=edit_pegawai&id_pgw=<?php echo $_SESSION['id_pgw']; ?>" class="btn btn-default btn-flat">Profile</a>
	                </div>
	                <div class="pull-right">
	                  <button type="button" class="btn btn-default btn-flat" id="tmb_logout">Log out</button>
	                </div>
	              </li>
	            </ul>
	          </li>
	          <!-- Control Sidebar Toggle Button -->
	          <!-- <li>
	            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i> Test</a>
	          </li> -->
	        </ul>
	      </div>
	    </nav>
	  </header>

	  <!-- =============================================== -->

	  <!-- Left side column. contains the sidebar -->
	  <aside class="main-sidebar">
	    <!-- sidebar: style can be found in sidebar.less -->
	    <section class="sidebar">
	      <!-- sidebar menu: : style can be found in sidebar.less -->
	      <ul class="sidebar-menu" data-widget="tree">
	        <li class="header">MAIN NAVIGATION</li>
	        <li class="<?php if(@$_GET['page']=='') {echo 'active';} ?>">
	          <a href="./">
	            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
	          </a>
	        </li>
	        <li class="treeview <?php if(@$_GET['page']=='produk' || @$_GET['page']=='tambah_produk' || @$_GET['page']=='edit_produk' || @$_GET['page']=='pegawai' || @$_GET['page']=='tambah_pegawai' || @$_GET['page']=='edit_pegawai' || @$_GET['page']=='pelanggan') {echo 'active';} ?>">
	          <a href="#">
	            <i class="fa fa-folder"></i> <span>Master</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	            <li class="<?php if(@$_GET['page']=='produk' || @$_GET['page']=='tambah_produk' || @$_GET['page']=='edit_produk') {echo 'active';} ?>">
	              <a href="?page=produk">
	                <i class="fa fa-circle-o"></i> Produk
	              </a>
	            </li>
	            <li class="<?php if(@$_GET['page']=='pegawai' || @$_GET['page']=='tambah_pegawai' || @$_GET['page']=='edit_pegawai') {echo 'active';} ?>">
	              <a href="?page=pegawai">
	                <i class="fa fa-circle-o"></i> Pegawai
	              </a>
	            </li>
	            <li class="<?php if(@$_GET['page']=='pelanggan') {echo 'active';} ?>">
	              <a href="?page=pelanggan">
	                <i class="fa fa-circle-o"></i> Pelanggan
	              </a>
	            </li>
	          </ul>
	        </li>

	        <li class="<?php if(@$_GET['page']=='data_keranjang') {echo 'active';} ?>">
	          <a href="?page=data_keranjang">
	            <i class="fa fa-shopping-cart"></i> <span>Keranjang</span>
	          </a>
	        </li>

	        <li class="<?php if(@$_GET['page']=='data_ulasan') {echo 'active';} ?>">
	          <a href="?page=data_ulasan">
	            <i class="fa fa-comment"></i> <span>Ulasan Pelanggan</span>
	          </a>
	        </li>

	        <li class="treeview <?php if(@$_GET['page']=='data_transaksi_offline' || @$_GET['page']=='data_transaksi_online' || @$_GET['page']=='transaksi_offline' || @$_GET['page']=='form_pengiriman' || @$_GET['page']=='form_editpengiriman' || @$_GET['page']=='laporan_penjualan') {echo 'active';} ?>">
	          <a href="#">
	            <i class="fa fa-money"></i> <span>Transaksi Penjualan</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	            <li class="<?php if(@$_GET['page']=='data_transaksi_offline' || @$_GET['page']=='transaksi_offline') {echo 'active';} ?>">
	              <a href="?page=data_transaksi_offline">
	                <i class="fa fa-circle-o"></i> Offline
	              </a>
	            </li>
	            <li class="<?php if(@$_GET['page']=='data_transaksi_online' || @$_GET['page']=='form_pengiriman' || @$_GET['page']=='form_editpengiriman') {echo 'active';} ?>">
	              <a href="?page=data_transaksi_online">
	                <i class="fa fa-circle-o"></i> Online
	              </a>
	            </li>
	            <li class="<?php if(@$_GET['page']=='laporan_penjualan') {echo 'active';} ?>">
	              <a href="?page=laporan_penjualan">
	                <i class="fa fa-circle-o"></i> Laporan Penjualan
	              </a>
	            </li>
	          </ul>
	        </li>
	        <li class="header">LABELS</li>
	        <li><a href="../" target="blank"><i class="fa fa-circle-o text-aqua"></i> <span>Halaman Pelanggan</span></a></li>
	      </ul>
	    </section>
	    <!-- /.sidebar -->
	  </aside>

	  <!-- =============================================== -->
	  <!-- jQuery 3 -->
	  <script src="assets/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
	  <!-- Bootstrap 3.3.7 -->
	  <script src="assets/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	  <!-- Sweet Alert 2 -->
	  <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
	  <!-- Morris.js charts -->
		<script src="assets/adminLTE/bower_components/raphael/raphael.min.js"></script>
		<script src="assets/adminLTE/bower_components/morris.js/morris.min.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="assets/adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
		<!-- Select 2 JS -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
		<script src="assets/adminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
		<script src="assets/ChartJs/Chart.min.js"></script>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <?php 
	      if(@$_GET['page']=='') {
	        include "pages/dashboard.php";
	      } else if(@$_GET['page']=='produk') {
	        include "pages/data_produk.php";
	      } else if(@$_GET['page']=='tambah_produk') {
	        include "pages/tambah_produk.php";
	      } else if(@$_GET['page']=='edit_produk') {
	        include "pages/edit_produk.php";
	      } else if(@$_GET['page']=='pegawai') {
	        include "pages/data_pegawai.php";
	      } else if(@$_GET['page']=='tambah_pegawai') {
	        include "pages/tambah_pegawai.php";
	      } else if(@$_GET['page']=='edit_pegawai') {
	        include "pages/edit_pegawai.php";
	      } else if(@$_GET['page']=='pelanggan') {
	        include "pages/data_pelanggan.php";
	      } else if(@$_GET['page']=='data_keranjang') {
	        include "pages/data_keranjang.php";
	      } else if(@$_GET['page']=='data_ulasan') {
	        include "pages/data_ulasan.php";
	      } else if(@$_GET['page']=='data_transaksi_offline') {
	        include "pages/data_transaksi_offline.php";
	      } else if(@$_GET['page']=='transaksi_offline') {
	        include "pages/transaksi_offline.php";
	      } else if(@$_GET['page']=='data_transaksi_online') {
	        include "pages/data_transaksi_online.php";
	      } else if(@$_GET['page']=='form_pengiriman') {
	        include "pages/form_pengiriman.php";
	      } else if(@$_GET['page']=='form_editpengiriman') {
	        include "pages/form_editpengiriman.php";
	      } else if(@$_GET['page']=='laporan_penjualan') {
	        include "pages/laporan_penjualan.php";
	      } 
	     ?>
	  </div>
	  <!-- /.content-wrapper -->

	  <footer class="main-footer">
	    <div class="pull-right hidden-xs">
	      <!-- <b>Built By : Abdul Kamal Mukmin</b> -->
	    </div>
	    <strong>Copyright &copy; 2020 Black Shadow Distro.</strong> Kebumen
	  </footer>
	</div>
	<!-- ./wrapper -->

	<!-- AdminLTE App -->
	<script src="assets/adminLTE/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="assets/adminLTE/dist/js/demo.js"></script>
	<!-- DataTables -->
	<script src="assets/adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script>
	  $(document).ready(function () {
	    $('.sidebar-menu').tree()
	  })

	  $(function () {
	    $('#example1').DataTable();

	    $('#tbl_dproduk').DataTable({
	      'paging'      : true,
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : true,
	      'info'        : false,
	      'autoWidth'   : true,
	      'lengthMenu' : [[50, 100, -1], [50, 100, "All"]]
	    })

	    $('.tabel_transaksi').DataTable({
	      'paging'      : true,
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : true,
	      'info'        : false,
	      'autoWidth'   : true
	    });
	  })

	  $("#tmb_logout").click(function(){
      // alert("Log Out");
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'anda akan keluar dari aplikasi',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya'
      }).then((tes) => {
        if (tes.value) {
          $.ajax({
            type: "POST",
            url: "ajax/logout.php",
            success: function(hasil) {
              window.location='./';
            }
          })  
        }
      })
      });

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      // add a zero in front of numbers<10
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('jam').innerHTML = h + ":" + m + ":" + s;
      t = setTimeout(function() {
        startTime()
      }, 500);
    }
    startTime();
	</script>
	</body>
</html>
<?php 
  }
?>
