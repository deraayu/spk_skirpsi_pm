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



if (isset($_POST["cari"])) {


    $id = $_POST['id_aspek'];
    $query = "SELECT * FROM kriteria WHERE id_aspek = " . $id;

    $result = mysqli_query($con, $query);

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
        <form class="spasiAtas" method="POST" action="coba.php">
            <div class="form-group">
                <table class=" table-bordered table-hover table-striped disable">
                    <tr>

                        <td>Nama Siswa</td>
                        <?php
                        if (isset($_POST["cari"])) {


                            $id = $_POST['id_aspek'];
                            $query = "SELECT * FROM kriteria WHERE id_aspek = " . $id;

                            $result = mysqli_query($con, $query);

                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <td><?php echo $data['deskripsi'] ?></td>

                        <?php }
                        } ?>
                    </tr>
                    <?php
                    $query2 = "SELECT * FROM siswa";
                    $result = mysqli_query($con, $query2);
                    while ($data = mysqli_fetch_array($result)) {

                    ?>
                        <tr>


                            <td>
                                <!-- <input type="text" style="width: 80px" name="NISN" id="nilai_cf_A1" readonly> -->
                                <input type="text" style="width: 80px" name="Nama" value="<?php echo $data['Nama'] ?>" placeholder="<?php echo $data['Nama'] ?>">
                            </td>

                            <?php
                            $id = $_POST['id_aspek'];
                            $query = "SELECT * FROM kriteria WHERE id_aspek = " . $id;

                            $result = mysqli_query($con, $query);

                            while ($data = mysqli_fetch_array($result)) {



                            ?>
                                <td>
                                    <!-- <select class="custom-select d-block w-100" name="<?php echo $row['id_pelamar'] ?>_A8">
                                    <option value="1" <?php echo $row['A8'] == 1 ? "selected=selected" : ""; ?>>1 - Kurang</option>
                                    <option value="2" <?php echo $row['A8'] == 2 ? "selected=selected" : ""; ?>>2 - Cukup</option>
                                    <option value="3" <?php echo $row['A8'] == 3 ? "selected=selected" : ""; ?>>3 - Baik</option>
                                    <option value="4" <?php echo $row['A8'] == 4 ? "selected=selected" : ""; ?>>4 - Sangat Baik</option>
                                </select> -->

                                    <select name="" id="">

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
            <input type="submit" name="cari">
        </form>
    </div>
    <!--end div class=col-6-->
</div>

</html>