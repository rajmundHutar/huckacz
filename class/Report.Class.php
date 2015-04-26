<?php

class Report {

    private static $_messages = array();

    public function __construct() {
        if (isset($_SESSION["report_meassages"]) && !empty($_SESSION["report_meassages"])) {
            self::$_messages = $_SESSION["report_meassages"];
        }
    }

    const OK = "OK";
    const ERROR = "ERROR";
    const NOTICE = "NOTICE";

    public function add($zprava, $typ = "notice") {
        switch ($typ) {
            case "ok":;
            case "OK": $ret_typ = self::OK;
                break;
            case "error":;
            case "err":;
            case "ERROR":;
            case "ERR": $ret_typ = self::ERROR;
                break;
            case "notice":;
            case "NOTICE": $ret_typ = self::NOTICE;
                break;
            default: $ret_typ = self::NOTICE;
                break;
        }

        self::$_messages[] = array(
            "typ" => $ret_typ,
            "message" => $zprava,
            "class" => strtolower($ret_typ),
        );
        $_SESSION["report_meassages"] = self::$_messages;
    }

    public function getReport() {
        foreach (self::$_messages as $msg) {
            echo "<div class='report {$msg["class"]}'>{$msg["typ"]}: {$msg["message"]}</div>";
        }
        $_SESSION["report_meassages"] = array();
        self::$_messages = array();
    }

}
