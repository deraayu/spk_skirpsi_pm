<?php
class Alternatif
{
    public $id = -1;
    public $key;
    public $value;
    function __construct($id, $key, $value)
    {
        $this->id = $id;
        $this->key = $key;
        $this->value = $value;
    }
}
class nilai
{
    public $key;
    public $value;
    public $nilai_kriteria;
    public $nilai_siswa;
    public $factor;
    public $gap;
    public $bobot;
    function __construct($data)
    {
        $this->key = $data->kode;
        $this->value = $data->nama_kriteria;
        $this->nilai_kriteria = $data->nilai_kriteria;
        $this->nilai_siswa = $data->nilai_siswa;
        $this->factor = $data->factor;
        $this->gap = $this->nilai_siswa - $this->nilai_kriteria;
        $this->bobot = $this->getBobot($this->gap);
    }
    function getBobot($gap)
    {
        if ($gap < -4) return 1;
        else if ($gap > 4) return 5;
        $bobot = 3;
        switch ($gap) {
            case 0:
                $bobot = 3;
                break;
            case 1:
                $bobot = 3.5;
                break;
            case -1:
                $bobot = 2.5;
                break;
            case 2:
                $bobot = 4;
                break;
            case -2:
                $bobot = 2;
                break;
            case 3:
                $bobot = 4.5;
                break;
            case -3:
                $bobot = 1.5;
                break;
            case 4:
                $bobot = 5;
                break;
            case -4:
                $bobot = 1;
                break;
            default:
                $bobot = 3;
                break;
        }
        return $bobot;
    }
}
class Aspek
{
    public $key;
    public $value;
    public $nilai_persen;
    function __construct($key, $value, $nilai)
    {
        $this->key = $key;
        $this->value = $value;
        $this->nilai_persen = $nilai;
    }
}
class Data
{
    public $Alternatif;
    public $nilai_siswa;
    public $NCF;
    public $NSF;
    public $Total;
    function __construct()
    {
        $this->nilai_siswa = [];
    }
    function addnilai($nilai)
    {
        array_push($this->nilai, $nilai);
    }
    function hitungTotal()
    {
        $this->Total = (0.6 * $this->NCF) + (0.4 * $this->NSF);
    }
}
class Hitung
{
    public $Aspek; //Objek Aspek 
    public $Data; //Array Objek Data

    function __construct()
    {
        $this->Data = [];
    }
    function addData($Data)
    {
        array_push($this->Data, $Data);
    }
}
class siswa
{
    public $persen_coreFactor = 60;
    public $persen_secondaryFactor = 40;
    public $Data;
    function __construct()
    {
        $this->Data = [];
    }
}
