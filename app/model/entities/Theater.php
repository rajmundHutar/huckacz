<?php

namespace App\Model\Entities;
/**
 * Description of Theater
 *
 * @author Raja
 */
class Theater {
    protected $name;
    protected $email;
    protected $number;
    protected $comment;

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getNumber() {
        return $this->number;
    }

    function getComment() {
        return $this->comment;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }


}
