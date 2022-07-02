<?php
session_start();
require_once "koneksi.php";

if (isset($_GET["getIdSiswa"])) {
    $id = mysqli_real_escape_string($koneksi, trim($_GET["getIdSiswa"]));
    $sql = "SELECT * from siswa where id_siswa='" . $id . "'";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $fetch = mysqli_fetch_object($query);
    echo json_encode($fetch);
}
if (isset($_GET["getIdAspek"])) {
    $id = mysqli_real_escape_string($koneksi, trim($_GET["getIdAspek"]));
    $sql = "SELECT * from `aspek` where id_aspek='" . $id . "'";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $fetch = mysqli_fetch_object($query);
    echo json_encode($fetch);
}
if (isset($_GET["getIdKriteria"])) {
    $id = mysqli_real_escape_string($koneksi, trim($_GET["getIdKriteria"]));
    $sql = "SELECT a.id as id_kriteria,a.id_aspek,a.kode as kode_kriteria,a.nama_kriteria,a.nilai,a.jenis,b.id as id_aspek,b.kode as kode_aspek,b.nama_aspek from kriteria a inner join aspek b on a.id_aspek=b.id where a.id='" . $id . "'";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $fetch = mysqli_fetch_object($query);
    echo json_encode($fetch);
}
if (isset($_GET["getKriteriaByIdAspek"])) {
    $id = mysqli_real_escape_string($koneksi, trim($_GET["getKriteriaByIdAspek"]));
    $sql = "SELECT * from kriteria where id_aspek='" . $id . "'";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $data = array();
    while ($fetch = mysqli_fetch_object($query)) {
        array_push($data, $fetch);
    }

    echo json_encode(array("sukses" => $data));
}
if (isset($_GET["getAllDataAspek"])) {

    $sql = "SELECT * from aspek";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $data = array();
    while ($fetch = mysqli_fetch_object($query)) {
        array_push($data, $fetch);
    }

    echo json_encode(array("data" => $data));
}

if (isset($_GET["getAllDataAlternatif"])) {

    $siswa = query("SELECT * FROM siswa");
    while ($fetch = mysqli_fetch_object($query)) {
        array_push($data, $fetch);
    }

    echo json_encode(array("data" => $data));
}
if (isset($_GET["getAllProfile"])) {
    $sql = "SELECT a.id_siswa,a.NIS,c.Nama,a.id_kriteria,b.nama_kriteria,b.id_aspek,d.nama_aspek,a.nilai_profile FROM profile a inner join tbl_kriteria b on a.id_kriteria=b.id inner join siswa c on a.id_siswa=c.id inner join aspek d on d.id=b.id_aspek";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $data = array();
    while ($fetch = mysqli_fetch_object($query)) {
        array_push($data, $fetch);
    }

    echo json_encode(array("data" => $data));
}

if (isset($_GET["getAllKriteriaByIdAspek"])) {
    $id_aspek = mysqli_real_escape_string($koneksi, trim($_GET["getAllKriteriaByIdAspek"]));
    $sql = "SELECT * from kriteria where id_aspek='$id_aspek' order by id";
    $query = mysqli_query($koneksi, $sql) or die(json_encode(array("error" => mysqli_error($koneksi))));
    $data = array();
    while ($fetch = mysqli_fetch_object($query)) {
        array_push($data, $fetch);
    }

    echo json_encode(array("data" => $data));
}

function cekIssetPost($post)
{
    $gay = true;
    foreach ($post as $njir)
        $gay = $gay && isset($_POST[$njir]);
    return $gay;
}
function cekKosong($post)
{
    $gay = true;
    foreach ($post as $njir)
        $gay = $gay && strlen(trim($_POST[$njir])) > 0;
    return $gay;
}

if (isset($_POST["aksi"])) {
    if ($_POST["aksi"] == "inputNilaiProfil" && isset($_POST["data"])) {

        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        } //12 = input_profle

        $data = json_decode($_POST["data"]);
        foreach ($data as $nilai) {
            $id_siswa = mysqli_real_escape_string($koneksi, $nilai->id_siswa);
            foreach ($nilai->dataKriteria as $k => $id_kriteria) {
                $id_kriteria2 = mysqli_real_escape_string($koneksi, $id_kriteria);
                $nilai_profile = mysqli_real_escape_string($koneksi, $nilai->dataNilai[$k]);
                $query = mysqli_query($koneksi, "SELECT * from profile where id_siswa='$id_siswa' and id_kriteria='$id_kriteria'"); //cek apakah sudah ada data di tbl_profile dengan id_alternatif dan id_kriteria yg telah ditentukan
                if (mysqli_num_rows($query) == 0) {
                    mysqli_query($koneksi, "INSERT into profile values(null,'" . $id_siswa . "', '" . $id_kriteria2 . "', '" . $nilai_profile . "')");
                } else {
                    mysqli_query($koneksi, "update rofile set nilai_profile='" . $nilai_profile . "' where id_siswa='" . $id_siswa . "' and id_kriteria='" . $id_kriteria2 . "'");
                }
            }
        }
        echo json_encode(array("sukses" => true));
    }
}
