<?php

include 'koneksi.php';
include 'header.php';
include 'sidebar.php';
include 'topbar.php';

$id_siswa = $_GET["id"];

$siswa = query("SELECT * FROM siswa WHERE id_siswa = $id_siswa")[0];

//cek button submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //alert
    if (editsiswa($_POST) > 0) {
        echo "<script>alert('data berhasil diupdate!'); document.location.href = 'siswa.php';</script>";
    } else {
        echo "<script>alert('data gagal diupdate!'); document.location.href = 'ubah.php';</script>";
    }
}

?>
<div class="container-fluid">
    <h4><i class="fas fa-edit fa-sm"></i>UPDATE DATA SISWA</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_siswa" value="<?= $siswa["id_siswa"]; ?>">
        <div class="form-group">
            <label for="NIS">NIS</label>
            <input type="text" name="NIS" id="NIS" required class="form-control" value="<?= $siswa["NIS"]; ?>">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="Nama" required class="form-control" value="<?= $siswa["Nama"]; ?>">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="Alamat" required class="form-control" value="<?= $siswa["Alamat"]; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-primary">SIMPAN</button>
        <a href="siswa.php" type="button" class="btn btn-sm btn-danger ">Close</a>
    </form>
</div>