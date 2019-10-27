<?php
    use Ramsey\Uuid\Uuid;
    use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

        $primary =addslashes($_GET['id']);
        $query = $conn->query("SELECT * FROM keuangan WHERE kode = '$primary' ");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);

        $status = $result->status;
?>
<h1>Kelola Keuangan   </h1>
<hr>
<div class="row">
    <div class="col-sm-12 text-right mb-3">
        <a href="?page=keuangan" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Data</a>
    </div>
</div>
<div class="card border-info mb-3">
    <div class="card-header bg-info text-white">Edit Data</div>
    <div class="card-body">
        <form method="post">
        <input type="hidden" name="kode"value="<?= $result->kode ?>">
            <div class="form-group">
                <label for="nama">Tanggal</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" value="<?= $result->tanggal?>" name="tanggal" class="form-control" required autofocus />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="row">
                    <div class="col-sm-6">
                       <select class="form-control" name="status" required>
                           <option value="">~ Pilih Status ~</option>
                           <option <?php if($status == "Pemasukan"){echo "selected";} ?> value="Pemasukan">Pemasukan</option>
                           <option <?php if($status == "Pengeluaran"){echo "selected";} ?> value="Pengeluaran">Pengeluaran</option>
                       </select>

                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Keterangan</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" value="<?= $result->keterangan ?>" name="keterangan" class="form-control" required />

                    </div>
                </div>
            </div>

             <div class="form-group">
                <label for="nama">Jumlah</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="number" value="<?= $result->jumlah ?>" name="jumlah" class="form-control" required />

                    </div>
                </div>
            </div>
            
            <hr>
            <div class="form-group text-right">
                <p>
                    Pilih "Edit" apabila akan Mengedit data yang dimasukan pada formulir diatas.
                </p>
                <button class="btn btn-secondary" type="reset">Batal</button>
                <button type="submit" class="btn btn-info" name="edit">Edit</button>
            </div>

        </form>
        <?php
            if(isset($_POST['edit'])){
                $kode = htmlspecialchars($_POST['kode']);
                $tgl = date('Y-m-d',strtotime($_POST['tanggal']));
                $status = htmlspecialchars($_POST['status']);
                $keterangan = htmlspecialchars($_POST['keterangan']);
                $jumlah = htmlspecialchars($_POST['jumlah']);

                if( $tgl == "" || $status == "" || $keterangan == "" || $jumlah == ""){
                    echo "<script>alert('Data Tidak Boleh Ada Yang Kosong!');</script>";
                }else {
                    try {
                        $query = "UPDATE keuangan SET tanggal = '$tgl',status = '$status',keterangan='$keterangan',jumlah='$jumlah' WHERE kode = '$kode'";
                        $conn->exec($query);
                        echo "
                        <script>
                            alert(' Data berhasil di edit!');
                            window.location.href='?page=keuangan';
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