<?php

include 'koneksi.php';
include 'header.php';
include 'sidebar.php';
include 'topbar.php';

$id_aspek = $_GET["id"];

$aspek = query("SELECT * FROM aspek WHERE id_aspek = $id_aspek")[0];

//cek button submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //alert
    if (editaspek($_POST) > 0) {
        echo "<script>alert('data berhasil diupdate!'); document.location.href = 'aspek.php';</script>";
    } else {
        echo "<script>alert('data gagal diupdate!'); document.location.href = 'editaspek.php';</script>";
    }
}

?>
<div class="container-fluid">
    <h4><i class="fas fa-edit fa-sm"></i>UPDATE DATA KRITERIA</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_aspek" value="<?= $aspek["id_aspek"]; ?>">
        <div class="form-group">
            <label for="kode">Kode Aspek</label>
            <input type="text" name="kode" id="kode" required class="form-control" value="<?= $aspek["kode"]; ?>">
        </div>
        <div class="form-group">
            <label>Nama Aspek</label>
            <input type="text" name="nama_aspek" required class="form-control" value="<?= $aspek["nama_aspek"]; ?>">
        </div>
        <div class="form-group">
            <label>Persentase (%)</label>
            <input type="text" name="persentase" required class="form-control" value="<?= $aspek["persentase"]; ?>">
        </div>

        <button type="submit" name="submit" class="btn btn-sm btn-primary">SIMPAN</button>
        <a href="aspek.php" type="button" class="btn btn-sm btn-danger ">Close</a>
    </form>
</div>