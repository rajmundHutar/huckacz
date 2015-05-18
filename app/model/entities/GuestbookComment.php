<?php

namespace App\Model\Entities;

/**
 * Description of GuestbookComment
 *
 * @author Jaroslav
 */
class GuestbookComment {
    protected $id;
    protected $name;
    protected $text;
    protected $ip;
    protected $date;    
            
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getText() {
        return $this->text;
    }

    function getIp() {
        return $this->ip;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setText($text) {
        $this->text = $text;
        return $this;
    }

    function setIp($ip) {
        $this->ip = $ip;
        return $this;
    }

    function setDate($date) {
        $this->date = $date;
        return $this;
    }


}
