<?php

require_once '../functions.php';

$id_pembelian = $_GET['id'];

$conn->query("UPDATE pembelian SET status_pembelian ='Proses pembatalan' WHERE id_pembelian = '$id_pembelian'");

echo "<script>alert('Menunggu pembatalan');</script>";
echo "<script>location='riwayat.php';</script>";
