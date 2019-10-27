<?php 
	// Include libary mpdf
require_once __DIR__ . '/../../vendor/autoload.php';

// memangil koneksi dan data dari database
include '../../__+config/koneksi.php';

// Cetak User yang sedang Login
$kode = addslashes($_POST['id']);
$query = $conn->query("SELECT * FROM user WHERE kode = '$kode'");
$result = $query->fetch(PDO::FETCH_OBJ);

// Pemasukan User
try{
$query2 = $conn->query("SELECT  SUM(jumlah) AS pemasukan FROM keuangan WHERE status = 'Pemasukan' AND kodeUser = '$kode' "); 
$data = $query2->fetch(PDO::FETCH_OBJ);
$jumlah =  $data->pemasukan;
$resultJumlahPemasukan = number_format($jumlah,2,',','.');
}catch(Exception $e){
    echo $e->getMessage();
}

// Pengeluaran User
$query3 = $conn->query("SELECT  SUM(jumlah) AS pengeluaran FROM keuangan WHERE status = 'Pengeluaran' AND kodeUser = '$kode' ");
$data2 = $query3->fetch(PDO::FETCH_OBJ);
$jumlah2 =  $data2->pengeluaran;
$resultJumlahPengeluaran = number_format($jumlah2,2,',','.');

// Sisa Saldo / Uang User 
$query4 = $conn->query("SELECT ROUND ( SUM(IF(status = 'Pemasukan', jumlah, 0))-(SUM(IF( status = 'Pengeluaran', jumlah, 0))) ) AS subtotal FROM keuangan WHERE kodeUser = '$kode' ");
$data3 = $query4->fetch(PDO::FETCH_OBJ);
$jumlah3 =  $data3->subtotal;
echo $resultJumlah = number_format($jumlah3,2,',','.');


$mpdf = new \Mpdf\Mpdf();
// untuk judul laporan 
$mpdf->SetTitle('Laporan Keuangan');
	
	$html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laporan Keuangan</title>
        <style>
            .header {
                text-align:center;
                border-bottom: 1px solid slver;
            }
            .judul {
                font-size: 40px;
            }
            .judul2 {
                font-size: 36px;
            }
            .body,.footer {
                font-size: 18px;
                font-family: arial;
            }
            table {
                font-size: 16px;
                font-family: arial;
                margin : 5px;
            }
        </style>
    </head>
    <body>
        <p class="header">
            <span class="judul">~ SiteZy ~</span><br /> 
            <span class="judul2">Laporan Keuangan</span>
        </p>
        <p class="body">
            &nbsp;&nbsp;&nbsp; Laporan Keuangan Anda, Dari awal menggunakan aplikasi ini (<b>SiteZy</b>) hingga saat ini,Detail Nama Pengguna Dari Laporan Yang Akan Di Cetak : 
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><b>'.$result->nama.'</b></td>
                </tr>
                
                <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>0'.$result->telepon.'</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>'.$result->alamat.'</td>
                </tr>
            </table>
        </p>
        <p class="body">
            &nbsp;&nbsp;&nbsp; Laporan Keuangan :
            <table>
                <tr>
                    <td>Jumlah Pemasukan </td>
                    <td>:</td>
                    <td><b>'.$resultJumlahPemasukan.'</b></td>
                </tr>
                <tr>
                    <td>Jumlah Pengeluaran </td>
                    <td>:</td>
                    <td><b>'.$resultJumlahPengeluaran.'</b></td>
                </tr>
                <tr>
                    <td>Saldo / Uang Saat Ini </td>
                    <td>:</td>
                    <td><b>'.$resultJumlah.'</b></td>
                </tr>
            </table>
        </p>
        <br />
    <div class="footer">
        &nbsp;&nbsp;&nbsp; Terima Kasih sudah mempercayakan pengelolahan keuangan pribadi anda  di situs kami. Laporan Keuangan di atas akan akurat dengan data yang anda masukan di dalam situs kami.
    </div>
    </body>
    </html>';

$mpdf->WriteHTML($html);
// nama ketik di print atau di download
$mpdf->Output('DataJabatan.pdf',\Mpdf\Output\Destination::INLINE);
 ?>
