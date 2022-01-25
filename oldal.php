<?php

include_once './Database.php';
include_once './tarolok/Adatok.php';
include_once './tarolok/Enum.php';
include_once './File.php';
include_once './Hir.php';
include_once './Kapcsolat.php';
include_once './nyelvek.php';

class oldal implements Enum, Adatok {

    private $DB;
    private static $get;
    private $file;
    private $hir;
    private $kapcs;
    private static $nyelv;
    private $nyel;

    public function __construct() {
        $this->DB = new Database();
        $this->file = new File();
        $this->hir = new Hir();
        $this->kapcs = new Kapcsolat();
        $this->nyel = new nyelvek();
        self::setGet("");
        self::setNyelv(Enum::HU);
    }

    public static function getNyelv() {
        $nyelv = self::$nyelv;
        return $nyelv;
    }

    public static function setNyelv($mire): void {
        self::$nyelv = $mire;
//        var_dump($this->nyel->valt($this->xmlBeolvas(Enum::NYELVIPACK), $this->nyel->nyelvvalasztás(self::$nyelv)));
    }

    static function setGet(String $ertek): void {
        if ($ertek == "" || $ertek == null) {
            self::$get = Enum::HOME;
        } else {
            self::$get = $ertek;
        }
    }

    static function getGet() {
        $get = self::$get;
        return $get;
    }

    public function tartalom() {
        $szoveg = "";
        if (self::$get === Enum::HOME || self::$get === "") {
            $szoveg = "kezdőoldal";
        } else if (self::$get === Enum::BLOG) {
            $szoveg = "Blog";
        } else if (self::$get === Enum::NOTE) {
            $szoveg = include Enum::forrásPHP . 'jegyzet.php';
        } else if (self::$get === Enum::CONNECT) {
            $this->file->íras(Enum::forrásPHP . "kapcs.php", $this->kapcs->rajzol($this->DB->elerhetoseg()));
            $szoveg = include Enum::forrásPHP . 'kapcs.php';
//            $result = $this->DB->elerhetoseg();
//            $szoveg = "<article id=\"tartalom\"><div id=\"conn\">";
//            foreach ($result as $data) {
//                if ($this->file->letezikEFile($data['kep'])) {
//                    $kep = $data['kep'];
//                } else {
//                    $kep = "kep/Def.png";
//                }
//                $szoveg .= '<a href="' . $data['url'] . '" target="_blank"><div><img src="' . $kep . '" alt="' . $data['röviditése'] . '" title="' . $data['röviditése'] . '"><label>' . $data['megnevezes'] . '</label></div></a>';
//            }
//            $szoveg .= "</div></article>";
//            echo $szoveg;
        } else if (self::$get === Enum::HALOZAT) {
            $this->file->íras(Enum::forrásPHP . "halozat.php", $this->file->kirajzol(Enum::HALOZAT));
            $szoveg = include Enum::forrásPHP . 'halozat.php';
        } else if (self::$get === Enum::PROG) {
            $this->file->íras(Enum::forrásPHP . "prog.php", $this->file->kirajzol(Enum::PROG));
            $szoveg = include Enum::forrásPHP . 'prog.php';
        } else if (self::$get === Enum::BELÉPÉS) {
            $szoveg = include Enum::forrásPHP . 'belepes.php';
        } else if (self::$get === Enum::REGISZTRÁLÁS) {
            $szoveg = include Enum::forrásPHP . 'regi.php';
        }
        return $szoveg;
    }

    public function hirek() {
        $this->file->íras(Enum::forrásPHP . "FressNews.php", $this->hir->hirSzalag($this->DB->lefuttat(Adatok::hirekTop5)));
        return include Enum::forrásPHP . "FressNews.php";
    }

    public function footerTart() {
        $this->file->íras(Enum::forrásPHP . "footerkapcs.php", $this->kapcs->rajzolFooter($this->DB->elerhetoseg()));
        return include Enum::forrásPHP . "footerkapcs.php";
    }

    public function cim() {
        $cim = Adatok::FejlecCim;
        if (self::$get === Enum::HOME || self::$get === "") {
            $cim .= " Home";
        } else if (self::$get === Enum::BLOG) {
            $cim .= " Blog";
        } else if (self::$get === Enum::NOTE) {
            $cim .= " Jegyzetek";
        } else if (self::$get === Enum::CONNECT) {
            $cim .= " Elérhetőségek";
        }
        return $cim;
    }

}
