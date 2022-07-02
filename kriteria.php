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

//pagination
$jumlahdataperpage = 5;
$jumlahdata = count(query("SELECT * FROM kriteria"));
$jumlahpage = ceil($jumlahdata / $jumlahdataperpage);
$pageaktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awaldata = ($jumlahdataperpage * $pageaktif) - $jumlahdataperpage;

$kriteria = query("SELECT * FROM kriteria LIMIT $awaldata, $jumlahdataperpage");

if (isset($_POST["cari"])) {
    $kriteria = cari_kriteria($_POST["keyword"]);
}

?>


<div class="container-fluid">
    <h4 class="text-center">DATA KRITERIA</h4>

    <a href="tambahkriteria.php" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm">Tambah Kriteria</a></i>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>Id Aspek</th>
            <th>Kode Kriteria</th>
            <th>Deskripsi</th>
            <th>Jenis</th>
            <th>Nilai</th>
            <th colspan="2">AKSI</th>
        </tr>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($kriteria as $row) :  ?>
                <tr>
                    <td><?= $no++ ?>.</td>
                    <td><?= $row['id_aspek']; ?></td>
                    <td><?= $row['kode_kriteria']; ?></td>
                    <td><?= $row['deskripsi']; ?></td>
                    <td><?= $row['jenis']; ?></td>
                    <td><?= $row['nilai']; ?></td>
                    <td><a href="editkriteria.php?id=<?= $row['id_kriteria']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a></td>
                    <td><a href="hapuskriteria.php?id=<?= $row['id_kriteria']; ?>" onclick="return confirm('yakin?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a></td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <!--navigasi-->
    <?php if ($pageaktif > 1) : ?>
        <a href="?page= <?= $pageaktif - 1; ?>">&laquo;</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $jumlahpage; $i++) : ?>
        <?php if ($i == $pageaktif) : ?>
            <a href="?page= <?= $i;  ?>" style="font-weight :bold"><?= $i; ?></a>
        <?php else : ?>
            <a href="?page= <?= $i;  ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($pageaktif < $jumlahpage) : ?>
        <a href="?page= <?= $pageaktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
</div>

</div>