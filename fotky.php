<?php
require "php.php";
head("Galerie");

$on_page = 32;

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$dir = "./galerie/{$_GET["rocnik"]}/mini";
$handle = opendir($dir);
$fotky = array();
while (false !== ($file = readdir($handle))) {
    if ($file != "." && $file != "..") {
        if (!is_dir($dir . $file)) {
            $fotky[] = $file;
        }
    }
}
closedir($handle);

sort($fotky);
$celkem_fotek = count($fotky);
$celkem_pages = ($celkem_fotek - ($celkem_fotek % ($on_page))) / ($on_page) + 1;

echo "<h1>Hučka {$_GET["rocnik"]}</h1>";

echo "<ul class='galery_list'>";
foreach ($fotky as $fotka) {
    echo "<li>";
        echo "<div class='galery_wrap'>";
            echo "<a href='./galerie/{$_GET["rocnik"]}/normal/{$fotka}' rel='lightbox'>";
                echo "<div class='galery_text txt_center'></div>";
                echo "<div class='galery_photo'>";
                    echo "<img src='./galerie/{$_GET["rocnik"]}/mini/{$fotka}'>";
                echo "</div>";
            echo "</a>";
        echo "</div>";
    echo "</li>";
}
echo "</ul>";

foot();
