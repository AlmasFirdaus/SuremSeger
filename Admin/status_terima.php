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

$id_pembelian = $_GET['id'];
$conn->query("UPDATE pembelian SET status_terima = 'Sudah diterima' WHERE id_pembelian = '$id_pembelian'");

echo "<script> document.location.href = 'dataPesanan.php'; </script>";
