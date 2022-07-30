<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
include 'header.php';
include 'sidebar.php';
include 'topbar.php';
echo 'ada';

$id_kriteria = $_POST['id_kriteria'];
$id_siswa = $_POST['id_siswa'];
$value = $_POST['value'];



$query = "INSERT INTO nilai VALUES('','$id_siswa','$id_kriteria','$value')";

mysqli_query($con, $query);
