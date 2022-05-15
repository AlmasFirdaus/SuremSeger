<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
};

require_once '../functions.php';

$id_pembelian = $_GET['id'];
$detail_pembelian = query("SELECT * FROM pembelian WHERE id_pembelian = $id_pembelian")[0];

$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detail_pembelian['id_user'];
// mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION['user']['id'];

if ($id_pelanggan_beli !== $id_pelanggan_login) {
    echo "<script>location='riwayat.php;</script>";
    exit();
}

if (isset($_POST["kirim"])) {
    // var_dump($_POST);
    // die;
    if (bukti($_POST, $id_pembelian) > 0) {
        echo "
            <script> 
                alert('Konfirmasi pembayaran berhasil!');
                document.location.href = './riwayat.php';
            </script>
        ";
    } else {
        echo "
            <script> 
                alert('Konfirmasi pembayaran gagal!');
                document.location.href = './pembayaran?id=$id_pembelian';
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

    <?php include 'nav_sidebar.php'; ?>


    <section id="pembayaran">
        <div class="container">
            <!-- <pre><?php print_r($detail_pembelian); ?></pre> -->
            <h2>Konfirmasi Pembayaran</h2>
            <p>Kirim bukti pembayaran disini</p>
            <div class="alert alert-info">Total tagihan anda <strong>Rp. <?= number_format($detail_pembelian['total_pembelian']); ?></strong></div>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="nama">Nama penyetor</label>
                    <input type="text" class="form-control" name="nama" id="nama">
                </div>
                <div class="form-group">
                    <label for="bank">Bank</label>
                    <input type="text" class="form-control" name="bank" id="bank">
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control" name="jumlah" id="jumlah" value="Rp. <?= number_format($detail_pembelian['total_pembelian']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="gambar">Foto bukti</label>
                    <input type="file" class="form-control" name="gambar" id="gambar">
                </div>
                <div class="form-group-btn mt-3">
                    <a href="riwayat.php" class="btn btn-outline-secondary">Kembali</a>
                    <button class="btn btn-primary" name="kirim">Kirim</button>
                </div>

            </form>
        </div>
    </section>

    <?php

    // jika ada tombol kirim

    // if (isset($_POST['kirim'])) {
    //     $namabukti = $_FILES['bukti']['name'];
    //     $lokasibukti = $_FILES['bukti']['tmp_name'];
    //     $namafix = date("YmdHis") . $namabukti;
    //     move_uploaded_file($lokasibukti, '../assets/img/bukti_pembayaran' . $namafix);

    //     $nama = $_POST['nama'];
    //     $bank = $_POST['bank'];
    //     $jumlah = $_POST['jumlah'];
    //     $tanggal = date("Y-m-d");

    //     // simpan pembayaran
    //     $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
    //                         VALUES ('$id_pembelian', '$nama', '$bank', '$jumlah', '$tanggal', '$namafix')");

    //     // update status pembelian dari pending menjadi sudah kirim
    //     $koneksi->query("UPDATE pembelian set status_pembelian = 'Sudah kirim Pembayaran'
    //                         WHERE id_pembelian = $id_pembelian");

    //     echo "<script>alert('terimakasih sudah mengirimkan bukti pembayaran')</script>";
    //     echo "<script>location='riwayat.php';</script>";
    // }

    // 
    ?>
</body>

</html>