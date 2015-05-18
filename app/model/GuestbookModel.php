<?php

namespace App\Model;

use App\Model\Entities\GuestbookComment,
    Nette\Database\Context;

/**
 * Description of GuestbookModel
 *
 * @author Jaroslav
 */
class GuestbookModel {
    
    protected $db;
    
    const TABLE_NAME = "kniha";    

    public function __construct(Context $db) {
        $this->db = $db;
    }
    
    public function addComment(GuestbookComment $comment) {
        $insert = [
            "name" => $comment->getName(),
            "text" => $comment->getText(),
            "date" => $comment->getDate(),
            "ip" => $comment->getIp(),            
        ];
        
        $this->db->table(self::TABLE_NAME)->insert($insert);        
    }
    
    public function fetchAll(){
        $res = $this->db->table(self::TABLE_NAME)->order("date DESC")->fetchAll();
        $result = [];
        foreach($res as $row){
            $comment = new GuestbookComment();
            $comment->setId($row["id"]);
            $comment->setName($row["name"]);
            $comment->setText($row["text"]);
            $comment->setDate($row["date"]);
            
            $result[] = $comment;            
        }
        
        return $result;
    }    
}
