<?php 
  session_start();
  if(@$_SESSION['id_pgw']) {
    echo "<script>window.location='./';</script>";
  } else {
?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>Black Shadow | Log in</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="assets/adminLTE/bower_components/Ionicons/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="assets/adminLTE/dist/css/AdminLTE.min.css">
	  <!-- iCheck -->
	  <link rel="stylesheet" href="assets/adminLTE/plugins/iCheck/square/blue.css">
	  <!-- sweetalert -->
	  <link rel="stylesheet" href="../assets/sweetalert/dist/sweetalert2.min.css">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

	  <!-- Google Font -->
	  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
		  <div class="login-logo">
		    <a href="#"><b>Black Shadow</b> Distro</a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
		    <p class="login-box-msg">Sign in to start your session</p>

		    <form method="post" id="form_loginadmnin" enctype="multipart/form-data" autocomplete="off">
		      <div class="form-group has-feedback">
		        <input type="text" class="form-control" placeholder="Username" autofocus="" id="username_pgw" name="username_pgw" required="">
		        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input type="password" class="form-control" placeholder="Password" id="password_pgw" name="password_pgw" required="">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              <!-- <input type="checkbox"> Remember Me -->
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <input type="submit" class="btn btn-primary btn-block btn-flat" value="Masuk">
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>
		    <!-- /.social-auth-links -->

		    <!-- <a href="#">I forgot my password</a><br>
		    <a href="register.html" class="text-center">Register a new membership</a> -->

		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 3 -->
		<script src="assets/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="assets/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="assets/adminLTE/plugins/iCheck/icheck.min.js"></script>
		<!-- Sweet Alert 2 -->
		<script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>

		<script>
		  $("#form_loginadmnin").on("submit", function() {
		  	event.preventDefault();
				$.ajax({
		      url: "ajax/login_admin.php",
		      method: "POST",
		      data: new FormData(this),
		      contentType: false,
		      processData: false,
		      success:function(hasil) {
		      	if(hasil=="berhasil") {
		          window.location='./';
		        } else {
		          document.getElementById("username_pgw").focus();
		          Swal.fire({
		            type: 'error',
		            title: 'Gagal',
		            text: 'Periksa kembali username dan password anda',
		            showConfirmButton: true
		            // timer: 1500
		          })
		        }
		      }
		    })
			})
		</script>
	</body>
</html>
<?php } ?>
