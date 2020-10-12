<?php

namespace App\Model;

use App\Model\GalleryModel,
    App\Model\Entities\GalleryItem,
    Nette\Utils\Finder,
    Nette\Utils\Image;

/**
 * Description of GallerySnapshotModel
 *
 * @author Jaroslav
 */
class GallerySnapshotModel {
    
    protected $galleryModel;    
    
    public function __construct(GalleryModel $galleryModel) {
        $this->galleryModel = $galleryModel;
    }
    
    public function fetch($count) {
        
        $allFiles = [];
        foreach(Finder::findFiles('*.jpg')->from("images/gallery/") as $file){
            $allFiles[] = $file;
        }
        shuffle($allFiles);

        if (count($allFiles) <= $count) {
            return $allFiles;
        }

        $result = [];
        while(count($result) < $count){
            $file = array_pop($allFiles);
            if (strpos($file, "thumbnails") !== false){
                $result[] = (new GalleryItem())
                        ->setThumbnail("/" . $file)
                        ->setImage("/" . str_replace("thumbnails", "images", $file))
                        ->setTitle("");
            }
        }     
        return $result;
    }
}
