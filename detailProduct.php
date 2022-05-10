<?php

// cek apakah tidak ada data pada $_GET
require_once('./functions.php');

if (!isset($_GET['id'])) {
    // redirect
    header("Location: index.php");
    exit;
}

if (isset($_POST["submit"])) {
    echo "<br><br><br><br><br><br>";
    var_dump($_POST);
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }
}


$id = $_GET['id'];

$produk = query("SELECT * FROM produk WHERE id_produk = $id")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

    <title>Detail Product | SuremSeger.ID</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light shadow-sm fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/img/sapi icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top" />
                Surem Seger
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                    <li class="nav-login">
                        <a href="login.php">
                            <button type="button" class="btn btn-success" id="btn-login">Masuk</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <section id="detail-product">
        <div class="container">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="./assets/img/produk/<?= $produk['gambar_produk'] ?>" class="img-fluid rounded-start" alt="<?= $produk['nama_produk'] ?>">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <form action="" method="post">
                                <h1 class="card-title"><?= $produk["nama_produk"] ?></h1>
                                <p class="card-text fs-4"><?= $produk['deskripsi_produk'] ?></p>
                                <p class="card-text fs-4">Rp. <?= $produk['harga_produk'] ?> | Volume (ml) : <?= $produk['volume_produk'] ?></p>
                                <div class="row d-flex justify-content-start align-items-center">
                                    <div class="col-2">
                                        <label for="nama" class="form-label">Tambah Pesan :</label>
                                    </div>
                                    <div class="col-1">
                                        <input type="number" class="form-control" id="nama">
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
                                    <!-- Button trigger modal -->
                                    <button type="submit" class="btn btn-secondary" name="submit" id="submit">
                                        Beli Sekarang
                                    </button>
                                </div>
                            </form>

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