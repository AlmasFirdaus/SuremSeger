<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

session_start();
require_once('functions.php');

$dataKeuntungan[] = array();
$dataKeuntungan['keuntungan'] = 0;

$id = $_SESSION['user']['id'];

$user = query("SELECT * FROM users WHERE id = $id")[0];

// if (isset($_GET['id'])) {
//     $id_pembelian = $_GET['id'];
//     $conn->query("UPDATE pembelian SET status_terima = 'Sudah diterima' WHERE id_pembelian = '$id_pembelian'");
// }




$tgl_mulai = $_GET['tglm'];
$tgl_selesai = $_GET['tgls'];
$dataKeuntungan['keuntungan'] = 0;

$diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id 
                        WHERE pembelian.status_terima = 'Sudah diterima' 
                        And tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");

foreach ($diterimas as $diterima) {
    $dataKeuntungan['keuntungan'] += $diterima['total_pembelian'];
}

if ($_GET['tglm'] === '-') {
    $diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id WHERE pembelian.status_terima = 'Sudah diterima'");

    foreach ($diterimas as $diterima) {
        $dataKeuntungan['keuntungan'] += $diterima['total_pembelian'];
    }
}

$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="stylePDF.css" />

    <title>SuremSeger.ID</title>
</head>

<body>

    <!-- Tabel Data Customer -->
    <section id="dataCustomer">
        <div class="container" style="min-height: 310px;">

        <div class="header">
            <h1 class="judul">SUSU REMBANGAN</h1>
            <p>Jl. Rembangan No.13, Darungan, Kemuning Lor, Arjasa, Jember jawa timur</p>
        </div>

        <hr>

            <!-- <table class="table table-striped table-hover"> -->';

if ($_GET['tglm'] === '-') {

    $html .= '<h3 class="sub-judul">Laporan Transaksi Pembelian Keseluruhan</h3>';
} else {
    $html .= '<h3>Laporan Transaksi Pembelian periode ' . $tgl_mulai . ' hingga ' . $tgl_selesai . '</h3>';
}

$html .= '
            <table border="1" cellpadding="10" cellspacing="0">
            
                <thead>
                    <tr>
                        <th>Total Penjualan</th>
                        <th>Total Pengeluaran</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Rp. ' . number_format($dataKeuntungan["keuntungan"]) . '</td>
                        <td>Rp. ' . number_format($dataKeuntungan["keuntungan"] * 60 / 100) . '</td>
                        <td>Rp. ' . number_format($dataKeuntungan["keuntungan"] * 40 / 100) . '</td>
                    </tr>
                </tbody>

            </table>
            
            <br><br>';


if ($_GET['tglm'] === '-') {

    $html .= '<h3 class="sub-judul"> Detail Laporan Transaksi Pembelian Keseluruhan</h3>';
} else {
    $html .= '<h3>Detail Laporan Transaksi Pembelian periode ' . $tgl_mulai . ' hingga ' . $tgl_selesai . '</h3>';
}

$html .= '<table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status Terima</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>';
$i = 1;
foreach ($diterimas as $data) {
    $html .= '
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $data["namalengkap"] . '</td>
                            <td>' . date("d-m-Y", strtotime($data["tanggal_pembelian"])) . '</td>
                            <td>' . $data["status_terima"] . '</td>
                            <td>' . $data["total_pembelian"] . '</td>
                        </tr>
             ';
    $i++;
}
$html .= '</tbody>
            </table>

        </div>
    </section>
    <!-- Akhir Tabel Customer -->

</body>

</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Laporan-Transaksi-Pembelian.pdf', \Mpdf\Output\Destination::INLINE);
