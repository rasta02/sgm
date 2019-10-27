<?php
        use Ramsey\Uuid\Uuid;
        use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

        if(@$_SESSION['admin']){
?>
<h1>Tambah Data Siswa   </h1>
<hr>
<div class="row">
    <div class="col-sm-12 text-right mb-3">
        <a href="?page=daftar" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Data</a>
    </div>
</div>
<div class="card border-info mb-3">
    <div class="card-header bg-info text-white">Tambah Pengguna</div>
    <div class="card-body">
        <form method="post">
        
            <div class="form-group">
                <label for="nama">Nama</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="nama" class="form-control" required autofocus />
                    </div>
                </div>
                <small>
                        Nama lengkap siswa.
                </small>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="kelas" class="form-control" required autofocus />

                    </div>
                </div>
                <small>
                    Kelas siswa. 
                </small>
            </div>
            
            <div class="form-group">
                <label>SPP</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="spp" class="form-control" required />

                    </div>
                </div>
                <small>
                        SPP bulan ke n.
                </small>
            </div>
           
            <div class="form-group">
                <label>SPP1</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="spp1" class="form-control">
                    </div>
                </div>
                <small>
                        SPP bulan ke n.
                </small>
            </div>
            
            <div class="form-group">
                <label for="nama">SPP2</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="spp2" class="form-control" required />

                    </div>
                </div>
                <small>
                        SPP bulan ke n.
                </small>
            </div>

             <div class="form-group">
                <label for="nama">Lain</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="lain" class="form-control" required />

                    </div>
                </div>
            </div>
            
            <hr>
            <div class="form-group text-right">
                <p>
                    Pilih "Simpan" apabila akan menyimpan data yang dimasukan pada formulir diatas.
                </p>
                <button class="btn btn-secondary" type="reset">Batal</button>
                <button type="submit" class="btn btn-info"name="simpan">Simpan</button>
            </div>

        </form>
        <?php
            if(isset($_POST['simpan'])){
                $uuid4 = Uuid::uuid4();
                $nama = htmlspecialchars($_POST['nama']);
                $kelas = htmlspecialchars(($_POST['kelas']));
                $spp = htmlspecialchars($_POST['spp']);
                $spp1 = htmlspecialchars($_POST['spp1']);
                $spp2 = htmlspecialchars($_POST['spp2']);
                $lain = htmlspecialchars($_POST['lain']);

                // Validasi kolom tidak boleh ada yang kosong 
                //if ($nama == "" || $kelas == "" || $spp == "" || $spp1 == "" || $spp2 == "" || $lain == "") {
                //    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                //    return false ;
                //}
                //
                // Cek Username - Username tidak boleh sama
                //$cekUsername = $conn->prepare("SELECT * FROM user WHERE username = :username");
                //$cekUsername->bindParam('username',$username);
                //$cekUsername->execute();
                //$result = $cekUsername->fetchColumn();
                
                //if($result){
                //    echo "
                //        <script>alert('Username sudah ada!');</script>
                //    ";
                //}else {
                    // Cek Konfirmasi  Password
                //    if ($password !== $repassword) {
                //        echo "
                //            <script>
                //                alert('Konfirmasi Password Tidak Sesuai!');
                //            </script>
                //        ";
                        
                //    }else {
                    
                    // Hashing Password

                //    $passwordHash = password_hash($repassword,PASSWORD_DEFAULT);

                    try {
                        $query = "INSERT INTO daftar VALUES('$uuid4','$nama','$kelas','$spp','$spp1','$spp2','$lain')";
                        $result = $conn->exec($query);

                            echo "
                            <script>
                                alert(' Data berhasil di tambahkan!');
                                window.location.href='?page=daftar';
                            </script>
                        ";

                    } catch (Exception $e) {
                        echo $e->getMessage();
                }
                }
            
        
                                    
               
        ?>
    </div>
    <div class="card-footer bg-info"></div>
</div>
<?php
        } else {
            include "pages/404.php";
        }
?>