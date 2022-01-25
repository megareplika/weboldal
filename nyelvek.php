<?php

include_once './tarolok/Adatok.php';
include_once './tarolok/Enum.php';
include_once './File.php';

class nyelvek implements Enum, Adatok {

    private $kezdo;
    private $note;
    private $blog;
    private $conn;
    private $login;
    private $reg;
    private $belépOldalTital;
    private $regOldalTital;
    private $hirszalagCim;

    private const nyelvek = [Enum::HU, Enum::ENG];

    private $file;

    public function __construct() {
        $this->nyelvvalasztás(Enum::HU);
        $this->file = new File();
        $this->belépOldalTital = array();
        $this->regOldalTital = array();
    }

    public function nyelvvalasztás($mire) {
        $hol;
        for ($i = 0; $i < count(self::nyelvek); $i++) {
            if (self::nyelvek[$i] === $mire) {
                $hol = $i;
            }
        }
//        $this->valt($this->file->xmlBeolvas(Enum::NYELVIPACK), self::nyelvek[$hol]);
    }

    public function lehetosegek() {
        $html = "";
        if (count(self::nyelvek) > 2) {
            $html = '<select id="nyelvSW" name="nyelvSW" onchange="<?php $nyelv->nyelvvalasztás($_GET[\'nyelv\']) ?>">';
            foreach (self::nyelvek as $ny) {
                if ($ny === Enum::HU) {
                    $html .= '<option value=' . $ny . ' selected="selected"> ' . $ny . '</option>';
                } else {
                    $html .= '<optionvalue=' . $ny . '>' . $ny . '</option>';
                }
            }
            $html = '</select>';
        } else {
            $html = '<div id="nyelvSW"><a href="<?php $_GET[\'' . self::nyelvek[0] . '\']?>">' . self::nyelvek[0] . '</a><a href="<?php $_GET[\'' . self::nyelvek[1] . '\']?>">' . self::nyelvek[1] . '</a></div>';
        }
//        $this->file->íras(Enum::forrásPHP . "nyelvSW.php", $html);
//        return include Enum::forrásPHP . "nyelvSW.php";
        echo $html;
    }

    public function valt($xml, $csalad) {
        $this->kezdo = $xml->$csalad->főmenu->Főoldal['felirat'];
        $this->note = $xml->$csalad->főmenu->Jegyzetek['felirat'];
        $this->blog = $xml->$csalad->főmenu->Blog['felirat'];
        $this->conn = $xml->$csalad->főmenu->Elérhetőség['felirat'];
        $this->login = $xml->$csalad->oldalmenu->Belépés['felirat'];
        $this->reg = $xml->$csalad->oldalmenu->Regisztrálás['felirat'];
        $this->belépOldalTital = [
            "cim" => $xml->$csalad->belepooldal->cim['felirat'],
            "nev" => $xml->$csalad->belepooldal->nev['felirat'],
            "pass" => $xml->$csalad->belepooldal->jelszo['felirat']];
        $this->regOldalTital = [
            "cim" => $xml->$csalad->regioldal->cim['felirat'],
            "nev" => $xml->$csalad->regioldal->nev['felirat'],
            "pass" => $xml->$csalad->regioldal->jelszo['felirat'],
            "pass2" => $xml->$csalad->regioldal->jelszo2['felirat'],
            "szul" => $xml->$csalad->regioldal->szul['felirat'],
            "Mgomb" => $xml->$csalad->regioldal->gomb['felirat']
        ];
        $this->hirszalagCim = $xml->$csalad->hiroldal->cim['felirat'];
    }

}
