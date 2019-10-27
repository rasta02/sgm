<?php
   session_start();
   require 'vendor/autoload.php';
   use Ramsey\Uuid\Uuid;
   use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
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

    <title>SiteZy - Daftar Akun</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!--  CSS Native -->
    <link href="css/mycss.css" rel="stylesheet">

    <!-- Icon -->
    <link rel="icon" href="img/logo.png" sizes="16x16" type="imgae/png">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Daftar Akun</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" name="nama" class="form-control" placeholder="nama" required="required" autofocus="autofocus">
                    <label for="firstName">Nama Lengkap</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" name="username" class="form-control" placeholder="username" required="required">
                    <label for="lastName">Username</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="inputEmail" name="telepon" class="form-control" placeholder="Telepon" required="required">
                <label for="inputEmail">Telepon</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control" rows="5" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="repassword" class="form-control" placeholder="Konfirmasi password" required="required">
                    <label for="confirmPassword">Konfirmasi password</label>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit" name="simpan">Daftar</button>
          </form>
          <?php
          if(isset($_POST['simpan'])){
                $uuid4 = Uuid::uuid4();
                $nama = htmlspecialchars($_POST['nama']);
                $username = htmlspecialchars(str_replace(' ','',strtolower($_POST['username'])));
                $telepon = htmlspecialchars($_POST['telepon']);
                $alamat = htmlspecialchars($_POST['alamat']);
                $password = addslashes($_POST['password']);
                $repassword = addslashes($_POST['repassword']);

                // Validasi kolom tidak boleh ada yang kosong 
                if ($nama == "" || $username == "" || $telepon == "" || $alamat == "" || $password == "" || $repassword == "") {
                    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                    return false ;
                }
                
                // Cek Username - Username tidak boleh sama
                $cekUsername = $conn->prepare("SELECT * FROM user WHERE username = :username");
                $cekUsername->bindParam('username',$username);
                $cekUsername->execute();
                $result = $cekUsername->fetchColumn();
                
                if($result){
                    echo "
                        <script>alert('Username sudah ada!');</script>
                    ";
                }else {
                    // Cek Konfirmasi  Password
                    if ($password !== $repassword) {
                        echo "
                            <script>
                                alert('Konfirmasi Password Tidak Sesuai!');
                            </script>
                        ";
                        
                    }else {
                    
                    // Hashing Password

                    $passwordHash = password_hash($repassword,PASSWORD_DEFAULT);

                    try {
                        $query = "INSERT INTO user VALUES('$uuid4','$nama','$username','$passwordHash','$telepon','$alamat','Member')";
                        $result = $conn->exec($query);

                            echo "
                            <script>
                                alert(' Pendaftaran Berhasil, Silahkan Login!');
                                window.location.href='login.php';
                            </script>
                        ";

                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    }
                }
            }

        ?>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Halaman Login</a>
            <a class="d-block small" href="lupa-password.php">Lupa Username / Password ?</a>
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