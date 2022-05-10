<?php

session_start();

require_once("../functions.php");

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
if ($_SESSION['role'] != 1) {
    header("Location: ../User/indexUser.php");
    exit;
}


$id_user = $_SESSION['user']['id'];
$id_produk = $_GET["id"];
$user = query("SELECT * FROM users WHERE id = $id_user")[0];
$product = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];


if (isset($_POST["add"])) {
    // var_dump($_POST);
    // die;
    if (ubahProduk($_POST, $id_produk) > 0) {
        echo "
            <script> 
                alert('Data berhasil diubah');
                document.location.href = './dataProduk.php';
            </script>
        ";
    } else {
        echo "
            <script> 
                alert('Data gagal diubah');
                document.location.href = './ubahProduk.php?id=$id_produk';
            </script>
        ";
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
    <?php include 'nav_sidebar.php' ?>

    <!-- Form Ubah Produk  -->

    <section id="ubahproduct">

        <div class="container mt-5">
            <div class="row g-3 justify-content-center">
                <div class="col-md-8">
                    <div class="box-register" id="box-register">
                        <h2>Ubah Produk</h2>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-md-3 mb-3 ">
                                    <img src="../assets/img/produk/<?= $product['gambar_produk']; ?>" class="gambarproduct" id="gambarproduct" width="150" height="150" alt="" style="border-radius: 50%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="gambar_produk" class="form-label">Upload Gambar</label>
                                    <input class="form-control" type="file" name="gambar_produk" id="gambar_produk">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="namaproduk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="namaproduk" id="namaproduk" value="<?= $product["nama_produk"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="hargaproduk" class="form-label">Harga Produk</label>
                                    <input type="text" class="form-control" name="hargaproduk" id="hargaproduk" value="<?= $product["harga_produk"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="detailproduk" class="form-label">Detail Produk</label>
                                    <input type="text" class="form-control" name="detailproduk" id="detailproduk" value="<?= $product["deskripsi_produk"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="volumeproduk" class="form-label">Volume Produk</label>
                                    <input type="text" class="form-control" name="volumeproduk" id="volumeproduk" value="<?= $product["volume_produk"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="beratproduk" class="form-label">Berat Produk</label>
                                    <input type="text" class="form-control" name="beratproduk" id="beratproduk" value="<?= $product["berat_produk"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stockproduk" class="form-label">Stock Produk</label>
                                    <input type="text" class="form-control" name="stockproduk" id="stockproduk" value="<?= $product["stock_produk"]; ?>">
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                    <button type="submit" name="add" class="btn btn-primary">Ubah</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
        </svg>

    </section>
    <!-- Akhir Form Ubah Produk -->

    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>

</body>

</html>