<?php

session_start();

include '../functions.php';
// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {

    echo "<script>alert('Keranjang kosong, harap belanja terlebih dahulu!')</script>";
    echo "<script>location='indexUser.php#product'</script>";
}

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
    <title>Keranjang</title>
</head>

<body>

    <!-- Navbar - Sidebar -->
    <?php include 'nav_sidebar.php' ?>

    <!-- Content -->
    <section class="content">
        <div class="container" style="background-color: white; padding: 30px">
            <h1>Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1; ?>
                    <!-- <pre><?= print_r($_SESSION["keranjang"]); ?></pre> -->
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                        <!-- Menampilkan Produk yang sedang diperulangkan berdasarkan id_produk -->
                        <?php

                        $ambil = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
                        // $pecah = $ambil->fetch_assoc();

                        ?>
                        <!-- <pre><?= print_r($ambil); ?></pre> -->
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $ambil['nama_produk']; ?></td>
                            <td>Rp. <?= number_format($ambil['harga_produk']); ?></td>
                            <td><?= $jumlah; ?></td>
                            <td>Rp. <?= number_format($ambil['harga_produk'] * $jumlah); ?></td>
                            <td>
                                <a href="detailProductUser.php?id=<?= $id_produk; ?>" class="btn btn-success btn-xs">Ubah</a>
                                <a href="hapuskeranjang.php?id=<?= $id_produk; ?>" class="btn btn-danger btn-xs">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="indexUser.php#product" class="btn btn-default">Lanjutkan Belanja</a>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
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