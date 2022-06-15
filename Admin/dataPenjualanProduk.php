<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] != 1) {
    header("Location: ../User/indexUser.php");
    exit;
}

require_once('../functions.php');


$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];

if (isset($_GET['id'])) {
    $id_pembelian = $_GET['id'];
    $conn->query("UPDATE pembelian SET status_terima = 'Sudah diterima' WHERE id_pembelian = '$id_pembelian'");
}

$diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id WHERE pembelian.status_terima = 'Sudah diterima'");

$tgl_mulai = '-';
$tgl_selesai = '-';

$data_rekaps = [];
$data_rekaps['keuntungan'] = 0;
unset($data_rekaps['produk']);
unset($data_produk_sementara);
$data_produk_sementara = [];
// $data_produk_sementara[]['jumlah_produk'] = 0;

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




if (isset($_POST['kirim'])) {
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
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
}

$total_produk = 0;
if (isset($data_rekaps['produk'])) {
    foreach ($data_rekaps['produk'] as $key => $value) {
        $total_produk += $value['jumlah_produk'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../style.css" />

    <title>SuremSeger.ID</title>
</head>

<body>

    <!-- Navbar Sidebar Admin -->
    <?php include "nav_sidebar.php" ?>
    <!-- <br><br><br><br><br><br><br><br> -->

    <!-- Tabel Data Customer -->
    <section id="dataCustomer">
        <div class="container" style="min-height: 310px;">

            <!-- <table class="table table-striped table-hover"> -->
            <h2>Laporan Penjualan Produk periode <?= $tgl_mulai; ?> hingga <?= $tgl_selesai; ?></h2>
            <hr>

            <form action="" method="post">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="tglm">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tglm" id="tglm" value="<?= $tgl_mulai; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="tgls">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tgls" id="tgls" value="<?= $tgl_selesai; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button class="btn btn-primary" name="kirim">Lihat</button>
                    </div>
                </div>
            </form>

            <hr>
            <div class="row ">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="total_produk"><strong>Total Penjualan Produk</strong></label>
                        <input type="text" class="form-control mb-2" name="total_produk" id="total_produk" value="<?= $total_produk; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-5">
                    <br>
                    <a href="../download_laporanProduk.php?tglm=<?= $tgl_mulai; ?>&tgls=<?= $tgl_selesai; ?>" class="btn btn-primary">Cetak Laporan</a>
                </div>
            </div>

            <!-- <hr>
            <pre><?= print_r($data_produk_sementara); ?></pre>
            <hr> -->

            <table class="table table-striped table-hover align-middle mt-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if (isset($data_rekaps["produk"])) : ?>
                        <?php foreach ($data_rekaps["produk"] as $key => $value) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value["nama_produk"]; ?></td>
                                <td><?= $value["jumlah_produk"]; ?></td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                Tidak ada data penjualan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
        </svg>
    </section>
    <!-- Akhir Tabel Customer -->

    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>

</body>

</html>