<?php
    	use Ramsey\Uuid\Uuid;
        use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
        
        if(@$_SESSION['admin']){
        $primary =addslashes($_GET['id']);
        $query = $conn->query("SELECT * FROM daftar WHERE kode = '$primary' ");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);
?>
<h1>Ganti Kata Sandi    </h1>
<hr>
<div class="row">
    <div class="col-sm-12 mb-3">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $result->nama ?></td>
                    <td><?= $result->username ?></td>
                    <td>0<?= $result->telepon ?></td>
                    <td><?= $result->alamat ?></td>
                    <td><?= $result->level ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>

<div class="card border-info mb-3">
    <div class="card-header bg-info text-white">Ganti Kata Sandi Pengguna</div>
    <div class="card-body">
        <form method="post">
        
        <input type="hidden" name="kode" class="form-control" value="<?= $result->kode ?>" required autofocus />

            <div class="form-group">
                <label for="nama">Kata Sandi Baru</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control"  required autofocus />
                    </div>
                </div>
                <small>
                Buat password seaman mungkin dan mudah di ingat oleh anda.
                </small>
            </div>

            <div class="form-group">
                <label>Ulangi Kata Sandi Baru</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="password" name="repassword" class="form-control" required autofocus />

                    </div>
                </div>
                <small>
                   
                </small>
            </div>
            
            <hr>
            <div class="form-group text-right">
                <p>
                    Pilih "Ganti" apabila akan mengganti kata sandi pengguna pada formulir diatas,<a href='?page=daftar'>kembali</a> jika tidak ingin mengganti kata sandi.
                </p>
                <button class="btn btn-secondary" type="reset">Batal</button>
                <button type="submit" class="btn btn-info" name="ganti">Ganti</button>
            </div>

        </form>
        <?php
            if(isset($_POST['ganti'])){
                $kode = addslashes($_POST['kode']);
                $password = addslashes($_POST['password']);
                $repassword = addslashes($_POST['repassword']);
                
                // Validasi kolom tidak boleh ada yang kosong 
                if ( $password == "" || $repassword == "") {
                    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                    return false ;
			    }
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
                    $query = "UPDATE daftar SET password = '$passwordHash' WHERE kode = '$kode'";
                    $result = $conn->exec($query);

                    if($result){
                        echo "
						<script>
                            alert(' Kata Sandi  berhasil di ganti!');
                            window.location.href='?page=daftar';
						</script>
                        ";
                    }else {
                        echo "
						<script>
                            alert(' Kata Sandi  gagal di ganti!');
                            window.location.href='?page=daftar';
						</script>
                        ";
                    }

                } catch (Exception $e) {
                    echo $e->getMessage();
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