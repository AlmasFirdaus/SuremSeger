<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

session_start();
require_once('functions.php');


$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];

$diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id WHERE pembelian.status_terima = 'Sudah diterima'");

$tgl_mulai = '-';
$tgl_selesai = '-';

$data_rekaps = [];
$data_rekaps['keuntungan'] = 0;
unset($data_rekaps['produk']);
unset($data_produk_sementara);
$data_produk_sementara = [];
// $data_produk_sementara[]['jumlah_produk'] = 0;

$tgl_mulai = $_GET['tglm'];
$tgl_selesai = $_GET['tgls'];
$data_rekaps['keuntungan'] = 0;
unset($data_rekaps['produk']);
unset($data_produk_sementara);


$dataProduks = query("SELECT * FROM pembelian_produk 
                            JOIN pembelian ON pembelian_produk.id_pembelian = pembelian.id_pembelian 
                            JOIN users ON pembelian.id_user = users.id 
                            WHERE pembelian.status_terima = 'Sudah diterima' 
                            And tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");

$diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id 
                            WHERE pembelian.status_terima = 'Sudah diterima' 
                            And tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");

foreach ($diterimas as $diterima) {
    $data_rekaps['keuntungan'] += $diterima['total_pembelian'];
}

foreach ($dataProduks as $dataProduk) {
    if (empty($data_produk_sementara[$dataProduk['id_produk']])) {
        $data_produk_sementara[$dataProduk['id_produk']]['nama_produk'] = $dataProduk['nama'];
        $data_produk_sementara[$dataProduk['id_produk']]['jumlah_produk'] = $dataProduk['jumlah'];
    } elseif (!empty($data_produk_sementara[$dataProduk['id_produk']])) {
        $data_produk_sementara[$dataProduk['id_produk']]['nama_produk'] = $dataProduk['nama'];
        $data_produk_sementara[$dataProduk['id_produk']]['jumlah_produk'] += $dataProduk['jumlah'];
    }
}
$data_rekaps['produk'] = $data_produk_sementara;

if ($_GET['tglm'] === '-') {
    $dataProduks = query("SELECT * FROM pembelian_produk 
                                JOIN pembelian ON pembelian_produk.id_pembelian = pembelian.id_pembelian 
                                JOIN users ON pembelian.id_user = users.id 
                                WHERE pembelian.status_terima = 'Sudah diterima'");

    foreach ($diterimas as $diterima) {
        $data_rekaps['keuntungan'] += $diterima['total_pembelian'];
    }

    foreach ($dataProduks as $dataProduk) {
        if (empty($data_produk_sementara[$dataProduk['id_produk']])) {
            $data_produk_sementara[$dataProduk['id_produk']]['nama_produk'] = $dataProduk['nama'];
            $data_produk_sementara[$dataProduk['id_produk']]['jumlah_produk'] = $dataProduk['jumlah'];
        } elseif (!empty($data_produk_sementara[$dataProduk['id_produk']])) {
            $data_produk_sementara[$dataProduk['id_produk']]['nama_produk'] = $dataProduk['nama'];
            $data_produk_sementara[$dataProduk['id_produk']]['jumlah_produk'] += $dataProduk['jumlah'];
        }
    }
    $data_rekaps['produk'] = $data_produk_sementara;
}


$total_produk = 0;
foreach ($data_rekaps['produk'] as $key => $value) {
    $total_produk += $value['jumlah_produk'];
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
if ($tgl_mulai == '-') {

    $html .= '<h3 class="sub-judul">Laporan Transaksi Penjualan Produk Keseluruhan</h3>';
} else {
    $html .= '<h3>Laporan Transaksi Penjualan Produk Periode ' . $tgl_mulai . ' hingga ' . $tgl_selesai . '</h3>';
}
$html .= '
     <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                    </tr>
                </thead>
                <tbody>';
$i = 1;
if (isset($data_rekaps["produk"])) {
    foreach ($data_rekaps["produk"] as $key => $value) {
        $html .= '<tr>
                                <td>' . $i . '</td>
                                <td>' . $value["nama_produk"] . '</td>
                                <td>' . $value["jumlah_produk"] . '</td>
                            </tr>';

        $i++;
    }
} else {
    $html .= '<tr>
                <td colspan="3" class="text-center">
                    Tidak ada data penjualan
                </td>
            </tr>';
}

$html .= '                         <tr>
<td colspan="2"> <strong>Total Produk</strong> </td>
<td><strong>' . $total_produk . '</strong></td>
</tr>
</tbody>
            </table>

        </div>
    </section>
    <!-- Akhir Tabel Customer -->

</body>

</html>';

$mpdf->WriteHTML($html);
// $mpdf->Output('Laporan-Penjualan-Produk.pdf', \Mpdf\Output\Destination::INLINE);
$mpdf->Output('Laporan-Penjualan-Produk - Periode ' . $tgl_mulai . ' hingga ' . $tgl_selesai . '.pdf', \Mpdf\Output\Destination::INLINE);
