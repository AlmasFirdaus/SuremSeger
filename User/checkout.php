<?php

session_start();
require_once '../functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {

    echo "<script>alert('Harap isi keranjang belanja terlebih dahulu!')</script>";
    echo "<script>location='indexuser.php#product'</script>";
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
    <title>Checkout</title>
</head>

<body>


    <!-- Navbar - Sidebar -->
    <?php include 'nav_sidebar.php' ?>

    <!-- Content -->
    <section class="content">
        <div class="container" style="background-color: white; padding: 30px">
            <h1>Checkout</h1>
            <hr>
            <h4>Alamat Pengiriman</h4>
            <!-- <pre><?= print_r($user); ?></pre> -->
            <?php

            $alamat_pengiriman =  $user['alamat'] . ' Kec. ' . $user['kecamatan'] . ' Kab. ' . $user['kota'] .  ' ' . $user['provinsi'] . ' kode Pos ' . $user['kodepos'];

            ?>
            <!-- <div class="col-md-3">
                <p> <?= $alamat_pengiriman; ?></p>
            </div> -->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                        <!-- Menampilkan Produk yang sedang diperulangkan berdasarkan id_produk -->
                        <?php

                        $ambil = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
                        $subharga = $ambil['harga_produk'] * $jumlah;

                        ?>
                        <!-- <pre><?= print_r($ambil); ?></pre> -->
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $ambil['nama_produk']; ?></td>
                            <td>Rp. <?= number_format($ambil['harga_produk']); ?></td>
                            <td><?= $jumlah; ?></td>
                            <td>Rp. <?= number_format($subharga); ?></td>
                        </tr>
                        <?php $i++ ?>
                        <?php $totalbelanja += $subharga;  ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?= number_format($totalbelanja); ?> </th>
                    </tr>
                </tfoot>
            </table>

            <form action="" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama"><strong>Nama</strong></label>
                            <input type="text" class="form-control" id="nama" readonly value="<?= $user['namalengkap']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nohp"><strong>No HP</strong></label>
                            <input type="text" class="form-control" id="nohp" readonly value="<?= $user['nohp']; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="opsi_pengiriman">Opsi Pengiriman</label>
                        <select class="form-control" name="opsi_pengiriman" id="opsi_pengiriman">
                            <option value="">Pilih Opsi Pengiriman</option>
                            <option value="Ambil sendiri">Ambil sendiri</option>
                            <option value="Di antar">Di antar</option>
                            <!-- <option value="Dikirim">Dikirim</option> -->
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="opsi_pembayaran">Opsi Pembayaran</label>
                        <select class="form-control" name="opsi_pembayaran" id="opsi_pembayaran">
                            <option value="">Pilih Opsi Pembayaran</option>
                            <option value="Transfer">Transfer</option>
                            <option value="COD">COD</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat"><strong>Alamat Pengiriman</strong></label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"><?= $alamat_pengiriman; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <p>
                                <strong>NOTE :</strong> Diantar hanya untuk wilayah Jember dan Bondowoso
                            </p>
                        </div>
                    </div>
                </div>

                <div class=" d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="checkout">Checkout</button>
                </div>

            </form>

            <?php

            if (isset($_POST['checkout'])) {
                $id_user = $user['id'];
                $tanggal_pembelian = date("Y-m-d");
                $alamat_pengiriman = $alamat_pengiriman;
                $total_pembelian = $totalbelanja;
                $opsi_pengiriman = $_POST['opsi_pengiriman'];
                $opsi_pembayaran = $_POST['opsi_pembayaran'];
                $alamat_pengiriman = $_POST['alamat'];
                $status_pembelian = "Menunggu pembayaran";
                $status_terima = "Belum diterima";

                // 1. Menyimpan data ke tabel pembelian
                $conn->query("INSERT INTO pembelian (id_user, tanggal_pembelian, total_pembelian, opsi_pengiriman, opsi_pembayaran, alamat_pengiriman, status_pembelian, status_terima)
                VALUES ('$id_user', '$tanggal_pembelian', '$total_pembelian', '$opsi_pengiriman', '$opsi_pembayaran', '$alamat_pengiriman', '$status_pembelian', '$status_terima')");

                // mendapatkan id_pembelian barusan terjadi
                $id_pembelian_barusan = $conn->insert_id;



                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {

                    // mendapatkan data produk berdasarkan id_produk
                    $ambil = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
                    // $perproduk = $ambil->fetch_assoc();

                    $nama = $ambil['nama_produk'];
                    $harga = $ambil['harga_produk'];
                    $berat = $ambil['berat_produk'];
                    $subberat = $ambil['berat_produk'] * $jumlah;
                    $subharga = $ambil['harga_produk'] * $jumlah;

                    $conn->query("UPDATE produk SET stock_produk = stock_produk - $jumlah WHERE id_produk = '$id_produk'");

                    $conn->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah, nama, harga, berat, subberat, subharga)
                    VALUES ('$id_pembelian_barusan', '$id_produk', '$jumlah', '$nama', '$harga', '$berat', '$subberat', '$subharga')");
                }

                // Mengkosongkan keranjang belanja
                unset($_SESSION['keranjang']);

                // tampilan diarahkan ke halaman nota, nota dari pembelian barusan
                echo "<script>alert('Pembelian berhasil!');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }

            ?>

        </div>

        <!-- <pre><?php print_r($_SESSION['user']); ?></pre> -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
        </svg>
    </section>

    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>

</body>



</html>