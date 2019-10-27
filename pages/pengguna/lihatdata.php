<?php if(@$_SESSION['admin']){ $query = $conn->query("SELECT * FROM user ORDER BY level ASC");   ?> 
    
<h1>Lihat Data Pengguna</h1>
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
        <button onclick="window.location.href='?page=pengguna'" class="btn btn-success"><i class="fa fa-sync-alt"></i> </button>
        <a href="?page=pengguna&action=tambah" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Data</a>
    </div>

</div>

<div class="row tabelku">
<table class="table table-striped table-sm">
	<thead>
		<tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Level</th>
            <th>Opsi</th>
		</tr>
    </thead>
   
	<tbody>
        <?php 
         if(isset($_POST['cari'])){
            $keyword = addslashes($_POST['kunci']);
            if($keyword != ""){
                $query = $conn->query("SELECT * FROM user WHERE nama LIKE '%$keyword%' OR username LIKE'%$keyword%' OR telepon LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR level LIKE '%$keyword%' ORDER BY level ASC");
            }else {
                $query = $conn->query("SELECT * FROM user ORDER BY level ASC");
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
        ?>
    <tr>
        <td align="center"><?= $no++  ?>.</td>
        <td><?= $result->nama ?></td>
        <td><?= $result->username ?></td>
        <td>0<?= $result->telepon ?></td>
        <td><?= $result->alamat ?></td>
        <td><?= $result->level ?></td>
        <td>
            <a href="?page=pengguna&action=edit&id=<?= $result->kode ?>" class="btn btn-sm btn-primary">
                <span class="fa fa-edit"></span> Edit
            </a>
            <a href="?page=pengguna&action=sandi&id=<?= $result->kode ?>" class="btn btn-sm btn-info">
                <span class="fa fa-unlock-alt"></span> Sandi
            </a>
            <a onclick="return confirm('Yakin ingin menghapus data');" href="?page=pengguna&action=hapus&id=<?= $result->kode ?>" class="btn btn-sm btn-danger">
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