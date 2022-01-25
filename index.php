<!DOCTYPE html>
<?php
include_once './oldal.php';
include_once './tarolok/Adatok.php';
include_once './tarolok/Enum.php';
include_once './nyelvek.php';
$oldal = new oldal();
//$nyelv = new nyelvek();
if (!isset($_GET['oldal'])) {
    $_GET['oldal'] = Enum::HOME;
}
if (!isset($_GET['nyelv'])) {
    $_GET['nyelv'] = Enum::HU;
}
?>
<html>
    <head>
        <title><?php echo Adatok::FejlecCim; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/rend.css" rel="stylesheet" type="text/css">
        <link href="css/stilus.css" rel="stylesheet" type="text/css">
        <link href="css/mobilNezet.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/png" href="kep/Logo.png">
        <script src="js/alap.js" type="text/javascript"></script>
    </head>
    <body>
        <main>
            <header>
                <a href="index.php?oldal=<?php echo Enum::HOME; ?>">
                    <h1>
                        <?php
                        $oldal->setGet($_GET['oldal']);
                        echo $oldal->cim($_GET['oldal']);
                        ?>
                    </h1>
                </a>
                <div id="time"></div>
            </header>
            <nav>
                <ul>
                    <li id="menupont">
                        <a href="index.php?oldal=<?php echo Enum::HOME; ?>">Home</a>
                        <a href="index.php?oldal=<?php echo Enum::NOTE; ?>">Jegyzetek</a>
                        <a href="index.php?oldal=<?php echo Enum::BLOG; ?>">Blog</a>
                        <a href="index.php?oldal=<?php echo Enum::CONNECT; ?>">Elérhetőség</a>
                    </li>
                    <li id="belep">
                        <a href="index.php?oldal=<?php echo Enum::BELÉPÉS; ?>">Belépés</a>
                        <a href="index.php?oldal=<?php echo Enum::REGISZTRÁLÁS; ?>">Regisztrálás</a>
                    </li>
                    <?php // $nyelv->lehetosegek(); ?>
                </ul>
            </nav>
            <article id="tartalom">
                <?php
                $oldal->setGet($_GET['oldal']);
                $oldal->tartalom();
                ?>
            </article>
            <aside id="oldalszallag">
                <h2>Hirek</h2>
                <div id="dc">
                    <iframe src="https://discord.com/widget?id=362703305308372992&theme=dark" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                </div>
                <div id="hirek"><?php $oldal->hirek(); ?></div>
            </aside>
            <footer>
                <?php $oldal->footerTart() ?>
                <div id="date"></div>
            </footer>
        </main>
    </body>
</html>
