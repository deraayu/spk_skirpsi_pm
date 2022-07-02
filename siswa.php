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
$jumlahdata = count(query("SELECT * FROM siswa"));
$jumlahpage = ceil($jumlahdata / $jumlahdataperpage);
$pageaktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awaldata = ($jumlahdataperpage * $pageaktif) - $jumlahdataperpage;

$siswa = query("SELECT * FROM siswa LIMIT $awaldata, $jumlahdataperpage");


if (isset($_POST["cari"])) {
    $siswa = cari_siswa($_POST["keyword"]);
}

?>

<!-- Topbar Search -->
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="POST">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="keyword" autofocus autocomplete="off">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="cari">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>



<div class="container-fluid">
    <h4 class="text-center">DATA SISWA</h4>

    <a href="tambahsiswa.php" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm">Tambah Data Siswa</a></i>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th colspan="2">AKSI</th>
        </tr>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($siswa as $row) :  ?>
                <tr>
                    <td><?= $no++ ?>.</td>
                    <td><?= $row['NIS']; ?></td>
                    <td><?= $row['Nama']; ?></td>
                    <td><?= $row['Alamat']; ?></td>
                    <td><a href="ubah.php?id=<?= $row['id_siswa']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a></td>
                    <td><a href="hapus.php?id=<?= $row['id_siswa']; ?>" onclick="return confirm('yakin?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a></td>

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