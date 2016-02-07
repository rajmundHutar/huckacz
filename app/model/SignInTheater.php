<?php

namespace App\Model;

use Nette\Database\Context,
        App\Model\Entities\Theater;

/**
 * Description of SignInTheater
 *
 * @author Raja
 */
class SignInTheater{
    
    protected $db;
    
    const TABLE_THEATERS = "divadla";
    
    public function __construct(Context $db) {
        $this->db = $db;
    }
    
    public function saveTheater(Theater $theater){
        
        $insert = [
            "nazev" => $theater->getName(),
            "lidi" => $theater->getNumber(),
            "mail" => $theater->getEmail(),
            "popis" => $theater->getComment()
        ];
        
        return $this->db->table(self::TABLE_THEATERS)->insert($insert);
    }
}
