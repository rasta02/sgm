<?php
        
    	use Ramsey\Uuid\Uuid;
        use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

        if(@$_SESSION['admin']){
        $primary =addslashes($_GET['id']);
        $query = $conn->query("SELECT * FROM user WHERE kode = '$primary' ");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);
?>
<h1>Edit Data Pengguna   </h1>
<hr>
<div class="row">
    <div class="col-sm-12 text-right mb-3">
        <a href="?page=pengguna" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Data</a>
    </div>
</div>
<div class="card border-info mb-3">
    <div class="card-header bg-info text-white">Edit Data Pengguna</div>
    <div class="card-body">
        <form method="post">
        
        <input type="hidden" name="kode" class="form-control" value="<?= $result->kode ?>" required autofocus />

            <div class="form-group">
                <label for="nama">Nama</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="nama" class="form-control" value="<?= $result->nama ?>" required autofocus />
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
                        <input type="text" name="username" class="form-control" value="<?= $result->username ?>" required autofocus />

                    </div>
                </div>
                <small>
                    Tidak boleh menggunakan spasi,huruf kecil semua <br> Contoh : Fauzi,fauzi761,fauzi_pnd.
                </small>
            </div>
            
            <div class="form-group">
                <label>Telepon</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="telepon" class="form-control" value="0<?= $result->telepon ?>" required />

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
                        <textarea name="alamat" class="form-control"><?= $result->alamat ?></textarea>
                    </div>
                </div>
                <small>
                        Contoh  : Pangandaran,Jl.Jangilus Rt/Rw: 04/06
                </small>
            </div>
        
            
            <hr>
            <div class="form-group text-right">
                <p>
                    Pilih "Edit" apabila akan mengedit data yang dimasukan pada formulir diatas.
                </p>
                <button class="btn btn-secondary" type="reset">Batal</button>
                <button type="submit" class="btn btn-info" name="edit">Edit</button>
            </div>

        </form>
        <?php
            if(isset($_POST['edit'])){
                $uuid4 = Uuid::uuid4();
                $kode = htmlspecialchars($_POST['kode']);
                $nama = htmlspecialchars($_POST['nama']);
                $username = htmlspecialchars(str_replace(' ','',strtolower($_POST['username'])));
                $telepon = htmlspecialchars($_POST['telepon']);
                $alamat = htmlspecialchars($_POST['alamat']);

                // Validasi kolom tidak boleh ada yang kosong 
                if ($nama == "" || $username == "" || $telepon == "" || $alamat == "") {
                    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                    return false ;
			    }
               

                try {
                    $query = "UPDATE user SET nama = '$nama',username='$username',telepon='$telepon',alamat='$alamat' WHERE kode = '$kode'";
                    $result = $conn->exec($query);

                    if($result){
                        echo "
						<script>
                            alert(' Data berhasil di edit!');
                            window.location.href='?page=pengguna';
						</script>
                        ";
                    }else {
                        echo "
						<script>
                            alert(' Data gagal di edit!');
                            window.location.href='?page=pengguna';
						</script>
                        ";
                    }

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