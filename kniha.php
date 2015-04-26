<?php

require "php.php";
head("Návštěvní kniha");

$Report->getReport();

function Smajlici($zprava) {
    $zprava = htmlspecialchars($zprava);
    $zprava = nl2br($zprava);

    $smajliku = 64;
    for ($i = 0; $i <= $smajliku; $i++) {
        $kod = "*" . $i . "*";
        $nahrada = "<img src=\"./obr/smajlici/" . $i . ".gif\" border=\"0\" alt=\"*" . $i . "*\">";
        $zprava = str_replace($kod, $nahrada, $zprava);
    }

    return $zprava;
}

if (isset($_POST["save"])) {
    //SECURITY
    if ($_POST["security_java"] != "čtverka" || $_POST["security_hidden"] != "" || Time() - $_POST["security_time"] <= 2){
        $Report->add("Vypadá to, že jsi robot. Pokud nejsi, zkus přidat příspěvek ještě jednou.","err");
        header("Location: kniha.php");
        exit;
    }
    if ($_POST["text"] != "" && $_POST["name"] != "") {
        $sql = "INSERT INTO `kniha` (`date`, `name`, `email`, `text`) VALUES (
            '" . Date("Y-m-d H:i:s") . "',
            '" . db_real($_POST["name"]) . "',
            '" . db_real($_POST["mail"]) . "',
            '" . db_real($_POST["text"]) . "')";
        $res = db_query($sql);
        if ($res){
            $Report->add("Příspěvek úspěšně přidán","ok");
        } else {
            $Report->add("Chyba při přidávání příspěvku. Zkus to znovu.", "err");
        }
        header("Location: kniha.php");
        exit;        
    } else if ($_POST["text"] == "" || $_POST["name"] == "") {
        $Report->add("Je potřeba vyplnit pole jméno a text příspěvku", "err");
        header("Location: kniha.php");
        exit;
    }
}

echo "<form action='kniha.php' method='post'>";
    echo "<table class='guestbook_form'>";
        echo "<tr>";
            echo "<td>Jméno:</td>";
            echo "<td><input type='text' value='' name='name'></td>";
            echo "<td rowspan='3' class='smailici'>";
                echo "<table>";
                    $smajliku1 = 24;
                    for ($i = 1; $i <= $smajliku1; $i += 6) {
                        echo "<tr>";
                        for ($k = 0; $k <= 5; $k++) {
                            $cis = $k + $i;
                            echo "<td><img src='./obr/smajlici/{$cis}.gif' alt='*{$cis}*' class='add_smailik'></td>";
                        }
                        echo "</tr>";
                    }
                echo "</table>";
            echo "</td>";
        echo "</tr><tr>";
            echo "<td>e-mail:</td>";
            echo "<td><input type='text' value='' name='mail'></td>";
        echo "</tr><tr>";
            echo "<td colspan='2'><textarea name='text' id='form_text'></textarea>";
                //ANTISPAM
                echo "<input type='text' value='' name='security_hidden' class='security_hidden'>";
                echo "<input type='hidden' name='security_time' value='" . Time() . "'>";
                //ANTISPAM
                echo "<input type='submit' name='save' value='Přidat'>";
            echo "</td>";
        echo "</tr>";
    echo "</table>";
echo "</form>";
    ?>
    <script language="javascript" type="text/javascript">
        /*function potvrzeni() {
            form_jmeno = document.getElementById("form_jmeno").value;
            form_text = document.getElementById("form_text").value;
            if (form_jmeno == "") {
                alert("Nevyplnil jsi jméno!");
                return !(window.event && window.event.keyCode == 13);
            }
            else {
                if (form_text == "") {
                    alert("Nevyplnil jsi text příspěvku!");
                    return !(window.event && window.event.keyCode == 13);
                }
                else
                    document.getElementById("form_guestbook").submit();
            }
        }
        function pridejsm(smail)
        {
            document.getElementById("form_text").value += smail;
            //alert(smail);
        }

        function zobrazSkryj(objekt) {
            document.getElementById(objekt).style.display = (document.getElementById(objekt).style.display == 'block') ? 'none' : 'block';
        }
        function enter(bool) {
            if (window.event && window.event.keyCode == 13)
                return potvrzeni();

        }*/
        $(function(){
            $("textarea#form_text").after("<input type='hidden' name='security_java' value='" + "čtve" + "rka" + "'>");
            $("img.add_smailik").click(function(){
                var text = $(this).attr("alt");
                $("textarea#form_text").append(text);                
            });
        });
    </script>
    <?php



//Pocet stranek
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 0;
echo "<div class='guestbook_navigation'>";
    //Pocet stranek
    $na_stranku = 10;
    $pocet_celkem = db_query_one_value("SELECT MAX(`id`) FROM kniha");
    $dolni_mez = $page * $na_stranku;
    if ($pocet_celkem - $dolni_mez > $na_stranku){
        echo "<a href='kniha.php?page=" . ($page + 1) . "'>Starší</A> | ";
    }
    $horni_mez = $pocet_celkem - $dolni_mez - $na_stranku + 1;
    echo max($horni_mez, 0) . ' - ' . ($pocet_celkem - $dolni_mez);
    if ($pocet_celkem - $dolni_mez + $na_stranku <= $pocet_celkem){
        echo " | <a href='kniha.php?page=" . ($page - 1) . "'>Novější</a>";
    }
echo "</div>";




//vypis prispevku
echo "<table class='book'>";
$sql = "SELECT * FROM `kniha` ORDER BY `date` DESC LIMIT " . intval($dolni_mez) . ", " . intval($na_stranku);
$res = db_query($sql);
while ($row = db_fetch_assoc($res)) {
    echo "<tr>";
        echo "<td rowspan='2' class='book_num'>{$row["id"]}</td>";
        echo "<td class='book_name'>{$row["name"]}</td>";
        echo "<td class='book_ip'>{$row["date"]}</td>";
    echo "</tr><tr>";
        echo "<td colspan='2' class='book_text'>" . smajlici($row["text"]) . "</td>";
    echo "</tr><tr>";
        echo "<td colspan='3'><hr width='90%'></td>";
    echo "</tr>";
}
echo "</table>";

foot();
