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

//cek button submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //ambil data
    $NIS = htmlspecialchars($_POST["NIS"]);
    $Nama = htmlspecialchars($_POST["Nama"]);
    $Alamat = htmlspecialchars($_POST["Alamat"]);

    // query insert data
    $query = "INSERT INTO siswa VALUES ('','$NIS','$Nama','$Alamat')";
    mysqli_query($con, $query);

    //alert
    if (mysqli_affected_rows($con) > 0) {
        echo "<script>alert('data berhasil ditambahkan!'); document.location.href = 'siswa.php';</script>";
    } else {
        echo "<script>alert('data gagal ditambahkan!'); document.location.href = 'tambahsiswa.php';</script>";
    }
}

?>
<div class="container-fluid">
    <h4><i class="fas fa-plus fa-sm"></i>TAMBAH DATA SISWA</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="NIS">NIS</label>
            <input type="text" name="NIS" id="NIS" required class="form-control">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="Nama" required class="form-control">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="Alamat" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-primary">SIMPAN</button>
        <a href="siswa.php" type="button" class="btn btn-sm btn-danger ">Close</a>
    </form>
</div>