<?php
include "koneksi.php";
include "classhitung.php";
$dataAlternatif = [];
$query = mysqli_query($con, "SELECT * FROM siswa order by id_siswa asc") or die(mysqli_error($con));
while ($fetch = mysqli_fetch_object($query)) {
    $alternatif = new Alternatif($fetch->id_siswa, $fetch->NIS, $fetch->ama);
    array_push($dataAlternatif, $alternatif);
}
$sql = "SELECT * FROM aspek order by id_aspek asc";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
$arrayHitung = [];
while ($fetch = mysqli_fetch_object($query)) {
    $Hitung = new Hitung();
    $Aspek = new Aspek($fetch->kode, $fetch->nama_aspek, $fetch->persentase);
    $Hitung->Aspek = $Aspek;
    foreach ($dataAlternatif as $alternatif1) {
        $Data = new Data();
        $Data->Alternatif = $alternatif1;

        $sql2 = "SELECT a.id_siswa,c.Nama,a.id_kriteria,b.kode_kriteria,b.deskripsi,b.nilai as nilai_kriteria,b.jenis,b.id_aspek,d.nama_aspek,a.nilai FROM nilai_siswa a 
				inner join kriteria b on a.id_kriteria=b.id inner join siswa c on a.id_siswa=c.id
				inner join aspek d on d.id=b.id_aspek where b.id_aspek='" . $fetch->id . "' and c.id='" . $alternatif1->id . "' order by id_siswa,a.id_kriteria";
        $query2 = mysqli_query($con, $sql2);
        $coreF = 0;
        $secondaryF = 0;
        $C = 0;
        $S = 0;
        while ($fetch2 = mysqli_fetch_object($query2)) {
            $nilai = new nilai($fetch2);
            $Data->addnilai($nilai);

            if ($fetch2->factor == 1) {
                $coreF += $nilai->bobot;
                $C++;
            } else {
                $secondaryF += $nilai->bobot;
                $S++;
            }
        }
        if ($C == 0) $Data->NCF = 0;
        else $Data->NCF = $coreF / $C;
        if ($S == 0) $Data->NSF = 0;
        else $Data->NSF = $secondaryF / $S;
        $Data->hitungTotal();
        $Hitung->addData($Data);
    }
    array_push($arrayHitung, $Hitung);
}
$th = "";
foreach ($dataAlternatif as $dataAlternatif2) {
    $x[$dataAlternatif2->id] = $dataAlternatif2;
}

foreach ($arrayHitung as $key => $hitungz) {
    foreach ($hitungz->Data as $data) {
        $Njir["Alternatif"][$data->Alternatif->id] = $data->Alternatif;
        $Njir["Hasil"][$data->Alternatif->id][] = $data->Total * $hitungz->Aspek->nilai_persen / 100;
        //$hasil[$data->Alternatif->id][]=
    }
    $th .= "<th>" . $hitungz->Aspek->value . " (" . $hitungz->Aspek->nilai_persen . "%)</th>";
}

$keys = array_keys($Njir["Hasil"]);
$DataAkhir = [];
foreach ($Njir["Alternatif"] as $key => $val) {
    array_push($DataAkhir,  array("Alternatif" => $val, "Hasil" => $Njir["Hasil"][$key], "Rank" => array_sum($Njir["Hasil"][$key])));
}
//print_r($DataAkhir);die;
for ($i = 0; $i < count($DataAkhir); $i++) {
    for ($j = 0; $j < $i; $j++) {
        if ($DataAkhir[$i]["Rank"] > $DataAkhir[$j]["Rank"]) {
            $tmp = $DataAkhir[$j];

            $DataAkhir[$j] = $DataAkhir[$i];

            $DataAkhir[$i] = $tmp;
        }
    }
}
$html = "";
$i = 1;
foreach ($DataAkhir as $Data) {
    $html .= "<tr><td>" . $Data["Alternatif"]->key . " - " . $Data["Alternatif"]->value . "</td>";
    foreach ($Data["Hasil"] as $hasil) $html .= "<td>" . $hasil . "</td>";
    $html .= "<td>" . $Data["Rank"] . "</td><td>" . $i++ . "</td></tr>";
}
//print_r($DataAkhir);die;
//print_r($arrayHitung);

?>
<table class="table table-striped">
    <tr>
        <th>Alternatif</th><?php echo $th; ?><th>Total</th>
        <th>Rank</th>
    </tr>
    <?php echo $html; ?>
</table>