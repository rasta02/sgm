<?php
        use Ramsey\Uuid\Uuid;
        use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

        if(@$_SESSION['admin']){
?>
<h1>Tambah Data Pengguna   </h1>
<hr>
<div class="row">
    <div class="col-sm-12 text-right mb-3">
        <a href="?page=pengguna" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Data</a>
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
                        Contoh : Fauzi Pnd
                </small>
            </div>

            <div class="form-group">
                <label>Username</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" required autofocus />

                    </div>
                </div>
                <small>
                    Tidak boleh menggunakan spasi, huruf kecil semua, username tidak boleh sama. <br> Contoh : Fauzi,fauzi761,fauzi_pnd.
                </small>
            </div>
            
            <div class="form-group">
                <label>Telepon</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="telepon" class="form-control" required />

                    </div>
                </div>
                <small>
                        Harus dengan nomer telepon yang masih aktif, Contoh  : 081221xxxxxx
                </small>
            </div>
           
            <div class="form-group">
                <label>Alamat</label>
                <div class="row">
                    <div class="col-sm-6">
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                </div>
                <small>
                        Contoh  : Pangandaran,Jl.Jangilus Rt/Rw: 04/06
                </small>
            </div>
            
            <div class="form-group">
                <label for="nama">Password</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" required />

                    </div>
                </div>
                <small>
                        Buat password seaman mungkin dan mudah di ingat oleh anda.
                </small>
            </div>

             <div class="form-group">
                <label for="nama">Ulangi Password</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="password" name="repassword" class="form-control" required />

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
                                alert(' Data berhasil di tambahkan!');
                                window.location.href='?page=pengguna';
                            </script>
                        ";

                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    }
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