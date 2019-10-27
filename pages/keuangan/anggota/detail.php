<?php if(@$_SESSION['admin']){     ?>
<h1>Detail Data Keuangan Anggota</h1>
<hr>

<div class="row">
<div class="col-sm-6 mb-3">
        <!-- Search / Cari -->
        <form action="" method="post">
            <div class="input-group">
                <select name="detail" class="form-control" required>
                    <option value="">~~~ Pilih Username Admin ~~~</option>
                    <?php 
                       $query = $conn->query("SELECT * FROM user WHERE level = 'admin' ORDER BY username ASC");
                       while($result = $query->fetch(PDO::FETCH_OBJ)):
                    ?>
                    <option value="<?= $result->kode ?>"><?= $result->username?></option>
                    <?php
                        endwhile;
                    ?>
                    <option value="">~~~ Pilih Username Member ~~~</option>
                    <?php 
                       $query = $conn->query("SELECT * FROM user WHERE level = 'member' ORDER BY username ASC");
                       while($result = $query->fetch(PDO::FETCH_OBJ)):
                    ?>
                    <option value="<?= $result->kode ?>"><?= $result->username?></option>
                    <?php
                        endwhile;
                    ?>
                </select>
                <div class="input-group-append">
                    <button type="submit" name="cari" class="btn btn-secondary"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
<div class="col-sm-6 text-right mb-3">
    <?php
        if(isset($_POST['cari'])){
            $primary = addslashes($_POST['detail']);
            if($primary != ""){
                $query = $conn->query("SELECT username FROM user WHERE kode = '$primary' ORDER BY username ASC");
                $user = $query->fetch(PDO::FETCH_OBJ);
                echo "Detail Keuangan berdasarkan username '<b>".$user->username."</b>'";
            }
        }
    ?>
            <button onclick="window.location.href='?page=keuanganAnggotaDetail'" class="btn btn-success"><i class="fa fa-sync-alt"></i> Refresh</button>
</div>
</div>

<?php
            if(isset($_POST['cari'])){
                $primary = addslashes($_POST['detail']);
                if($primary != ""){
                    $query = $conn->query("SELECT * FROM user WHERE kode = '$primary'");
                    $user = $query->fetch(PDO::FETCH_OBJ);
                    $kode = $user->kode;
                    
                    $result = $conn->query("SELECT  SUM(jumlah) AS pemasukan FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$kode' ");
                      $data = $result->fetch(PDO::FETCH_OBJ);
                      $jumlahPemasukan =  $data->pemasukan;

                      $result = $conn->query("SELECT  SUM(jumlah) AS pengeluaran FROM keuangan WHERE status = 'Pengeluaran' AND kodeUser = '$kode' ");
                      $data = $result->fetch(PDO::FETCH_OBJ);
                      $jumlahPengeluaran =  $data->pengeluaran;

                     $result = $conn->query("SELECT ROUND ( SUM(IF(status = 'Pemasukan', jumlah, 0))-(SUM(IF( status = 'Pengeluaran', jumlah, 0))) ) AS subtotal FROM keuangan WHERE kodeUser = '$kode' ");
                      $data = $result->fetch(PDO::FETCH_OBJ);
                      $subtotal =  $data->subtotal;
                ?>
<div class="row tabelku">
<table class="table table-striped table-sm ">
	<thead>
		<tr>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
            <th>Total Saldo</th>
		</tr>
    </thead>
   
    <tbody>
    <tr>
        <td><?= $user->nama ?></td>
        <td>0<?= $user->telepon ?></td>
        <td><?= $user->alamat ?></td>
        <td>Rp.<?= number_format($jumlahPemasukan,2,',','.'); ?></td>
        <td>Rp.<?= number_format($jumlahPengeluaran,2,',','.'); ?></td>
        <td>Rp.<?= number_format($subtotal,2,',','.'); ?></td>
    </tr>
    </tbody>
    
</table>
</div>
<div class="row">
    <div class="col-sm-12 text-right">
        <a onclick="return confirm('Yakin ingin  menghapus semua data keuangan anggota ini ? ');" href="?page=keuangananggota&action=hapus&id=<?= $user->kode?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Semua Data Keuangan <?= $user->username ?></a>
    </div>
</div>
<?php
                }}    
    } else {
            include "pages/404.php";
        }
?>