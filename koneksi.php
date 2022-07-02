<?php
$con = mysqli_connect('localhost', 'root', '', 'db_skripsi_pm');

function query($query)
{
    global $con;
    $result = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahsiswa($data)
{
    global $con;
    //ambil data
    $NIS = htmlspecialchars($_POST["NIS"]);
    $Nama = htmlspecialchars($_POST["Nama"]);
    $Alamat = htmlspecialchars($_POST["Alamat"]);
    // query insert data
    $query = "INSERT INTO siswa VALUES ('','$NIS','$Nama','$Alamat')";
    mysqli_query($con, $query);
    return mysqli_affected_rows($con);
}
function editsiswa($data)
{
    global $con;
    $id_siswa = $data["id_siswa"];
    $NIS = htmlspecialchars($_POST["NIS"]);
    $Nama = htmlspecialchars($_POST["Nama"]);
    $Alamat = htmlspecialchars($_POST["Alamat"]);

    $query = "UPDATE siswa SET 
                NIS = '$NIS',
                Nama = '$Nama',
                Alamat = '$Alamat'
                WHERE id_siswa =$id_siswa";
    mysqli_query($con, $query);
    return mysqli_affected_rows($con);
}
function hapus1($id)
{
    global $con;
    mysqli_query($con, "DELETE FROM siswa WHERE id_siswa = $id");
    return mysqli_affected_rows($con);
}

function cari_siswa($keyword)
{
    $query = "SELECT * FROM siswa WHERE
        NIS LIKE '%$keyword%' OR
        Nama LIKE '%$keyword%' OR
        Alamat LIKE '%$keyword%'         
         ";
    return query($query);
}

function editaspek($data)
{
    global $con;
    $id_aspek = $data["id_aspek"];
    $kode_aspek = htmlspecialchars($_POST["kode_aspek"]);
    $nama_aspek = htmlspecialchars($_POST["nama_aspek"]);
    $persentase = htmlspecialchars($_POST["persentase"]);



    $query = "UPDATE aspek SET 
                kode_aspek = '$kode_aspek',
                nama_aspek = '$nama_aspek',
                persentase = '$persentase'              
                WHERE id_aspek =$id_aspek";
    mysqli_query($con, $query);
    return mysqli_affected_rows($con);
}

function hapusaspek($id)
{
    global $con;
    mysqli_query($con, "DELETE FROM aspek WHERE id_aspek = $id");
    return mysqli_affected_rows($con);
}

function cari_aspek($keyword)
{
    $query = "SELECT * FROM aspek WHERE
        kode_aspek LIKE '%$keyword%' OR
        nama_aspek LIKE '%$keyword%' OR
        persentase LIKE '%$keyword%'        
         ";
    return query($query);
}

function editkriteria($data)
{
    global $con;
    $id_kriteria = $data["id_kriteria"];
    $id_aspek = htmlspecialchars($_POST["id_aspek"]);
    $kode_kriteria = htmlspecialchars($_POST["kode_kriteria"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $jenis = htmlspecialchars($_POST["jenis"]);
    $nilai = htmlspecialchars($_POST["nilai"]);

    $query = "UPDATE kriteria SET 
                id_aspek = '$id_aspek',
                kode_kriteria = '$kode_kriteria',
                deskripsi = '$deskripsi',
                jenis = '$jenis',
                nilai = '$nilai'
                WHERE id_kriteria =$id_kriteria";
    mysqli_query($con, $query);
    return mysqli_affected_rows($con);
}
function hapuskriteria($id)
{
    global $con;
    mysqli_query($con, "DELETE FROM kriteria WHERE id_kriteria = $id");
    return mysqli_affected_rows($con);
}
function cari_kriteria($keyword)
{

    $query = "SELECT * FROM kriteria WHERE
        kode_kriteria LIKE '%$keyword%' OR        
        deskripsi LIKE '%$keyword%' OR
        jenis LIKE '%$keyword%' OR
        nilai LIKE '%$keyword%'         
         ";
    return query($query);
}

function registrasi($data)
{
    global $con;

    $username = strtolower(stripslashes($data["username"]));
    $password_1 = mysqli_real_escape_string($con, $data["password_1"]);
    $password_2 = mysqli_real_escape_string($con, $data["password_2"]);

    //cek user apakah sudah ada di db?
    $result = mysqli_query($con, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script> alert('username sudah terdaftar!') </script>";
        return false;
    }


    //cek konfirmasi pass

    if ($password_1 !== $password_2) {
        echo "<script> alert('password tidak sesuai!') </script>";
        return false;
    }

    // enkripsi pass
    $password_1 = password_hash($password_1, PASSWORD_DEFAULT);

    //tambah user ke db
    mysqli_query($con, "INSERT INTO user VALUES('', '$username','$password_1')");

    return mysqli_affected_rows($con);
}
