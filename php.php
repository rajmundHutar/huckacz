<?php
define("ROOT", __DIR__);

require ROOT . "/mysql.php";
require ROOT . "/menu.php";
require ROOT . "/class/Report.Class.php";
require ROOT . "/class/lessc.inc.php";

session_start();

$Report = new Report();

function head($nadpis) {
    $pozadi[1] = "#73C5D6";  //bledemodra
    $pozadi[2] = "#006B3A";  //zelena tmave
    $pozadi[3] = "#EFA531";  //oranzova
    $pozadi[4] = "#9C2963";  //fialova
    $pozadi[5] = "#DA251D";  //cervena
    $pozadi[6] = "#7BAD29";  //svetle zelena
    $pozadi[7] = "#21317B";  //modra
    $pozadi[8] = "#F7DD4A";  //zluta
    $nahodne = rand(1, 8);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="description" content="Hučka - Divadelní amatérský festival pro děti a mládež">
            <meta name="keywords" content="hučka,hucka,Hucka,hucku,hučku,festival,divadlo,trebic,Třebíč,Trebic">
            <meta name="author" content="Jaroslav ,Rajmund, Hutař">
            <meta name="robots" content="index,follow">
            <link href="./obr/logo.jpg" rel="icon" type="image/jpg">
            <link rel="stylesheet" href="./css/styles.php">
            <link rel="stylesheet" href="./css/jquery.lightbox-0.5.css" type="text/css" media="screen" />

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script type="text/javascript" src="./jquery/jquery.lightbox-0.5.min.js"></script>

            <link  href="//fonts.googleapis.com/css?family=IM+Fell+DW+Pica:regular,italic" rel="stylesheet" type="text/css" >
            <title><?php echo $nadpis ? $nadpis . " - Hučka.cz" : "Hučka.cz" ?></title>
            <script type="text/javascript">
                $(function () {
                    $("a[rel^=lightbox]").lightBox();
                });
            </script>
        </head>
        <body style="background-color:<?php echo $pozadi[$nahodne]; ?>">
            <div id="wrapper">
                <header></header>
                <?php //echo $obr ? ('style="background-image: URL(\'./obr/pravyroh/' . $obr . '.jpg\');"') : "" ?>
                <navigation class="menu">
                    <?php
                    menu();
                    ?>
                </navigation>
                <article>
<?php
}

function foot() {
    echo "</article>";
    echo "<footer class='spodek'><div>Hučka 1999 - " . Date("Y") . " | webmaster: <a href='http://www.rajmund.cz'>www.rajmund.cz</a></div></footer>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
}
                