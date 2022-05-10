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

require_once("../functions.php");

$id = $_GET['id'];

if (hapusProduk($id) > 0) {
    echo "
        <script> 
            alert('Data berhasil dihapus');
            document.location.href = 'dataProduk.php';
        </script>
    ";
} else {
    echo "
        <script> 
            alert('Data gagal dihapus');
            document.location.href = 'dataProduk.php';
        </script>
    ";
}
