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
// require_once('../database.php');

$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];
$product = query("SELECT * FROM produk WHERE stock_produk > 0");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css" />
    <!-- Bootstrap end -->

    <title>SuremSeger.ID</title>
</head>

<body id="body-indexAdmin">



    <!-- Navbar Sidebar Admin -->
    <?php include 'nav_sidebar.php' ?>



    <!-- Product -->

    <section id="product">
        <div class="container">
            <div class="row">
                <div class="col text-center mb-3">
                    <h2>Ready Stock Product</h2>
                </div>
            </div>

            <div class="table">

                <table class="table table-striped table-hover align-middle">

                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Volume</th>
                        <th>Stock</th>
                    </tr>

                    <?php $i = 1; ?>
                    <?php foreach ($product as $prod) : ?>

                        <tr>
                            <td><?= $i; ?></td>
                            <td><img src="../assets/img/produk/<?= $prod["gambar_produk"] ?>" alt="" width="70"></td>
                            <td><?= $prod['nama_produk'] ?></td>
                            <td><?= $prod['harga_produk'] ?></td>
                            <td><?= $prod['volume_produk'] ?></td>
                            <td><?= $prod['stock_produk'] ?></td>
                        </tr>

                        <?php $i++; ?>
                    <?php endforeach; ?>

                </table>

            </div>


        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
        </svg>
    </section>

    <!-- Akhir Product -->



    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>
</body>

</html>