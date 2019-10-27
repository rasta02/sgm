<?php 
    $query = $conn->query("SELECT * FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$userLogin' ORDER BY tanggal DESC LIMIT 10");
?>
<h1>Lihat Data Pemasukan</h1>
<hr>

<div class="row">
    <div class="col-sm-6 mb-3">
        <!-- Search / Cari -->
        <form action="" method="post">
            <div class="input-group">
                <input type="date" name="kunci" id="datepicker" class="form-control">
                <div class="input-group-append">
                    <button type="submit" name="cari" class="btn btn-secondary"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
            <small>Cari Berdasarkan Tanggal, Contoh Seperti Di atas.</small>
        </form>
    </div>

    <!-- Tambah -->
    <div class="col-sm-6 text-right mb-3">
    <a href="?page=keuangan" class="btn btn-success"><i class="fa fa-sync-alt"></i>  Refresh</a>
        <a href="?page=keuangan&action=pengeluaran" class="btn btn-success"><i class="fa fa-eye"></i>  Pengeluaran</a>
        <a href="?page=keuangan&action=tambah" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Data</a>
    </div>

</div>

<table class="table table-striped table-bordered table-sm">
	<thead>
		<tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Opsi</th>
		</tr>
    </thead>
   
	<tbody>
    <?php 
            if(isset($_POST['cari'])){
                $tgl = date('Y-m-d',strtotime($_POST['kunci']));
                $keyword = addslashes($tgl);
                if($keyword == ""){
                    $query = $conn->query("SELECT * FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$userLogin' ORDER BY tanggal DESC");
                }else {
                    $query = $conn->query("SELECT * FROM keuangan WHERE status = 'Pemasukan' AND tanggal LIKE '%$keyword%' ORDER BY tanggal DESC");
                }
            }
            

            $cekKolom = $query->rowCount();

            if($cekKolom < 1){
        ?>
            <tr>
                <td colspan="5"><center>Data Tidak Ada!.</center></td>
            </tr>
        <?php
            }else {
                $no = 1;
            while($result = $query->fetch(PDO::FETCH_OBJ)):
            // Untuk membuat format rupiah di php
            $jumlah =  $result->jumlah;
            $resultJumlah = number_format($jumlah,2,',','.');
        ?>  
    <tr>
        <td><?= $no++ ?>.</td>
        <td><?= $result->tanggal ?></td>
        <td><?= $result->keterangan ?></td>
        <td><?= $resultJumlah;   ?></td>
        <td>
            <a href="?page=keuangan&action=edit&id=<?= $result->kode ?>" class="btn btn-sm btn-primary">
                <span class="fa fa-edit"></span> Edit
            </a>
            <a onclick="return confirm('Yakin ingin menghapus data');" href="?page=keuangan&action=hapus&id=<?= $result->kode ?>" class="btn btn-sm btn-danger">
                <span class="fa fa-trash"></span> Hapus
            </a>
        </td>
    </tr>
            <?php endwhile; }?>
    </tbody>
    <tfoot>
        <?php 
            // untuk menghitung seluruh jumlah pemasukan
            $result = $conn->query("SELECT  SUM(jumlah) AS pemasukan FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$userLogin' ");
            if(isset($_POST['cari'])){
                $tgl = date('Y-m-d',strtotime($_POST['kunci']));
                $keyword = addslashes($tgl);
                if($keyword == ""){
                    $result = $conn->query("SELECT  SUM(jumlah) AS pemasukan FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$userLogin'");  
                }else {
                    $result = $conn->query("SELECT  SUM(jumlah) AS pemasukan FROM keuangan WHERE status = 'Pemasukan' AND tanggal = '$keyword' AND kodeUser = '$userLogin'");  
                }
            }
            while($data = $result->fetch(PDO::FETCH_OBJ)):
            
                // Untuk membuat format rupiah di php
            $jumlah =  $data->pemasukan;
            $resultJumlah = number_format($jumlah,2,',','.');
        ?>
        <tr>
            <td colspan="3"><strong>Jumlah</strong></td>
            <td colspan="2"><?= $resultJumlah; ?></td>
        </tr>
            <?php endwhile;?>
        <tr>
            <td colspan="6">
            <!-- Untuk Melihat Pencatatan Keselurahan data pemasukan -->
            <?php
                $sql = $conn->query("SELECT * FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$userLogin' ");
                $count = $sql->rowCount();

                if(isset($_POST['cari'])){
            ?>
                Hasil Pencarian Data : <b><?= $cekKolom ?></b>
            <?php
                }else {
            ?>
                Jumlah Pencatatan Data Pemasukan:  <b><?= $count ?></b> Data yang di tampilkan, 10 data pencatatan terbaru.
            <?php
                }
            ?>
            </td>
        </tr>
    </tfoot>
</table>

<script>
    document.getElementById('datepicker').valueAsDate = new Date();
</script>