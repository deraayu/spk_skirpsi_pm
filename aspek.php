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
$jumlahdata = count(query("SELECT * FROM aspek"));
$jumlahpage = ceil($jumlahdata / $jumlahdataperpage);
$pageaktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awaldata = ($jumlahdataperpage * $pageaktif) - $jumlahdataperpage;

$aspek = query("SELECT * FROM aspek LIMIT $awaldata, $jumlahdataperpage");


if (isset($_POST["cari"])) {
    $aspek = cari_aspek($_POST["keyword"]);
}

?>


<div class="container-fluid">
    <h4 class="text-center">DATA ASPEK</h4>

    <a href="tambahaspek.php" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm">Tambah Aspek</a></i>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Aspek</th>
            <th>persentase (%)</th>
            <th>Bobot Core Factor (%)</th>
            <th>Bobot Secondary Factor (%)</th>
            <th colspan="2">AKSI</th>
        </tr>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($aspek as $row) :  ?>
                <tr>
                    <td><?= $no++ ?>.</td>
                    <td><?= $row['kode_aspek']; ?></td>
                    <td><?= $row['nama_aspek']; ?></td>
                    <td><?= $row['persentase']; ?></td>
                    <td><?= $row['bobot_cf']; ?></td>
                    <td><?= $row['bobot_sf']; ?></td>
                    <td><a href="editaspek.php?id=<?= $row['id_aspek']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a></td>
                    <td><a href="hapusaspek.php?id=<?= $row['id_aspek']; ?>" onclick="return confirm('yakin?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a></td>

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