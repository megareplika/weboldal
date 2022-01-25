<?php

include_once './Database.php';
include_once './File.php';

class Kapcsolat {

    private $f;

    public function __construct() {
        $this->DB = new Database();
        $this->f = new File();
    }

    public function rajzol($result) {
        $html = "<div id=\"conn\">";
        foreach ($result as $data) {
            if ($this->f->letezikEFile($data['kep'])) {
                $kep = $data['kep'];
            } else {
                $kep = "kep/Def.png";
            }
            $html .= '<a href="' . $data['url'] . '" target="_blank"><div><img src="' . $kep . '" alt="' . $data['röviditése'] . '" title="' . $data['röviditése'] . '"><label>' . $data['megnevezes'] . '</label></div></a>';
        }
        $html .= "</div>";
        return $html;
    }

    public function rajzolFooter($result) {
        $html = "<div id=\"footConn\">";
        foreach ($result as $data) {
            if ($this->f->letezikEFile($data['kep'])) {
                $kep = $data['kep'];
            } else {
                $kep = "kep/Def.png";
            }
            $html .= '<a href="' . $data['url'] . '" target="_blank"><div>' . $data['megnevezes'] . '</div></a>';
        }
        $html .= "</div>";
        return $html;
    }

}
