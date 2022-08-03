<!--button cari diklik mencari faktor berdasarkan id_aspek -->

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

$nilai = [];


if (isset($_POST["cari"])) {


    $id1 = $_POST['id_aspek'];
    $query1 = "SELECT * FROM kriteria WHERE id_aspek = " . $id1;

    $result1 = mysqli_query($con, $query1);

    // while ($data = mysqli_fetch_array($result)) {
    //     echo $data['id_aspek'];
    //     echo $data['deskripsi'];
    //     echo $data['jenis'];
    // }
}
?>
<html>
<div class="row col-sm-6">
    <div class="col-sm-9">
        <form class="spasiAtas " method="POST" action="tambah_action.php">
            <div class=" container-fluid">
                <table class=" table table-bordered table-hover table-striped ">
                    <tr>

                        <td>Nama Siswa</td>
                        <?php
                        if (isset($_POST["cari"])) {


                            $id2 = $_POST['id_aspek'];
                            $query2 = "SELECT * FROM kriteria WHERE id_aspek = " . $id2;

                            $result2 = mysqli_query($con, $query2);

                            while ($data2 = mysqli_fetch_array($result2)) {
                        ?>
                                <td><?php echo $data2['deskripsi'] ?></td>
                                <input type="hidden" name="id_kriteria" value="<?php echo $data2['id_kriteria'] ?>">
                        <?php }
                        } ?>
                    </tr>

                    <?php 
                        $query3 = "SELECT * FROM siswa";

                        $result3 = mysqli_query($con, $query3);

                        while ($data3 = mysqli_fetch_array($result3)) {
                    ?>

                    <tr>
                        <td>
                            <input type="hidden" style="width: 80px" name="id_siswa" value="<?php echo $data3['id_siswa'] ?>" placeholder="<?php echo $data3['id_siswa'] ?>">

                            <input type="text" name="nama_siswa" value='<?= $data3['Nama'] ?>'>

                            <?php $jml = count($data3)?>

                        </td>
                        <?php
                        $id4 = $_POST['id_aspek'];
                        $query4 = "SELECT * FROM kriteria WHERE id_aspek = " . $id4;

                        $result4 = mysqli_query($con, $query4);

                        while ($data4 = mysqli_fetch_array($result4)) {



                        ?>
                            <td>
                                <select name="value">

                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>

                                </select>

                            </td>
                        <?php } ?>



                    </tr>
                    <?php } ?>

                </table>

            </div>


            <!--<button type="submit" class="btn btn-primary" name="cari">Cari</button> -->
            <input type="submit" name="simpan">
        </form>
    </div>
    <!--end div class=col-6-->
</div>

</html>

