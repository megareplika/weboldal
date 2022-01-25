<?php

include_once './tarolok/Adatok.php';
include_once './Database.php';

class Hir implements Adatok {

    public function __construct() {
;
    }

    public function hirSzalag($result) {
        if ($result != Enum::ures) {
            $html = "";
            foreach ($result as $data) {
                $id = $data['id'];
                $datum = date("Y/d/m", new Date($data['datum']));
                $cim = $data['cim'];
                $fájl = $data['fájl'];
                $kateg = $data['kateg'];
                $szov = "";
                if (File::letezikEFile($fájl)) {
                    $szov = File::beolvas($fájl);
                    if (strlen($szov) > Adatok::maxhosz) {
                        $szov = str_split($szov, Adatok::maxhosz) . "...";
                    }
                }
                $html .= '<div id="' . $id . '"><h3>' . $cim . '<sup>' . $kateg . '</sup></h3><p>' . $szov . '</p><div class="hirdatum">' . $datum . '</div></div>';
            }
            return $html;
        } else {
            return "<b>nincsenek hírek</b>";
        }
    }

    public function összesHir($result) {
        if ($result != Enum::ures) {
            
        } else {
            return "<b>nincsenek hírek</b>";
        }
    }

}
