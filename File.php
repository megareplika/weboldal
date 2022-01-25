<?php

class File {

    private $tomb;

    function __construct() {
        $this->tomb = array();
    }

    public function kirajzol($mappa) {
        $this->keresMappa($mappa);
        $szov = '<div id="fileok">';
        for ($i = 2; $i < count($this->tomb); $i++) {
            $V = $this->tomb[$i];
            $szov .= '<a href="file/' . $mappa . '/' . $V . '">' . $V . '</a>';
        }
        $szov .= "</div>";
        return $szov;
    }

    private function keresMappa(String $mappa) {
        $hely = "file/" . $mappa;
        if ($this->letezikEMappa($hely)) {
            $f = scandir($hely);
            foreach ($f as $sor) {
                if ($sor !== "." || $sor !== "..") {
                    array_push($this->tomb, $sor);
                }
            }
        }
    }

    public static function beolvas($mit) {
        $szov = "";
        if ($this->letezikEFile($mit)) {
            $szov = fopen($mit, 'r');
        }
        return $szov;
    }

    public static function letezikEMappa(String $mit) {
        return is_dir($mit);
    }

    public static function letezikEFile(String $mit) {
        return is_file($mit) && file_exists($mit);
    }

    public function íras(String $nev, $mit) {
        $file = fopen($nev, "w") or die("nincs meg a file");
        fwrite($file, $mit);
        fclose($file);
    }

    public function xmlBeolvas($xml) {
        return new SimpleXMLElement($xml);
    }

}
