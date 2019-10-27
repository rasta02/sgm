<?php
        
    	use Ramsey\Uuid\Uuid;
        use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

        if(@$_SESSION['admin']){
        $primary =addslashes($_GET['id']);
        $query = $conn->query("SELECT * FROM daftar WHERE kode = '$primary' ");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);
?>
<h1>Edit Data Keuangan Siswa   </h1>
<hr>
<div class="row">
    <div class="col-sm-12 text-right mb-3">
        <a href="?page=daftar" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Data</a>
    </div>
</div>
<div class="card border-info mb-3">
    <div class="card-header bg-info text-white">Edit Data Siswa</div>
    <div class="card-body">
        <form method="post">
        
        <input type="hidden" name="kode" class="form-control" value="<?= $result->kode ?>" required autofocus />

            <div class="form-group">
                <label for="nama">Nama</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="nama" class="form-control" value="<?= $result->nama ?>" required autofocus/>
                    </div>
                </div>
                <small>
                        Nama lengkap siswa
                </small>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="kelas" class="form-control" value="<?= $result->kelas ?>" required autofocus />

                    </div>
                </div>
                <small>
                    Kelas siswa
                </small>
            </div>
            
            <div class="form-group">
                <label>SPP</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="spp" class="form-control" value="<?= $result->spp ?>" required />

                    </div>
                </div>
                <small>
                        SPP bulan ke n
                </small>
            </div>
           
            <div class="form-group">
                <label>SPP1</label>
                <div class="row">
                    <div class="col-sm-6">
                    <input type="number" name="spp1" class="form-control" value="<?= $result->spp1 ?>" required />
                    </div>
                </div>
                <small>
                        SPP bulan ke n
                </small>
            </div>

            <div class="form-group">
                <label>SPP2</label>
                <div class="row">
                    <div class="col-sm-6">
                    <input type="number" name="spp2" class="form-control" value="<?= $result->spp2 ?>" required />
                    </div>
                </div>
                <small>
                        SPP bulan ke n
                </small>
            </div>

            <div class="form-group">
                <label>Lain</label>
                <div class="row">
                    <div class="col-sm-6">
                    <input type="number" name="lain" class="form-control" value="<?= $result->lain ?>" required />
                    </div>
                </div>
                <small>
                        Tagihan lain lain
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
                $kelas = htmlspecialchars($_POST['kelas']);
                $spp = htmlspecialchars($_POST['spp']);
                $spp1 = htmlspecialchars($_POST['spp1']);
                $spp2 = htmlspecialchars($_POST['spp2']);
                $lain = htmlspecialchars($_POST['lain']);

                // Validasi kolom tidak boleh ada yang kosong 
                if ($nama == "" || $kelas == "" || $spp == "" || $spp1 == "" || $spp2 == "" || $lain == "") {
                    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                    return false ;
			    }
               

                try {
                    $query = "UPDATE daftar SET nama = '$nama', kelas= '$kelas', spp= '$spp', spp1= '$spp1', spp2= '$spp2', lain= '$lain' WHERE kode = '$kode'";
                    $result = $conn->exec($query);

                    if($result){
                        echo "
						<script>
                            alert(' Data berhasil di edit!');
                            window.location.href='?page=daftar';
						</script>
                        ";
                    }else {
                        echo "
						<script>
                            alert(' Data gagal di edit!');
                            window.location.href='?page=daftar';
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