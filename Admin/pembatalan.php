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

$id_pembelian = $_GET['id'];

// mengambil data berdasarkan id_pembelian

$detail = query("SELECT * FROM pembelian JOIN users ON pembelian.id_user = users.id 
                    JOIN pembelian_produk ON pembelian.id_pembelian = pembelian_produk.id_pembelian 
                    WHERE pembelian.id_pembelian ='$id_pembelian'")[0];


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

    <?php include 'nav_sidebar.php'; ?>

    <section id="pembayaran">
        <div class="container">


            <h2>Data Pembatalan</h2>


            <!-- <pre><?= print_r($detail); ?></pre> -->

            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td><?= $detail['namalengkap']; ?></td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td><?= $detail['nohp']; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= $detail['alamat_pengiriman']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <td><?= $detail['tanggal_pembelian']; ?></td>
                        </tr>
                        <tr>
                            <th>Opsi Pengiriman</th>
                            <td><?= $detail['opsi_pengiriman']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Nama Produk</th>
                            <td><?= $detail['nama']; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Pembelian</th>
                            <td><?= $detail['jumlah']; ?></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td><?= $detail['harga']; ?></td>
                        </tr>
                        <tr>
                            <th>Sub Harga</th>
                            <td><?= $detail['subharga']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Pilih Status</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                                <option value="Menunggu pembayaran">Gagal dibatalkan</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="btn-form-group my-3">
                    <a href="dataPembeli.php" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="proses">Proses</button>
                </div>
            </form>
        </div>
    </section>

    <?php

    if (isset($_POST['proses'])) {
        $status = $_POST['status'];
        $conn->query("UPDATE pembelian SET status_pembelian ='$status' 
                        WHERE id_pembelian = '$id_pembelian'");

        echo "<script>alert('Data pembelian ter-update');</script>";
        echo "<script>location='dataPembatalan.php?id=$id_pembelian'</script>";
    }


    ?>
</body>

</html>