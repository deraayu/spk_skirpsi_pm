<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$id = $_GET["id"];

if (hapusaspek($id) > 0) {
    echo "<script>alert('data berhasil dihapus!'); document.location.href = 'aspek.php';</script>";
} else {
    echo "<script>alert('data gagal dihapus!'); document.location.href = 'aspek.php';</script>";
}
