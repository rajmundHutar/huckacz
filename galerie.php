<?php
require "php.php";
head("Galerie");

$galeries = array(2011, 2009, 2008, 2007, 2006, 2005, 2004, 2003, 2000, 1999);
echo "<ul class='galery_list'>";
foreach($galeries as $year){
    echo "<li>";
        echo "<div class='galery_wrap'>";
            echo "<a href='fotky.php?rocnik=" . $year . "'>";
                echo "<div class='galery_text txt_center'>Hučka " . $year . "</div>";
                echo "<div class='galery_photo'>";
                    echo "<img src='./galerie/" . $year . "/mini/001_rok" . $year . ".jpg'>";
                echo "</div>";
            echo "</a>";
        echo "</div>";
    echo "</li>";
}
echo "</ul>";

echo "<div class='clear'></div>";

foot();
