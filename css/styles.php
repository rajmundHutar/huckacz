<?php
require "../php.php";

header("Content-type: text/css", true);

$less = new lessc;
echo $less->compileFile("./styles.less");
