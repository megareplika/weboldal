<?php

interface Adatok {

    //DB kapcsolat
    const DBhost = "localhost";
    const DBuser = "root";
    const DBpass = "";
    const DBbase = "oldal";
    //feliratok
    const FejlecCim = "Megareplika";
    //sql parancsok lekérdezések
    const conn = "select * from elerhetoseg";
    const login = "login(##NEV##,##PASS##)";
    const hirekTop5 = "top5Hir()";
    //egyébb
    const maxhosz = 20;

}
