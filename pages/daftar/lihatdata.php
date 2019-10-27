<?php if(@$_SESSION['admin']){ $query = $conn->query("SELECT * FROM daftar ORDER BY kelas ASC");    ?>
    
<h1>Keuangan Siswa</h1>
<hr>

<div class="row">

    <div class="col-sm-6 mb-3">
        <!-- Search / Cari -->
        <form action="" method="post">
            <div class="input-group">
                <input type="text" name="kunci" placeholder="Cari..." autocomplete="off" class="form-control">
                <div class="input-group-append">
                    <button type="submit" name="cari" class="btn btn-secondary"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>


    <!-- Tambah & Refresh-->
    <div class="col-sm-6 text-right mb-3">
        <button onclick="window.location.href='?page=daftar'" class="btn btn-success"><i class="fa fa-sync-alt"></i> </button>
        <a href="?page=daftar&action=tambah" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Data</a>
    </div>

</div>

<div class="row tabelku">
<table class="table table-striped table-sm">
	<thead>
		<tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>SPP</th>
            <th>SPP1</th>
            <th>SPP2</th>
            <th>Lain</th>
            <th>Menu</th>
		</tr>
    </thead>
   
	<tbody>
        <?php 
         if(isset($_POST['cari'])){
            $keyword = addslashes($_POST['kunci']);
            if($keyword != ""){
                $query = $conn->query("SELECT * FROM daftar WHERE nama LIKE '%$keyword%' OR kelas LIKE'%$keyword%' OR spp LIKE '%$keyword%' OR spp1 LIKE '%$keyword%' OR spp2 LIKE '%$keyword%' OR lain LIKE '%$keyword%' ORDER BY kelas ASC");
            }else {
                $query = $conn->query("SELECT * FROM daftar ORDER BY kelas ASC");
            }
        }
        $cekKolom = $query->rowCount();

         if($cekKolom < 1){
        ?>
            <tr>
                <td colspan="7"><center>Data Tidak Ada!.</center></td>
            </tr>
        <?php
            }else {
                $no = 1;
            while($result = $query->fetch(PDO::FETCH_OBJ)):
            // Untuk membuat format rupiah di php
            $jumlah = $result->jumlah
            $resultJumlah = number_format($jumlah,2,')
        ?>
    <tr>
        <td align="center"><?= $no++  ?>.</td>
        <td><?= $result->nama ?></td>
        <td><?= $result->kelas ?></td>
        <td>Rp. <?= $result->spp ?></td>
        <td>Rp. <?= $result->spp1 ?></td>
        <td>Rp. <?= $result->spp2 ?></td>
        <td>Rp. <?= $result->lain ?></td>
        <td>
            <a href="?page=daftar&action=edit&id=<?= $result->kode ?>" class="btn btn-sm btn-primary">
                <span class="fa fa-edit"></span> Edit
            </a>
            </a>
            <a onclick="return confirm('Yakin ingin menghapus data');" href="?page=daftar&action=hapus&id=<?= $result->kode ?>" class="btn btn-sm btn-danger">
                <span class="fa fa-trash"></span> Hapus
            </a>
        </td>
    </tr>
            <?php  endwhile; }  ?>
    </tbody>
</table>
</div>
<?php
        } else {
            include "pages/404.php";
        }
?>