<?php

class mPublic extends Database
{

    public function getUang()
    {
        $this->query(" SELECT DISTINCT YEAR(tgl) AS tahun FROM uang_wakaf");
        $tahun = $this->fetch_all();
        foreach ($tahun as $thn) {
            $year = $thn->tahun;
            $this->query(" SELECT SUM(nominal) AS jumlah FROM uang_wakaf WHERE YEAR(tgl) <= '$year' ");
            $temp = $this->fetch_all();
            $uang[$year] = $temp[0]->jumlah;
        }

        return $uang;
    }

    public function getBasmalah()
    {
        $this->query(" SELECT * FROM basmalah ");
        $temp = $this->fetch_all();

        foreach ($temp as $tmp) {
            $basmalah[$tmp->tahun] = $tmp->laba;
        }

        return $basmalah;
    }

    public function listUang()
    {
        $this->query(" SELECT * FROM uang_wakaf ORDER BY tgl DESC");
        return $this->fetch_all();
    }

    public function listToko()
    {
        $this->query(" SELECT * FROM basmalah ORDER BY id DESC");
        return $this->fetch_all();
    }

    public function listAset()
    {
        $this->query(" SELECT * FROM asset_wakaf");
        return $this->fetch_all();
    }
    public function listPolis()
    {
        $this->query(" SELECT * FROM polis_wakaf ORDER BY tgl DESC");
        return $this->fetch_all();
    }
}
