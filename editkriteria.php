<?php

include 'koneksi.php';
include 'header.php';
include 'sidebar.php';
include 'topbar.php';

$id_kriteria = $_GET["id"];

$kriteria = query("SELECT * FROM kriteria WHERE id_kriteria = $id_kriteria")[0];

//cek button submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //alert
    if (editkriteria($_POST) > 0) {
        echo "<script>alert('data berhasil diupdate!'); document.location.href = 'kriteria.php';</script>";
    } else {
        echo "<script>alert('data gagal diupdate!'); document.location.href = 'editkriteria.php';</script>";
    }
}

?>
<div class="container-fluid">
    <h4><i class="fas fa-edit fa-sm"></i>UPDATE DATA KRITERIA</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_kriteria" value="<?= $kriteria["id_kriteria"]; ?>">
        <div class="form-group">
            <label for="id_aspek">Kode Aspek</label>
            <input type="text" name="id_aspek" id="id_aspek" required class="form-control" value="<?= $kriteria["id_aspek"]; ?>">
        </div>
        <div class="form-group">
            <label>Kode Kriteria</label>
            <input type="text" name="kode_kriteria" required class="form-control" value="<?= $kriteria["kode_kriteria"]; ?>">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" required class="form-control" value="<?= $kriteria["deskripsi"]; ?>">
        </div>
        <div class="form-group">
            <label>Jenis Kriteria</label>
            <select name="jenis" class="form-control" value="<?= $kriteria["jenis"]; ?>">
                <option value="Core Factor">Core Factor</option>
                <option value="Secondary Factor">Secondary Factor</option>
            </select>

        </div>

        <div class="form-group">
            <label>Nilai Kriteria</label>
            <input type="text" name="nilai" required class="form-control" value="<?= $kriteria["nilai"]; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-primary">SIMPAN</button>
        <a href="kriteria.php" type="button" class="btn btn-sm btn-danger ">Close</a>
    </form>
</div>