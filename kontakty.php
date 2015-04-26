<?php

require "php.php";
Head("Hučka-Team");

function kontakt($jmeno, $fotka, $pozice, $mobil, $mail) {
    echo "<li>";
    echo "<div class='contact_image'><IMG src='./obr/kontakt/{$fotka}'></div>";
    echo "<div class='contact_details'>";
    echo "<div class='contact_wrap'>";
    echo "<h5>{$jmeno}</h5>";
    echo "{$pozice}<br>";
    echo "Mobil: {$mobil}<br>";
    echo "<script type='text/javascript'>document.write('E-mail: " . substr($mail, 0, 5) . "'+'" . substr($mail, 5) . "');</script><br>";
    echo "</div>";
    echo "</div>";
    echo "</li>";
}

echo "<ul class='contact'>";
kontakt("Tereza Marková - Opi", "opice.jpg", "dramaturg akce", "736262582", "tereza.markova@volny.cz");
kontakt("Kateřina Ženíšková - Išta", "ista.jpg", "", "", "");
kontakt("Aleš Gothard - Harry", "harry.jpg", "koordinátor projektu", "776384928", "A.Gothard(a)seznam.cz");
kontakt("Iva Dadáková - Ifka", "ifka.jpg", "výtvarnice, hospodářka", "777979106", "iva.dadakova(a)centrum.cz");
kontakt("Jaroslav Hutař - Rája", "raja.jpg", "webmaster, technik", "608155034", "rajmund.hutar(a)seznam.cz");
echo "</ul>";

/*
  kontakt("Jiří Vorlíček - Pajda","pajda","projektový manažer","721485185","pajdavorl(a)email.cz");
  kontakt("Klára Žilková - Káfa","kafa","","724711333","kafa4(a)seznam.cz");
  kontakt("Alena Pokorná - Piskoř","piskor","","","");
  kontakt("Vladislav Větrovec - Prófa","profa","","","");
  kontakt("Ivo Běhan - Ivouch","ivouch","","","");
 */
foot();
