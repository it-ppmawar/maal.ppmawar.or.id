<?php

class Database
{

    public $userdb = USER_DB;
    public $namadb = NAMA_DB;
    public $passdb = PASS_DB;
    public $host = URL;
    public $con;
    public $stm;

    public function __construct()
    {
        $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->namadb, $this->userdb, $this->passdb);

        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($qry, $data = [])
    {
        if (empty($data)) {
            $this->stm = $this->con->prepare($qry);
            return $this->stm->execute();
        } else {
            $this->stm = $this->con->prepare($qry);
            return $this->stm->execute($data);
        }
    }

    public function rowcount()
    {
        return $this->stm->rowcount();
    }

    public function columnCount()
    {

        return $this->stm->columnCount();
    }

    public function fetch_all()
    {
        return $this->stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetch_assoc()
    {
        return $this->stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function last_insertId()
    {
        return $this->con->lastInsertId();
    }
}
