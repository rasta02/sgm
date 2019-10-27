<?php
    use Ramsey\Uuid\Uuid;
    use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
    if(@$_SESSION['admin']){
    $query = $conn->query("SELECT * FROM user ORDER BY username ASC");
?>
<!-- Untuk Member -->
<h1>Kelola Keuangan Anggota  </h1>
<hr>

<div class="card border-info mb-3">
    <div class="card-header bg-info text-white">Tambah Data Keuangan Anggota</div>
    <div class="card-body">
        <form method="post">
        
            <div class="form-group">
                <label for="nama">Tanggal</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="tanggal" class="form-control" required autofocus />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="row">
                    <div class="col-sm-6">
                       <select class="form-control" name="user" required>
                           <option value="">~ Username Anggota ~</option>
                           <?php while($result = $query->fetch(PDO::FETCH_OBJ)): ?>
                           <option value="<?= $result->kode ?>"><?= $result->username ?></option>
                           <?php endwhile; ?>
                       </select>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="row">
                    <div class="col-sm-6">
                       <select class="form-control" name="status" required>
                           <option value="">~ Pilih Status ~</option>
                           <option value="Pemasukan">Pemasukan</option>
                           <option value="Pengeluaran">Pengeluaran</option>
                       </select>

                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Keterangan</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="keterangan" class="form-control" required />

                    </div>
                </div>
            </div>

             <div class="form-group">
                <label for="nama">Jumlah</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" name="jumlah" class="form-control" required />

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
                $user = htmlspecialchars($_POST['user']);
                $tgl = date('Y-m-d',strtotime($_POST['tanggal']));
                $status = htmlspecialchars($_POST['status']);
                $keterangan = htmlspecialchars($_POST['keterangan']);
                $jumlah = htmlspecialchars($_POST['jumlah']);

                if( $tgl == "" || $status == "" || $keterangan == "" || $jumlah == ""){
                    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                }else {
                    try {
                        $query = "INSERT INTO keuangan VALUES ('$uuid4','$user','$tgl','$status','$keterangan','$jumlah')";
                        $conn->exec($query);
                        echo "
                        <script>
                            alert(' Data berhasil di simpan!');
                            window.location.href='?page=keuanganAnggota';
                        </script>
                    ";
                    }catch(Exception $e){
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