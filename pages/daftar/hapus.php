<?php 
    if(@$_SESSION['admin']){
    $primary = addslashes($_GET['id']);
    
    try{
        $query = "DELETE FROM daftar WHERE kode = '$primary'";
        $conn->exec($query);
        echo "
            <script>
                alert('Data berhasil dihapus!');
                window.location.href = '?page=daftar';
            </script>
        ";
    }catch(Exception $e){
        // echo $e->getMessage();
        echo '<h1 class="display-1">404</h1>
        <hr />
        <p class="lead">Data gagal  di hapus,User masih memiliki catatan data keuangan.
          <a href="?page=daftar">kembali </a> 
        ';
    }
        } else {
            include "pages/404.php";
        }
?>