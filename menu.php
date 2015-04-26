<?php

function menu() {
    $polozkyMenu[] = array(
        "name" => "Domů",
        "url" => "/",
    );
    $polozkyMenu[] = array(
        "name" => "Fotogalerie",
        "url" => "galerie.php",
    );
    $polozkyMenu[] = array(
        "name" => "Minulé ročníky",
        "url" => "historie.php",
    );
    $polozkyMenu[] = array(
        "name" => "Hučka-Team",
        "url" => "kontakty.php",
    );
    $polozkyMenu[] = array(
        "name" => "Návštěvní kniha",
        "url" => "kniha.php",
    );
    $polozkyMenu[] = array(
        "name" => "Tisk",
        "url" => "tisk.php",
    );
    /*$polozkyMenu[] = array(
        "name" => "Přihlášení divadla",
        "url" => "prihlaseni.php",
    );*/

    echo "<ul class='menu'>";
    echo "<li class='space'></li>";
    $i = 1;
    foreach ($polozkyMenu as $polozka) {
        echo "<li>";
            echo "<a href='{$polozka["url"]}' class='menuodkaz'>";
                echo "<img src='obr/menu/" . ($i % 8 + 1) . ".jpg' class='menu_img' alt=''>";
                echo "<div>{$polozka["name"]}</div>";
            echo "</a>";
        echo "</li>";
        $i++;
    }
    echo "<li class='space'></li>";
    echo "</ul>";
}
