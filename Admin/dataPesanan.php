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

$id = $_SESSION['user']['id'];

$user = query("SELECT * FROM users WHERE id = $id")[0];
// $data = query("SELECT * FROM users WHERE role = 2");

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
    <?php include 'nav_sidebar.php' ?>

    <!-- Tabel Data Customer -->
    <section id="dataCustomer">
        <div class="container" style="min-height: 310px;">

            <!-- <table class="table table-striped table-hover"> -->
            <h2>Data Pesanan</h2>

            <table class="table table-striped table-hover align-middle mt-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Status Terima</th>
                        <th>Opsi Pengiriman</th>
                        <th>Opsi Pembayaran</th>
                        <th>Total</th>
                        <th>Aksi</th>
                        <th>Barang Diterima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $ambil = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id WHERE pembelian.status_terima = 'Belum diterima' ORDER BY pembelian.id_pembelian ASC"); ?>
                    <?php foreach ($ambil as $data) : ?>
                        <!-- <?php $ambil = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id")[$i - 1]; ?> -->
                        <!-- <pre><?php print_r($data); ?></pre> -->
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['namalengkap']; ?></td>
                            <td><?= $data['tanggal_pembelian']; ?></td>
                            <td><?= $data['status_pembelian']; ?></td>
                            <td><?= $data['status_terima']; ?></td>
                            <td><?= $data['opsi_pengiriman']; ?></td>
                            <td><?= $data['opsi_pembayaran']; ?></td>
                            <td><?= $data['total_pembelian']; ?></td>
                            <td>
                                <a href="detailPesanan.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-info btn-sm">Detail</a>
                                <?php
                                if ($data['status_pembelian'] == "Sudah kirim Pembayaran") : ?>
                                    <a href="pembayaran.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-success btn-sm">Pembayaran</a>
                                <?php elseif ($data['opsi_pembayaran'] == "COD") : ?>
                                    <a href="ambilSendiri.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-success btn-sm">Ambil</a>
                                <?php elseif ($data['status_pembelian'] == "Proses pembatalan") : ?>
                                    <a href="pembatalan.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-danger btn-sm">Pembatalan</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($data['status_terima'] == 'Belum diterima') : ?>
                                    <a href="status_terima.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-primary" onclick="return confirm('yakin barang telah diterima?');">Pesanan Diterima</a>
                                <?php endif; ?>
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