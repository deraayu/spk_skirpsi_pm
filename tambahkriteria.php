<?php
include 'koneksi.php';
$aspek = mysqli_query($con, "SELECT * FROM aspek");
include 'header.php';
include 'sidebar.php';
include 'topbar.php';

//cek button submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //ambil data
    $kode_aspek = htmlspecialchars($_POST["kode_aspek"]);
    $kode_kriteria = htmlspecialchars($_POST["kode_kriteria"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $jenis = htmlspecialchars($_POST["jenis"]);
    $nilai = htmlspecialchars($_POST["nilai"]);

    // query insert data
    $query = "INSERT INTO kriteria VALUES ('','$kode_aspek','$kode_kriteria','$deskripsi','$jenis','$nilai')";
    mysqli_query($con, $query);

    //alert
    if (mysqli_affected_rows($con) > 0) {
        echo "<script>alert('data berhasil ditambahkan!'); document.location.href = 'kriteria.php';</script>";
    } else {
        echo "<script>alert('data gagal ditambahkan!'); document.location.href = 'tambahkriteria.php';</script>";
    }
}

?>
<div class="container-fluid">
    <h4><i class="fas fa-plus fa-sm"></i>TAMBAH DATA KRITERIA</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="kode_aspek">Kode Aspek</label>
            <select name="kode_aspek" class="form-control">
                <option disabled selected value="">Pilih</option>
                <?php while ($row = mysqli_fetch_array($aspek)) { ?>
                    <option value="<?= $row['id_aspek'] ?>"><?= $row['nama_aspek'] ?></option>
                <?php } ?>

            </select>

        </div>
        <div class="form-group">
            <label>Kode Kriteria</label>
            <input type="text" name="kode_kriteria" required class="form-control">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" required class="form-control">
        </div>
        <div class="form-group">
            <label>Jenis Kriteria</label>
            <select name="jenis" class="form-control">
                <option value="Core Factor">Core Factor</option>
                <option value="Secondary Factor">Secondary Factor</option>
            </select>
        </div>
        <div class="form-group">
            <label>Nilai</label>
            <input type="text" name="nilai" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-primary">SIMPAN</button>
        <a href="kriteria.php" type="button" class="btn btn-sm btn-danger ">Close</a>
    </form>
</div>