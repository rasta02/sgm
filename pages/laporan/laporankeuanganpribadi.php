<?php
    $exe = $conn->query("SELECT * FROM user WHERE kode = '$userLogin'");
    $result = $exe->fetch(PDO::FETCH_OBJ);

?>
<h1>Laporan Keuangan Pribadi</h1>
<hr>

<div class="row">
    <div class="col-sm-12 text-center mb-3">
        <h3>Cetak Laporan Keuangan Pertanggal</h3>
        <form action="pages/laporan/cetakPertanggal.php" method="post" target="_blank">
            <div class="row">
            <input type="hidden" name="id" class="form-control" value="<?= $result->kode ?>">
                <div class="col-sm-6 mb-2">
                    <input type="date" name="dari" class="form-control" required>
                </div>
                <div class="col-sm-6 mb-2">
                    <input type="date" name="sampai" class="form-control" required>
                </div>
                <div class="col-sm-12 mb-2">
                    <button class="btn btn-lg btn-success"><i class="fas fa-calendar-check"></i> Cetak</button> 
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row text-center">
    <div class="col-sm-12 text-center">
        <h3>Cetak Laporan Keuangan</h3>
        <form action="pages/laporan/cetak.php" method="post" target="_blank">
        <input type="hidden" name="id" class="form-control" value="<?= $result->kode ?>">
            <button type="submit"  class="btn btn-lg btn-primary"><i class="fa fa-print"></i> Cetak</> 
        </form>
    </div>
</div>