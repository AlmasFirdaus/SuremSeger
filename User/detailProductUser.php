<?php
require_once('../functions.php');

session_start();

$user_id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $user_id")[0];

$id_produk = $_GET['id'];

$produk = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];


if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// if ($_SESSION['role'] != 2) {
//     header("Location: ../Admin/indexAdmin.php");
//     exit;
// }
// cek apakah tidak ada data pada $_GET

if (!isset($_GET['id'])) {
    // redirect
    header("Location: indexAdmin.php");
    exit;
}

// var_dump($produks);

// jika tombol beli ditekan
if (isset($_POST['beli'])) {

    // mendapatkan jumlah yang di inputkan
    $jumlah = $_POST['jumlah'];

    // memasukkan ke dalam keranjang
    $_SESSION['keranjang'][$id_produk] = $jumlah;

    echo "<script>alert('Produk telah masuk kedalam keranjang belanja');</script>";
    echo "<script>location='keranjang.php';</script>";
};





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

    <title>Detail Product | SuremSeger.ID</title>
</head>

<body>

    <!-- Navbar - Sidebar -->
    <?php include 'nav_sidebar.php' ?>

    <section id="detail-product">
        <div class="container" style="background-color: white; padding: 30px">
            <!-- <pre><?= print_r($produk); ?></pre> -->
            <h1>Produk</h1>
            <!-- <pre><?= print_r($user); ?></pre> -->
            <hr>
            <div class="box">
                <div class="row">
                    <div class="col-md-3">
                        <img src="../assets/img/produk/<?= $produk['gambar_produk'] ?>" class="img-responsive" alt="<?= $produk['nama_produk'] ?>">
                    </div>
                    <div class="col-md-6">
                        <h2 class=""><?= $produk['nama_produk']; ?></h2><br>
                        <h5>Rp. <?= number_format($produk['harga_produk']); ?></h5>
                        <h5>Stock : <?= $produk['stock_produk']; ?></h5>
                        <h5>Volume: <?= $produk['volume_produk']; ?> Ml</h5>
                        <p><?= $produk['deskripsi_produk']; ?> dengan rasa <?= $produk['nama_produk']; ?></p>
                        <div class="col-md-3">
                            <form action="" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" min="1" max="<?= $produk['stock_produk']; ?>" value="1" class="form-control" name="jumlah" id="jumlah">
                                        <div class="input-group-btn">
                                            <?php if ($user['role'] != 1) : ?>
                                                <button class="btn btn-primary" name="beli">Beli</button>
                                            <?php else : ?>
                                                <button class="btn btn-primary">Beli</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-5">
                            <a href="./indexUser.php#product" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
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