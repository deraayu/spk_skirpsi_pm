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


?>

<html>
<script type="text/javascript">
    function inputNilai(x) {
        if (x == "4") {
            window.location = 'inputnilai_sikap.php';
        } else {
            if (x == "A002") {
                window.location = 'inputnilai_sk.php';
            } else {
                if (x == "A003") {
                    window.location = 'inputnilai_pr.php';
                } else {
                    alert('Kriteria tidak tersedia');
                }
            }
        }
    }
</script>

<div class="row col-sm-6">
    <div class="col-sm-9">
        <form class="spasiAtas">
            <div class="form-group">
                <h4><i class="fas fa-plus fa-sm mb-3"></i> INPUT NILAI PRAKERIN</h4>
                <select name="id_aspek" class="form-control">
                    <option value="-1">Pilih Aspek </option>

                    <?php

                    $qcek = $con->query("SELECT * from aspek");
                    while ($row = $qcek->fetch_array()) {
                    ?>
                        <option value='"<?= $row['id_aspek'] ?>"' onclick="inputNilai('<?= $row['id_aspek'] ?>')"><?= $row['nama_aspek'] ?></option>;
                    <?php
                    }
                    ?>

                </select>
            </div>


            <table class="table table-striped" id="inputNilaiProfile">

            </table>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <!--end div class=col-6-->
</div>
<!--end div class=row-->