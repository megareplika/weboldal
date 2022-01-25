<?php

include_once './File.php';
include_once './tarolok/Adatok.php';
include_once './tarolok/Enum.php';

class Database implements Adatok, Enum {

    private $con;
    private $F;

    function __construct() {
        $this->F = new File();
    }

    private function nyit() {
        $this->con = new mysqli(Adatok::DBhost, Adatok::DBuser, Adatok::DBpass, Adatok::DBbase);
    }

    private function zar() {
        if (mysqli_stat($this->con)) {
            $this->con->close();
        }
    }

    public function elerhetoseg() {
        $this->nyit();
        $result;
        if (mysqli_stat($this->con)) {
            $result = $this->con->query(Adatok::conn);
        }
        $this->zar();
        return $result;
    }

//    public function hirek() {
//        $this->nyit();
//        if (mysqli_stat($this->con)) {
//            $result = $this->con->query(Adatok::hirekTop5);
//            if ($result != "" || $result != null) {
//                return $result;
//            } else {
//                return Adatok::ures;
//            }
//        }
//        $this->zar();
//    }

    public function lefuttat(String $mit) {
        $this->nyit();
        if (mysqli_stat($this->con)) {
            $result = $this->con->query($mit);
        } else {
            return Enum::ures;
        }
        $this->zar();
        if ($result != "" || $result != null) {
            return $result;
        } else {
            return Enum::ures;
        }
    }

    public function belepes($nev, $pass) {
        $sql = Adatok::login;
        str_replace("##NEV##", $nev, $sql);
        str_replace("##PASS##", $pass, $sql);
    }

}
