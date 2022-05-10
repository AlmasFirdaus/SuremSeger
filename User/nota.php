<?php

session_start();
require_once('../functions.php');

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// if ($_SESSION['role'] != 2) {
//     header("Location: ../Admin/indexAdmin.php");
//     exit;
// }

// if (!isset($_SESSION['keranjang'])) {
//     echo "<script>alert('Harap isi keranjang belanja terlebih dahulu');</script>";
//     echo "<script>location='./indexUser#product';</script>";
// }
// echo "<br><br><br>";
// echo "<pre>";
// print_r($_SESSION['user']);
// echo "</pre>";

$id_user = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id_user")[0];





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

    <title>Document</title>
</head>

<body>

    <!-- Navbar - Sidebar -->
    <?php include 'nav_sidebar.php' ?>

    <section class="content" id="content">
        <div class="container" style="background-color: white; padding: 30px">

            <!-- copy file detail admin -->
            <h2>Detail Pembelian</h2>

            <?php

            $detail = query("SELECT * FROM pembelian JOIN users 
                            ON pembelian.id_user = users.id 
                            WHERE pembelian.id_pembelian = {$_GET['id']}")[0];

            ?>

            <!-- <pre><?php print_r($detail); ?></pre> -->

            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <strong>No. Pembelian: <?= $detail['id_pembelian']; ?></strong><br>
                    Tanggal: <?= $detail['tanggal_pembelian']; ?><br>
                    Total: Rp. <?= number_format($detail['total_pembelian']); ?><br>
                    Opsi Pengiriman: <?= $detail['opsi_pengiriman']; ?> <br>
                    Opsi pembayaran: <?= $detail['opsi_pembayaran']; ?>
                </div>
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                    <strong><?= $detail['namalengkap']; ?></strong><br>
                    <?= $detail['nohp']; ?> <br>
                    <?= $detail['email']; ?>
                </div>
                <?php if ($detail['opsi_pengiriman'] == 'Diantar') : ?>
                    <div class="col-md-4">
                        <h3>Pengiriman</h3>
                        <!-- <pre><?php print_r($detail); ?></pre> -->
                        <p><?= $detail['alamat_pengiriman']; ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Subberat</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>

                    <?php $ambil = query("SELECT * FROM pembelian_produk JOIN pembelian ON pembelian_produk.id_pembelian = pembelian.id_pembelian WHERE pembelian_produk.id_pembelian = {$_GET['id']}"); ?>
                    <!-- <pre><?= print_r($ambil); ?></pre> -->
                    <?php foreach ($ambil as $key) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $key['nama']; ?></td>
                            <td>Rp. <?= number_format($key['harga']); ?></td>
                            <td><?= $key['berat']; ?> Gr</td>
                            <td><?= $key['jumlah']; ?></td>
                            <td><?= $key['subberat']; ?> Gr</td>
                            <td>Rp. <?= number_format($key['subharga']); ?></td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php  ?>
            <?php if ($ambil[0]['status_pembelian'] == 'Menunggu pembayaran' || $ambil[0]['status_pembelian'] == 'Dibatalkan') : ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php if ($ambil[0]['status_pembelian'] == 'Menunggu pembayaran') : ?>
                            <div class="alert alert-info">
                            <?php elseif ($ambil[0]['status_pembelian'] == 'Dibatalkan') : ?>
                                <div class="alert alert-danger">
                                <?php endif ?>
                                <p>
                                    Silahkan melakukan pembayaran senilai Rp. <?= number_format($detail['total_pembelian']); ?> <br>
                                    ke ATM XXX 20*** A.N SuremSeger.ID
                                </p>
                                </div>
                            </div>
                    </div>
                <?php endif; ?>

                <a href="riwayat.php" class="btn btn-secondary">Kembali</a>

                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
                </svg>
    </section>

    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>

</body>

</html>