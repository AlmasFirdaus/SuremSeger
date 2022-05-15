<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] != 1) {
    header("Location: ../User/indexUser.php");
    exit;
}

require_once('../functions.php');

$semuaData = array();
$dataKeuntungan[] = array();
$dataKeuntungan['keuntungan'] = 0;
$tgl_mulai = '-';
$tgl_selesai = '-';

$id = $_SESSION['user']['id'];

$user = query("SELECT * FROM users WHERE id = $id")[0];
// $data = query("SELECT * FROM users WHERE role = 2");

if (isset($_GET['id'])) {
    $id_pembelian = $_GET['id'];
    $conn->query("UPDATE pembelian SET status_terima = 'Sudah diterima' WHERE id_pembelian = '$id_pembelian'");
}


$diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id WHERE pembelian.status_terima = 'Sudah diterima'");

foreach ($diterimas as $diterima) {
    $dataKeuntungan['keuntungan'] += $diterima['total_pembelian'];
}

if (isset($_POST['kirim'])) {
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
    $dataKeuntungan['keuntungan'] = 0;

    $diterimas = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id 
                        WHERE pembelian.status_terima = 'Sudah diterima' 
                        And tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");

    foreach ($diterimas as $diterima) {
        $dataKeuntungan['keuntungan'] += $diterima['total_pembelian'];
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

    <header class="mt-5 justify-content-center text-center">
        <h2>SUSU REMBANGAN</h2>
        <h5>Jl. Rembangan No.13, Darungan, Kemuning Lor, Arjasa, Jember jawa timur</h5>
        <hr>
    </header>


    <!-- Tabel Data Customer -->
    <section id="dataCustomer">
        <div class="container" style="min-height: 310px;">

            <!-- <table class="table table-striped table-hover"> -->
            <h3>Laporan Transaksi Pembelian periode <?= $tgl_mulai; ?> hingga <?= $tgl_selesai; ?></h3>
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
                        <label for="total_penjualan"><strong>Total Penjualan</strong></label>
                        <input type="text" class="form-control mb-2" name="total_penjualan" id="total_penjualan" value="Rp. <?= number_format($dataKeuntungan['keuntungan']); ?> " readonly>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="total_pengeluaran"><strong>Total Pengeluaran</strong></label>
                        <input type="text" class="form-control mb-2" name="total_pengeluaran" id="total_pengeluaran" value="Rp. <?= number_format($dataKeuntungan['keuntungan'] * 60 / 100); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="keuntungan"><strong>Keuntungan</strong></label>
                        <input type="text" class="form-control mb-2" name="keuntungan" id="keuntungan" value="Rp. <?= number_format($dataKeuntungan['keuntungan'] * 40 / 100); ?> " readonly>
                    </div>
                </div>
            </div>

            <hr>

            <table class="table table-striped table-hover align-middle mt-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status Terima</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($diterimas as $data) : ?>
                        <!-- <?php $ambil = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id")[$i - 1]; ?> -->
                        <!-- <pre><?php print_r($data); ?></pre> -->
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['namalengkap']; ?></td>
                            <td><?= date("d-m-Y", strtotime($data['tanggal_pembelian'])); ?></td>
                            <td><?= $data['status_terima']; ?></td>
                            <td><?= $data['total_pembelian']; ?></td>
                            <td>
                                <a href="detailLaporan.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
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