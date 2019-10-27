<?php
   session_start();
   include "__+config/koneksi.php";
   if(@$_SESSION['admin'] || @$_SESSION['member']){
     header("location:index.php");
   }else{
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SiteZy - Lupa Password</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Icon -->
    <link rel="icon" href="img/logo.png" sizes="16x16" type="imgae/png">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Ganti Username / Password</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4>Lupa Username / Password?</h4>
            <p>Silahkan Hubungi admin dengan menekan tombol "<strong>Hubungi</strong>" di bawah ini. Tenang! <br>Keaman akun anda akan terjaga oleh kami.</p>
          </div>
            <a class="btn btn-primary btn-block text-white" target="_blank" href="https://bit.ly/2maqdOb"><i class="fab fa-whatsapp"></i> Hubungi</a>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Daftar Akun</a>
            <a class="d-block small" href="login.php">Halaman Login</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
<?php
  }
?>