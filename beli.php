<?php
session_start();

$id_produk = $_GET['id'];

// jika sudah ada produk itu dikeranjang, maka produk itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
} else {
    // jika belum ada dikerangjang maka produk dianggap dibeli 1
    $_SESSION['keranjang'][$id_produk] = 1;
};

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

echo "<script>alert('Produk telah ditambahkan ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
