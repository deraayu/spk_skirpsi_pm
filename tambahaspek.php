<?php
include 'koneksi.php';
include 'header.php';
include 'sidebar.php';
include 'topbar.php';

//cek button submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //ambil data
    $kode = htmlspecialchars($_POST["kode"]);
    $nama_aspek = htmlspecialchars($_POST["nama_aspek"]);
    $persentase = htmlspecialchars($_POST["persentase"]);
    $bobot_cf = htmlspecialchars($_POST["bobot_cf"]);
    $bobot_sf = htmlspecialchars($_POST["bobot_sf"]);

    // query insert data
    $query = "INSERT INTO aspek VALUES ('','$kode','$nama_aspek','$persentase', '$bobot_cf','$bobot_sf')";
    mysqli_query($con, $query);

    //alert
    if (mysqli_affected_rows($con) > 0) {
        echo "<script>alert('data berhasil ditambahkan!'); document.location.href = 'aspek.php';</script>";
    } else {
        echo "<script>alert('data gagal ditambahkan!'); document.location.href = 'tambahaspek.php';</script>";
    }
}

?>
<div class="container-fluid">
    <h4><i class="fas fa-plus fa-sm"></i>TAMBAH DATA SISWA</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" id="kode" required class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Aspek</label>
            <input type="text" name="nama_aspek" required class="form-control">
        </div>
        <div class="form-group">
            <label>Persentase (%)</label>
            <input type="text" name="persentase" required class="form-control">
        </div>
        <div class="form-group">
            <label>Bobot Core Factor (%)</label>
            <input type="text" name="bobot_cf" required class="form-control">
        </div>
        <div class="form-group">
            <label>Bobot Secondary Factor (%)</label>
            <input type="text" name="bobot_sf" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-primary">SIMPAN</button>
        <a href="aspek.php" type="button" class="btn btn-sm btn-danger ">Close</a>
    </form>
</div>