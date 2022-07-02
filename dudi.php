<?php
include 'koneksi.php';
include 'header.php';
include 'sidebar.php';
include 'topbar.php';
?>


<div class="container-fluid">
    <h4 class="text-center">DATA DU/DI</h4>

    <a href="tambahaspek.php" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm">Tambah Du/Di</a></i>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>DU/DI</th>
            <th>Alamat</th>
            <th>Pembimbing</th>
            <th colspan="2">AKSI</th>
        </tr>
        <tbody>
            <?php
            $no = 1;
            $sql_dudi = mysqli_query($con, "SELECT * FROM du_di ") or die(mysqli_error($con));
            if (mysqli_num_rows($sql_dudi) > 0) {
                while ($data = mysqli_fetch_array($sql_dudi)) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['Alamat']; ?></td>
                        <td><?= $data['Pembimbing']; ?></td>
                        <td><a href="" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a></td>
                        <td><a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a></td>

                    </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan=\"5\" align=\"center\">Data Tidak ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</div>