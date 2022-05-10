<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

require_once('../functions.php');

$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];

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
</head>

<body>

    <?php include 'nav_sidebar.php'; ?>

    <!-- <pre><?php print_r($_SESSION['pelanggan']); ?></pre> -->
    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja <?= $_SESSION['user']['namalengkap']; ?></h3>

            <table class="table table-striped table=hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $i = 1;

                    // mendapatkan id_pelanggan yang login dari session
                    $id_pelanggan = $_SESSION['user']['id'];

                    $ambil = query("SELECT * FROM pembelian WHERE id_user = '$id_pelanggan' ORDER BY id_pembelian DESC");
                    foreach ($ambil as $pecah) :
                    ?>
                        <!-- <pre><?php print_r($pecah); ?></pre> -->
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $pecah['tanggal_pembelian']; ?></td>
                            <td>
                                <?= $pecah['status_pembelian']; ?> <br>
                                <?php if (!empty($pecah['resi_pengiriman'])) : ?>
                                    No Resi : <?= $pecah['resi_pengiriman']; ?>
                                <?php endif; ?>
                            </td>
                            <td>Rp. <?= number_format($pecah['total_pembelian']); ?></td>
                            <td class="d-flex">
                                <a href="nota.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-info">Nota</a>
                                <?php if ($pecah['status_pembelian'] !== "Proses pembatalan") : ?>
                                    <?php if ($pecah['status_pembelian'] == "Menunggu pembayaran") : ?>
                                        <a href="pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-success ms-3">Konfirmasi Pembayaran</a>
                                        <a href="batal.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-danger ms-3" onclick="return confirm('yakin untuk pembatalan?');">Batal</a>

                                    <?php endif; ?>
                                <?php endif; ?>
                                <!-- <?= $pecah['id_pembelian']; ?> -->
                            </td>
                        </tr>


                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>



</body>

</html>