<?php 
    $primary = addslashes($_GET['id']);
    
    try{
        $query = "DELETE FROM keuangan WHERE kode = '$primary'";
        $conn->exec($query);
        echo "
            <script>
                alert('Data berhasil dihapus!');
                window.location.href = '?page=keuangan';
            </script>
        ";
    }catch(Exception $e){
        echo $e->getMessage();
    }