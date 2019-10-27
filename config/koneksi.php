<?php   

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "app_tabungannative";
    try{
        $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e) {
        echo "gagal konek".$e->getMessage();
    }