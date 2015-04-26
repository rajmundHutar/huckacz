<? require("./php.php");
require("./mysql.php");
Head("Divadlo",True,0,"divadlo");

$chyba_odkazu = false;

if (empty($_GET["typ"])) $_GET["typ"] = "vyber";

function form_user($typ,$id_divadla) {
if ($typ!="hidden"){
?>
<SCRIPT>

function setVlastni(ele){
  if ($(ele).children(":selected").val()=="Vlastní"){
      $("#zanr_vlastni_sp").show();
  }
  else {
      $("#zanr_vlastni").val("");
      $("#zanr_vlastni_sp").hide();
  }
}
function validate(){
    return confirm("Opravdu chceš toto divadlo odstanit?");
}
</SCRIPT>
<?

if ($typ=="upravy"){
    global $user;
    $vypismysql=mysql_query("SELECT * FROM divadla WHERE creator LIKE '".$_SESSION["nick"]."' ".($id_divadla ? "AND id_divadla='".$id_divadla."'" : "")." ;");
    $datamysql=mysql_fetch_array($vypismysql);
}
$nazev = $_POST["nazev"];
$organizace = $_POST["organizace"];
$popis = $_POST["popis"];
$potreby = $_POST["potreby"];
$lidi = $_POST["lidi"];
$mail = $_POST["mail"]; 
$tel = $_POST["tel"]; 
$pristupnost =  $_POST["pristupnost"];
$dopo = $_POST["dopo"];
$otazka1 = $_POST["otazka1"];
$otazka2 = $_POST["otazka2"];
$zanr = $_POST["zanr"];
$zanr_vlastni = $_POST["zanr_vlastni"];


echo ('<FORM action="prihlaseni.php" method="post">');
echo ('<TABLE width="100%" cellspacing="0" cellpadding="0" border="0" align="center">');

echo ('<TR>
        <TD style="width:200px"><b>Název uskupení:</b></TD>
        <TD valign="bottom"><INPUT id="organizace" type="text" name="organizace" value="'.(!$datamysql["organizace"] ? $organizace : $datamysql["organizace"]).'" maxlength="20" autocomplete="off"></TD>
            <TD class="min">nebo název skupiny</TD>
    </TR>');
/*echo ('<TR>
        <TD style="width:200px"><b>Dopolední/odpolení program:</b></TD>
        <TD valign="bottom" style="font-size:8pt">
        <input type="radio" name="dopo" value="1" '.(!$datamysql["dopo"] ? ($dopo==1 ? "checked" : "") : ($datamysql["dopo"]==1 ? "checked" : "")).'>Odpoledne filmových hvězd <br>
        <input type="radio" name="dopo" value="2" '.(!$datamysql["dopo"] ? ($dopo==2 ? "checked" : "") : ($datamysql["dopo"]==2 ? "checked" : "")).'>Ze života celebrit i Odpoledne filmových hvězd
        </TD>
            <TD class="min">vyberte si</TD>
    </TR>');*/
/*echo ('<TR>
        <TD style="width:200px"><b>Žánr:</b></TD>
        <TD valign="bottom" style="font-size:8pt">
        <SELECT id="zanr" name="zanr" onChange="setVlastni(this)">
            <OPTION value="">---</OPTION>
            <OPTION value="Televizní noviny" '.(!$datamysql["zanr"]?($zanr=="Televizní noviny"?"selected":""):($datamysql["zanr"]=="Televizní noviny"?"selected":"")).'>Televizní noviny</OPTION>
            <OPTION value="Pohádka"'.(!$datamysql["zanr"]?($zanr=="Pohádka"?"selected":""):($datamysql["zanr"]=="Pohádka"?"selected":"")).'>Pohádka</OPTION>
            <OPTION value="Film pro dospělé"'.(!$datamysql["zanr"]?($zanr=="Film pro dospělé"?"selected":""):($datamysql["zanr"]=="Film pro dospělé"?"selected":"")).'>Film pro dospělé</OPTION>
            <OPTION value="Dokument"'.(!$datamysql["zanr"]?($zanr=="Dokument"?"selected":""):($datamysql["zanr"]=="Dokument"?"selected":"")).'>Dokument</OPTION>
            <OPTION value="Hudební hitparáda"'.(!$datamysql["zanr"]?($zanr=="Hudební hitparáda"?"selected":""):($datamysql["zanr"]=="Hudební hitparáda"?"selected":"")).'>Hudební hitparáda</OPTION>
            <OPTION value="Československo má talent"'.(!$datamysql["zanr"]?($zanr=="Československo má talent"?"selected":""):($datamysql["zanr"]=="Československo má talent"?"selected":"")).'>Československo má talent</OPTION>
            <OPTION value="Stardance"'.(!$datamysql["zanr"]?($zanr=="Stardance"?"selected":""):($datamysql["zanr"]=="Stardance"?"selected":"")).'>Stardance</OPTION>
            <OPTION value="MTV"'.(!$datamysql["zanr"]?($zanr=="MTV"?"selected":""):($datamysql["zanr"]=="MTV"?"selected":"")).'>MTV</OPTION>
            <OPTION value="Doremi"'.(!$datamysql["zanr"]?($zanr=="Doremi"?"selected":""):($datamysql["zanr"]=="Doremi"?"selected":"")).'>Doremi</OPTION>
            <OPTION value="Reklamy (blok i jednotlivě)"'.(!$datamysql["zanr"]?($zanr=="Reklamy (blok i jednotlivě)"?"selected":""):($datamysql["zanr"]=="Reklamy (blok i jednotlivě)"?"selected":"")).'>Reklamy (blok i jednotlivě)</OPTION>
            <OPTION value="Seriál nebo telenovela"'.(!$datamysql["zanr"]?($zanr=="Seriál nebo telenovela"?"selected":""):($datamysql["zanr"]=="Seriál nebo telenovela"?"selected":"")).'>Seriál nebo telenovela</OPTION>
            <OPTION value="Vlastní"'.(!$datamysql["zanr"]?($zanr=="Vlastní"?"selected":""):($datamysql["zanr"]=="Vlastní"?"selected":"")).'>Vlastní</OPTION>
        </SELECT><br>
        <SPAN id="zanr_vlastni_sp">Jaký: <INPUT id="zanr_vlastni" type="text" name="zanr_vlastni" maxlength="20" value="'.($datamysql["zanr_vlastni"]=="" ? $zanr_vlastni : $datamysql["zanr_vlastni"]).'"></SPAN>
        <SCRIPT>
        $("#zanr_vlastni_sp").'.($datamysql["zanr_vlastni"]!="" || $zanr_vlastni!="" ? "show()" : "hide()").';
        </SCRIPT>
        </TD>
            <TD class="min">vyberte si</TD>
    </TR>'); */
echo ('<TR>
        <TD><b>Název divadla:</b></TD>
        <TD><INPUT id="nazev" type="text" name="nazev" maxlength="20" value="'.(!$datamysql["nazev"] ? $nazev : $datamysql["nazev"]).'" autocomplete="off"></TD>
        <TD class="min"></TD>
    </TR>');
/*echo ('<TR>
        <TD><b>Přístupnost:</b></TD>
        <TD valign="bottom" style="font-size:8pt">
        <input type="radio" name="pristupnost" value="1" '.(!$datamysql["pristupnost"] ? ($pristupnost==1 ? "checked" : "") : ($datamysql["pristupnost"]==1 ? "checked" : "")).'>Bez hvězdičky<br>
        <input type="radio" name="pristupnost" value="2" '.(!$datamysql["pristupnost"] ? ($pristupnost==2 ? "checked" : "") : ($datamysql["pristupnost"]==2 ? "checked" : "")).'>S hvězdičkou
        </TD>
            <TD class="min">Bez hvězdičky = mladší kategorie<br>S hvězdičkou = starší kategorie</TD>
    </TR>');*/
echo ('<TR>
        <TD><b>Počet lidí:</b></TD>
        <TD><INPUT type="text" name="lidi" maxlength="5" style="width:30px" value="'.(!$datamysql["lidi"] ? $lidi : $datamysql["lidi"]).'" autocomplete="off"> </TD>
        <TD class="min">kolik vás je</TD>
    </TR>');
echo ('<TR>
        <TD><b>Rekvizity:</b></TD>
        <TD><TEXTAREA cols="25" rows="3" type="text" name="potreby" maxlength="20" autocomplete="off">'.(!$datamysql["potreby"] ? $potreby : $datamysql["potreby"]).'</TEXTAREA></TD>
        <TD class="min">co byte rádi měli připraveno</TD>
    </TR>');
echo ('<TR>
        <TD><b>Kontakt - e-mail:</b></TD>
        <TD>
        <INPUT id="mail" type="text" name="mail" value="'.(!$datamysql["mail"] ? $mail : $datamysql["mail"]).'" maxlength="20">
        </TD>
        <TD class="min"></TD>
    </TR>');
echo ('<TR>
        <TD>Kontakt - telefon:</TD>
        <TD>
        <INPUT id="tel" type="text" name="tel" value="'.(!$datamysql["tel"] ? $tel : $datamysql["tel"]).'" maxlength="20">
        </TD>
        <TD class="min"></TD>
    </TR>');
/*echo ('<TR>
        <TD style="width:300px">Komu byste poděkovali, kdybyste dostali Oskara?</TD>
        <TD><TEXTAREA id="otazka1" cols="25" rows="3" type="text" name="otazka1" autocomplete="off">'.(!$datamysql["otazka1"] ? $otazka1 : $datamysql["otazka1"]).'</TEXTAREA></TD>
        <TD class="min"></TD>
    </TR>');
echo ('<TR>
        <TD style="width:300px">Jak jste přispěli ke světovému míru, když jste se na tuto akci přihlásili?</TD>
        <TD><TEXTAREA id="otazka2" cols="25" rows="3" type="text" name="otazka2" autocomplete="off">'.(!$datamysql["otazka2"] ? $otazka2 : $datamysql["otazka2"]).'</TEXTAREA></TD>
        <TD class="min"></TD>
    </TR>');  */
echo ('<TR>
        <TD>Poznámka:</TD>
        <TD><TEXTAREA id="popis" cols="25" rows="3" type="text" name="popis" autocomplete="off">'.(!$datamysql["popis"] ? $popis : $datamysql["popis"]).'</TEXTAREA></TD>
        <TD class="min">cokoliv co se jinam nevešlo</TD>
    </TR>');

echo "<TR><TD colspan='3'><center><b>Tučné položky jsou poviné</b></center></TD>";
if ($typ=="registrace"){
    echo "<TR><TD colspan='3'><hr width='50%'></TD>";
    echo "<TR>
              <TD colspan='3'><input type='hidden' name='send_reg' value='true'><input type='submit' value='Registrovat'></TD>
          </TR>";}
elseif ($typ=="upravy"){
    echo "<TR><TD colspan='3'><hr width='50%'></TD>";
    echo "<TR><TD colspan='3'>
    <input type='hidden' name='send_uprav' value='true'>
    <input type='hidden' name='id_divadla' value='".$datamysql["id_divadla"]."'>
    <input type='submit' value='Upravit'>
    </TD>
    </TR>";}
echo "</TABLE>";  
echo "</FORM>"; 
if ($typ=="upravy"){
    echo ('<FORM action="prihlaseni.php" method="post" onsubmit="return validate()">');
    echo ('<input type="hidden" name="send_delete" value="true">
    <input type="hidden" name="id_divadla" value="'.$datamysql["id_divadla"].'">
    <input type="submit" value="Odstranit">');
    echo "</FORM>"; 
}
}
};
//KONEC formuláře a začátek zpracování odeslání
if (empty($send_reg)) {$send_reg=0;}
if (empty($send_heslo)) {$send_heslo=0;}
if (empty($send_uprav)) {$send_uprav=0;}
if (empty($send_delete)) {$send_delete=0;}
//od kdy se ma script povolit
//if (1289084400<Time() || $_SERVER["HTTP_HOST"]=="beta.hucka.cz"|| $_SERVER["HTTP_HOST"]=="localhost" || $_SESSION["nick"]=="Rajmund"){
if ($_GET["typ"]=="prihlaseni"){
    echo('<H2>Prihlaš svoje divadleni vystoupeni</H2>');
    //if (empty($_SESSION["nick"])) echo ('<SPAN class="poznamka">Nejsi přihlášen. Tvoje přihlášení se odešle ale nebudeš ho moci upravovat, pokud se přihlásíš (registruješ) budeš mít i tuto možnost.</SPAN>');
    form_user("registrace",false);
    //echo('<A href="user_divadlo.php?typ=vyber"><H3>Zpět</H3></A>'); 
}
elseif ($_GET["typ"]=="upravy"){
    if (!empty($_SESSION["nick"])){
        echo('<H2>Tady můžeš upravit svoje divadlo.</H2>');
        form_user("upravy",$_GET["id_divadla"]);
        echo ('<a href="prihlaseni.php?typ=prihlaseni">Přihlásit další skupinu</a>');
        //echo('<A href="prihlaseni.php?typ=vyber"><H3>Zpět</H3></A>'); 
    }
    else {
        $chyba_odkazu = true;
    }
}
else if($_GET["typ"]=="upravy_vice"){
    if (!empty($_SESSION["nick"])){
        $vypisdivadla=mysql_query("SELECT * FROM divadla WHERE creator LIKE '".$_SESSION["nick"]."';");
        echo "Zatím jsi přihlásil skupiny:<br><UL>";
        while($datadivadla = MySQL_Fetch_array($vypisdivadla)){
            echo ('<li><a href="prihlaseni.php?typ=upravy&id_divadla='.$datadivadla["id_divadla"].'">'.$datadivadla["nazev"].'</a></li>');
        }
        echo ('</UL>');
        echo ('<a href="prihlaseni.php?typ=prihlaseni">Přihlásit další skupinu</a>');
    }
    else {
        $chyba_odkazu = true;
    }
}
else if ($send_reg && $nazev!="" && $organizace!="" && $lidi!="" && $potreby!="" && $mail!=""){
    // registrace... pridani do databaze 
    $vypisdivadla=mysql_query("SELECT * FROM divadla WHERE nazev LIKE '".$nazev."' AND organizace LIKE '".$organizace."';");
    $p = mysql_num_rows($vypisdivadla);
    if ($p == 0){
        
        if(empty($otazka1)) $otazka1 = "";
        if(empty($otazka2)) $otazka2 = "";
        if(empty($otazka3)) $otazka3 = "";
        
        if(empty($_SESSION["nick"])) $_SESSION["nick"] = "";
        /*
        echo ('nazev: '.$nazev."<br>");
        echo ('org: '.$organizace."<br>");
        echo ('dopo: '.$dopo."<br>");
       	echo ('pris: '.$pristupnost."<br>");
        echo ('lidi: '.$lidi."<br>");
       	echo ('potreby: '.$potreby."<br>");
        echo ('mail: '.$mail."<br>");
        
        echo ('tel: '.$tel."<br>");
        echo ('ot1: '.$otazka1."<br>");
        echo ('ot2: '.$otazka2."<br>");
        echo ('ot3: '.$otazka3."<br>");
        echo ('popis: '.$popis."<br>");
        echo ('nick: '.$_SESSION["nick"]."<br>");
        */
        mysql_query("INSERT INTO divadla (nazev,organizace,dopo,pristupnost,lidi,potreby,tel,mail,otazka1,otazka2,otazka3,popis,creator,zanr,zanr_vlastni) VALUES (
                '".mysql_real_escape_string($nazev)."',
                '".mysql_real_escape_string($organizace)."',
                '".($dopo ? 1 : 0)."',
    	         	'".($pristupnost ? 1 : 0)."',
    		        '".$lidi."',
    	         	'".mysql_real_escape_string($potreby)."',
                '".mysql_real_escape_string($tel)."',
                '".mysql_real_escape_string($mail)."',
                '".mysql_real_escape_string($otazka1)."',
                '".mysql_real_escape_string($otazka2)."',
                '".mysql_real_escape_string($otazka3)."',
                '".mysql_real_escape_string($popis)."',
    		        '".$_SESSION["nick"]."',
    		        '".($zanr ? $zanr : 0)."',
    		        '".mysql_real_escape_string($zanr_vlastni)."'
                ) ;");  
        echo mysql_error();
        echo "<H1 align='center'>Divadlo ".$nazev." bylo přidáno.<br>Těšíme se na vás!</H1>";
        echo ('<script type="text/javascript">
        //casovac = window.setTimeout("window.location = \'./privitani.php\'", 2000);
        </script>');
        //echo('<A href="prihlaseni.php?typ=vyber"><H3>Zpět</H3></A>');
    }
    else {echo "<H1 align='center'>Divadlo s tímto názvem již existuje.</H1><br>";
        form_user("registrace",false);
    }
}
elseif ($send_uprav && $nazev!="" && $organizace!="" && $dopo!="" && $pristupnost!="" && $lidi!="" && $potreby!="" && $mail!="" && $zanr!=""){
    //aktualizace dat v databazi
    Mysql_query("UPDATE divadla SET
          nazev='".mysql_real_escape_string($nazev)."',
          organizace='".mysql_real_escape_string($organizace)."',
          lidi='".$lidi."',
          potreby='".mysql_real_escape_string($potreby)."',
          tel='".mysql_real_escape_string($tel)."',
          mail='".mysql_real_escape_string($mail)."',
          otazka1='".mysql_real_escape_string($otazka1)."',
          otazka2='".mysql_real_escape_string($otazka2)."',
          otazka3='".mysql_real_escape_string($otazka3)."',
          popis='".mysql_real_escape_string($popis)."',
          creator='".$_SESSION["nick"]."'
        WHERE id_divadla=".$_POST["id_divadla"]."  ;");
    echo "<H1 align='center'>Vaše divadlo bylo aktualizováno.</H1>";
    echo ('<script type="text/javascript">
        //casovac = window.setTimeout("window.location = \'./privitani.php\'", 2000);
        </script>');
    //echo('<A href="user_divadlo.php?typ=vyber"><H3>Zpět</H3></A>');
}
elseif ($send_reg){
    //chybne zadani udaju pri registraci
    echo ('<H1 align="center">Zadané údaje pro divadlo nejsou úplné</H1>');
    form_user("registrace",false);
}
elseif ($send_uprav){
    //zadane udaje jsou zadany spatne
    echo "<H1 align='center'>Nebyly vyplněny povinné údaje.</H1>";
    form_user("upravy",$_POST["id_divadla"]);
}
elseif ($send_delete){
    //zadane udaje jsou zadany spatne
    echo "<H1 align='center'>Divadlo smazáno.</H1>";
    echo ('id_divadla: '.$_POST["id_divadla"].'<br>');
    echo ('nick: '.$_SESSION["nick"]);        
    mysql_query("DELETE FROM divadla WHERE creator LIKE '".$_SESSION["nick"]."' AND id_divadla='".$_POST["id_divadla"]."';");
    echo ('<script type="text/javascript">
        //casovac = window.setTimeout("window.location = \'./privitani.php\'", 2000);
        </script>');
}
else {
    $chyba_odkazu = true;
}

if ($chyba_odkazu){
    if (!empty($_SESSION["nick"])) {
        $vypisdivadla=mysql_query("SELECT * FROM divadla WHERE creator LIKE '".$_SESSION["nick"]."';");
        $p = mysql_num_rows($vypisdivadla);
        $datadivadla = MySQL_Fetch_array($vypisdivadla);
    }
    else $p = 0;
    //"./prihlaseni.php?typ=".($p>0 ? ($p==1 ? "upravy&id_divadla=".$datadivadla["id_divadla"] : "upravy_vice") : "prihlaseni");
    echo ('Jejda nastala chyba zkus přejít
    <a href="./prihlaseni.php?typ='.($p>0 ? ($p==1 ? "upravy&id_divadla=".$datadivadla["id_divadla"] : "upravy_vice") : "prihlaseni").'">SEM</a>');
}
    
/*}
else {echo ('<TABLE align="center" width="500" border="0"><TR><TD><H3>Do začátku přihlašování zbývá:</H3></TD></TR>
<TR><TD align="center"><DIV id="countdown"></DIV>
<script language="javascript" type="text/javascript">
timer=window.setInterval("countdown(1288566000)" , 100);
</script>
</TD></TR></TABLE>');
} */
?>
<? Foot(True); ?>
