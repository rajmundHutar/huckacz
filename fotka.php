<?require("./php.php");
Head("Galerie",False,0,"fotogalerie");
$radky=4;
$sloupce=6;
$adresar=dir("./galerie/".$rocnik."/mini");
while ($polozka=$adresar->read()) if (strpos(strtolower($polozka),".jpg")) $fotky[]=$polozka;
sort($fotky);
$celkem_fotek=count($fotky);
$celkem_pages=($celkem_fotek-($celkem_fotek%($radky*$sloupce)))/($radky*$sloupce)+1;
echo ('<script language="javascript" type="text/javascript">
function odkryj(){
document.getElementById("fotka").style.height=vyska;
document.getElementById("fotka").style.visibility="visible";
document.getElementById("loading").style.visibility="hidden";
};
var vyska=document.body.offsetHeight-100;
var sirka=document.body.offsetWidth;
var pozleft=Math.round((sirka/2)+90);
var pozright=Math.round((vyska/2)+120);  
  document.write("<style>");
  document.write(".fotka {height:"+vyska+"px;visible:hidden;}");
  document.write(".loading {position:absolute;top:"+pozright+"px; left:"+pozleft+"px;}");
  document.write("</style>");

</script>');
echo "<!--VLASTNÍ TEXT STRÁNKY-->";
echo "<table cellpadding='0' cellspacing='0'  border='0' width='97%'>\n";
//vlastni telo tabulky;
echo("<TR><td rowspan='2' width='50'>");
if ($fotka!=0) echo ('<a href="fotka.php'.$promenne.'?rocnik='.$rocnik.'&fotka='.($fotka-1).'#fotka"><img src="./obr/ikony/left.png" OnMouseOver="this.src=\'./obr/ikony/left_over.png\'" OnMouseOut="this.src=\'./obr/ikony/left.png\'" border="0"></a>');
//hlavni fotka
echo ("</td><td width='800px' height='480px' align=\"center\" valign=\"middle\" colspan='5'>\n");
if ($fotky[$fotka+1]) echo ("<a name='fotka' href=\"./fotka.php".$promenne."?rocnik=".$rocnik."&fotka=".($fotka+1)."#fotka\">");
else echo ("<a name='fotka' href=\"./fotky.php".$promenne."?rocnik=".$rocnik."&page=".((int)($fotka/($sloupce*$radky)+1))."\">");
echo ('<img src="./galerie/'.$rocnik.'/normal/'.$fotky[$fotka].'" border="0" id="fotka" class="fotka" onload="odkryj()"></a>');
//nacitaci logo
echo ('<img src="./obr/ikony/loading.gif" id="loading" class="loading" border="0">');
echo("</td><td rowspan='2' width='50'>");
//konec hlavni fotka
if (($fotka+1)!=$celkem_fotek) echo ('<a href="fotka.php'.$promenne.'?rocnik='.$rocnik.'&fotka='.($fotka+1).'#fotka"><img src="./obr/ikony/right.png" OnMouseOver="this.src=\'./obr/ikony/right_over.png\'" OnMouseOut="this.src=\'./obr/ikony/right.png\'" border="0"></a>');
echo "</td></tr>\n";

echo "<TR height=\"100\">";
if ($fotky[$fotka-2]) echo ("<TD align='center' valign='middle' width='100px'><a href=\"./fotka.php".$promenne."?rocnik=".$rocnik."&fotka=".($fotka-2)."#fotka\"><img src=\"./galerie/".$rocnik."/mini/".$fotky[$fotka-2]."\" border=\"0\" height=\"75\"></a></td>");
else echo "<TD align='center' valign='middle' width='100px'></td>";
if ($fotky[$fotka-1]) echo ("<TD align='center' valign='middle' width='100px'><a href=\"./fotka.php".$promenne."?rocnik=".$rocnik."&fotka=".($fotka-1)."#fotka\"><img src=\"./galerie/".$rocnik."/mini/".$fotky[$fotka-1]."\" border=\"0\" height=\"75\"></a></td>");
else echo "<TD align='center' valign='middle' width='100px'></td>";

echo ('<TD align="center" valign="middle" width="100">('.($fotka+1).'/'.$celkem_fotek.')<BR><a href="fotky.php'.$promenne.'?rocnik='.$rocnik.'"><img src="./obr/ikony/up.png" border=\"0\" OnMouseOver="this.src=\'./obr/ikony/up_over.png\'" OnMouseOut="this.src=\'./obr/ikony/up.png\'"></a>
</a></td>');


if ($fotky[$fotka+1]) echo ("<TD align='center' valign='center' width='100px'><a href=\"./fotka.php".$promenne."?rocnik=".$rocnik."&fotka=".($fotka+1)."#fotka\"><img src=\"./galerie/".$rocnik."/mini/".$fotky[$fotka+1]."\" border=\"0\" height=\"75\"></a></td>");
else echo "<TD align='center' valign='center' width='100px'></td>";
if ($fotky[$fotka+2]) echo ("<TD align='center' valign='center' width='100px'><a href=\"./fotka.php".$promenne."?rocnik=".$rocnik."&fotka=".($fotka+2)."#fotka\"><img src=\"./galerie/".$rocnik."/mini/".$fotky[$fotka+2]."\" border=\"0\" height=\"75\"></a></td>");
else echo "<TD align='center' valign='center' width='100px'></td>";
echo "</table>\n";
?>
<!--VLASTNÍ TEXT STRÁNKY KONEC-->
<?foot(False)?>