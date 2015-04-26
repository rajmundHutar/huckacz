<?php

if ($_SERVER["SERVER_NAME"] == "beta.hucka.cz" || $_SERVER["SERVER_NAME"] == "www.hucka.cz" || $_SERVER["SERVER_NAME"] == "hucka.cz") {
    $se = "mysql";
    $us = "db.hucka.cz";
    $pa = "since1999";
    $db = "db_hucka_cz";
} else {
    $se = "127.0.0.1";
    $us = "root";
    $pa = "";
    $db = "hucka_cz";
}

$GLOBALS["mysqli"] = new mysqli($se, $us, $pa, $db);

if ($GLOBALS["mysqli"]->connect_errno) {
    var_dump("Failed to connect to MySQL: (" . $GLOBALS["mysqli"]->connect_errno . ") " . $GLOBALS["mysqli"]->connect_error);
    exit;
}
db_query("SET NAMES 'utf8'");
db_query("SET CHARACTER SET utf8");

function db_query_one_value($sql) {
    $sql_res = db_query($sql);
    if ($sql_res) {
        $sql_vys = db_fetch_array($sql_res);
        return $sql_vys[0];
    } else {
        return false;
    }
}

function db_query($sql) {
    $res = $GLOBALS["mysqli"]->query($sql);
    if ($GLOBALS["mysqli"]->error) {
        echo "<table>";
        echo "<tr><td>error: " . $GLOBALS["mysqli"]->error . "<br>In query: " . $sql . "</td></tr>";
        foreach (debug_backtrace() as $file) {
            echo "<tr><td>In file: <b>" . $file["file"] . "</b>, in function: " . $file["function"] . ", on line: " . $file["line"] . "</td></tr>";
        }
        echo "</table>";
        exit;
    }
    return $res;
}

function db_fetch_assoc($resource) {
    return $resource->fetch_assoc();
}

function db_fetch_row($resource) {
    return $resource->fetch_row();
}

function db_fetch_array($resource) {
    return $resource->fetch_array();
}

function db_num_rows($resource) {
    return $resource->num_rows;
}

function db_real($var) {
    return mysqli_real_escape_string($GLOBALS["mysqli"], $var);
}

function db_query_one_col($sql) {
    $res = db_query($sql);
    $return = array();
    while ($row = db_fetch_array($res)) {
        $return[] = $row[0];
    }
    return $return;
}

function db_next_autoindex($table) {
    $res = db_query("SHOW TABLE STATUS LIKE '{$table}'");
    $row = db_fetch_assoc($res);
    return $row["Auto_increment"];
}
