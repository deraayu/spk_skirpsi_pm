<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$id = $_GET["id"];

if (hapuskriteria($id) > 0) {
    echo "<script>alert('data berhasil dihapus!'); document.location.href = 'kriteria.php';</script>";
} else {
    echo "<script>alert('data gagal dihapus!'); document.location.href = 'kriteria.php';</script>";
}
