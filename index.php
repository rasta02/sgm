<?php
  session_start();
  include "__+config/koneksi.php";
  // Libs Untuk membuat ID Random
  require 'vendor/autoload.php';
  
  if(@$_SESSION['admin'] || @$_SESSION['member']){
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      <?php 
        $page = strtolower(@$_GET['page']);

        if($page == "pengguna"){
          echo "Keuangan - Pengguna";
        }else if($page == "keuangan"){
          echo "Keuangan - Pribadi";
        }else if($page == "keuangananggota"){
          echo "Keuangan - Anggota";
        }else if($page == "keuangananggotadetail"){
          echo "Keuangan - Detail Keuangan Anggota";
        }else if($page == "laporankeuangan"){
          echo "Keuangan - Laporan Keuangan";
        }else if($page == "info"){
          echo "Keuangan - Info";
        }else {
          echo "Keuangan";
        }
      ?>
    </title>

    

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!--  CSS Native -->
    <link href="css/mycss.css" rel="stylesheet">

    <!-- Icon -->
    <link rel="icon" href="img/logo.png" sizes="16x16" type="imgae/png">


  </head>

  <body id="page-top">


    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Menu</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <?php
        // Untuk menampilkan nama user yang sedang lgin
        if(@$_SESSION['admin']){
          $userLogin = @$_SESSION['admin'];
        }else {
          $userLogin = @$_SESSION['member'];
        }

        try{
          $result = $conn->query("SELECT * FROM user WHERE kode = '$userLogin'");
          $namaUser = $result->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e){
          echo $e->getMessage();
        }
      ?>

      <!-- Navbar -->
     <ul class="ml-auto"></ul>
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i> Selamat Datang, <?= $namaUser->nama ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="?page=pengguna&action=pengaturan">Pengaturan Akun</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Keluar</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        
        <?php if(@$_SESSION['admin']) {?>

        <li class="nav-item">
          <a class="nav-link" href="?page=pengguna">
            <i class="far fa-fw fa-user"></i>
            <span>coming soon</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="?page=daftar">
            <i class="fas fa-users"></i>
            <span>Keuangan Siswa</span></a>
        </li>

          <?php } ?>   
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-dollar-sign"></i> <span>Keuangan</span>
          </a>
           <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header text-info">Kelola Keuangan :</h6>
            <a class="dropdown-item" href="?page=keuangan">Kelola Keuangan</a>
            <div class="dropdown-divider"></div>
          <!--  <?php if(@$_SESSION['admin']) {?>
            <h6 class="dropdown-header text-info">Keuangan Anggota :</h6>
            <a class="dropdown-item" href="?page=keuanganAnggota">Kelola Keuangan</a>
            <a class="dropdown-item" href="?page=keuanganAnggotaDetail">Detail Keuangan</a>
            <div class="dropdown-divider"></div>
            <?php } ?> -->
            <h6 class="dropdown-header text-info">Laporan Keuangan :</h6>
            <a class="dropdown-item" href="?page=laporanKeuangan&action=laporankeuanganpribadi">Keuangan Pribadi</a>
            <div class="dropdown-divider"></div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="?page=info">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Info</span></a>
        </li>
       
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
          <?php
            $page = strtolower(@$_GET['page']);
            $action = strtolower(@$_GET['action']);
            if($page == ""){
              include "pages/dashboard/dashboard.php";
            }else if($page == "pengguna"){
              if ($action == ""){
                include "pages/pengguna/lihatdata.php";
              }else if($action == "tambah"){
                include "pages/pengguna/tambah.php";
              }else if($action == "edit"){
                include "pages/pengguna/edit.php";
              }else if($action == "hapus"){
                include "pages/pengguna/hapus.php";
              }else if($action == "sandi"){
                include "pages/pengguna/sandi.php";
              }else if($action == "pengaturan"){
                include "pages/pengguna/pengaturan.php";
              }else {
                include "pages/404.php";
              }
            }else if($page == "daftar"){
              if ($action == ""){
                include "pages/daftar/lihatdata.php";
              }else if($action == "tambah"){
                include "pages/daftar/tambah.php";
              }else if($action == "edit"){
                include "pages/daftar/edit.php";
              }else if($action == "hapus"){
                include "pages/daftar/hapus.php";
              }else if($action == "sandi"){
                include "pages/daftar/sandi.php";
              }else if($action == "pengaturan"){
                include "pages/daftar/pengaturan.php";
              }else {
                include "pages/404.php";
              }  
            }else if($page == "keuangan"){
              if($action == ""){
                include "pages/keuangan/lihatdatapemasukan.php";
              }else if($action == "tambah"){
                  include "pages/keuangan/tambah.php";
              }else if($action == "pengeluaran"){
                include "pages/keuangan/lihatdatapengeluaran.php";
              }else if($action == "edit"){
                include "pages/keuangan/edit.php";
              }else if($action == "hapus"){
                include "pages/keuangan/hapus.php";
              } else {
                include "pages/404.php";
              }
            }else if($page == "keuangananggota"){
              if($action == ""){
                include "pages/keuangan/anggota/tambah.php";              
              }else if($action == "hapus"){
                include "pages/keuangan/anggota/hapus.php";
              } else {
                include "pages/404.php";
              }
            }else if($page == "keuangananggotadetail"){
              if($action == ""){
                include "pages/keuangan/anggota/detail.php";
              }else {
                include "pages/404.php";
              }
            }else if($page == "laporankeuangan"){
              if($action == "laporankeuanganpribadi"){
                include "pages/laporan/laporankeuanganpribadi.php";
              }else {
                include "pages/404.php";
              }
            }else if($page == "info"){
                include "pages/info.php";
            }else {
              include "pages/404.php";
            }
          ?>
          
          

        </div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Team IT 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Siap Untuk Keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih tombol "Keluar" jika anda siap keluar dari sesi ini .</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="logout.php">Keluar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
<?php
  } else {
    header("location:login.php");
  }
?>