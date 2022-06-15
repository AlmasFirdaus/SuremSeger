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

    <title>Profile | SuremSeger.ID</title>
</head>

<body>

    <?php include 'nav_sidebar.php' ?>

    <section id="detail">


        <div class="container">
            <h2 class="mb-5">Detail Pembelian</h2>

            <?php

            $ambil = query("SELECT * FROM pembelian JOIN users 
                                ON pembelian.id_user = users.id 
                                WHERE pembelian.id_pembelian = {$_GET['id']}")[0];

            // $detail = $ambil->fetch_assoc();
            ?>

            <!-- <pre><?php print_r($ambil); ?></pre> -->




            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <p>
                        <?= $ambil['tanggal_pembelian']; ?> <br>
                        Rp. <?= number_format($ambil['total_pembelian']); ?> <br>
                        Status : <?= $ambil['status_terima']; ?> <br>
                        <!-- Opsi Pengiriman : <?= $ambil['opsi_pengiriman']; ?> -->
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                    <strong><?= $ambil['namalengkap']; ?></strong> <br>
                    <p>
                        <?= $ambil['nohp']; ?> <br>
                        <?= $ambil['email']; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <strong><?= $ambil['kota']; ?></strong>
                    <p>
                        Alamat : <?= $ambil['alamat_pengiriman']; ?>
                    </p>
                </div>
            </div>

            <table class="table table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php $ambil = query("SELECT * FROM pembelian_produk
                                                WHERE id_pembelian = {$_GET['id']}"); ?>
                    <?php foreach ($ambil as $pecah) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $pecah['nama']; ?></td>
                            <td>Rp. <?= number_format($pecah['harga']); ?></td>
                            <td><?= $pecah['jumlah']; ?></td>
                            <td>
                                Rp. <?= number_format($pecah['subharga']); ?>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="dataPesanan.php" class="btn btn-primary">Kembali</a>
        </div>
    </section>

</body>

</html>