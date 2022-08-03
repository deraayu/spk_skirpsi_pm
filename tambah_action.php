<?php 

include 'koneksi.php';

if (isset($_POST['simpan'])) {

    for ($i=0; $i < 16; $i++) { 
        $id_siswa = $_POST['id_siswa'.$i];
        $id_kriteria = $_POST['id_kriteria'.$i];
        $value = $_POST['value'.$i];

        $query5 = "INSERT INTO nilai VALUES('', $id_siswa,$id_kriteria,  $value)";
        $result5 = mysqli_query($koneksi, $query5);


    }

}

; ?>