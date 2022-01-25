<?php

class Cokkies {

    function __construct() {
        
    }
    
    public function userSave(int $id, bool $login) {
        setcookie($id, $login);
    }
}
