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
        foreach(Finder::findFiles('*.jpg', '*.JPG')->from("images/gallery/") as $file){
            $allFiles[] = $file;
        }
        shuffle($allFiles);

        if (count($allFiles) <= $count) {
            return $allFiles;
        }

        $years = $this->galleryModel->getYears();
        $result = [];
        while(count($result) < $count){
            $file = array_pop($allFiles);
            if (strpos($file, "thumbnails") !== false){
                preg_match('~gallery/(\d{4})/~', $file, $m);
                $theme = $years[$m[1]]["title"] ?? "";
                $result[] = (new GalleryItem())
                        ->setThumbnail("/" . $file)
                        ->setImage("/" . str_replace("thumbnails", "images", $file))
                        ->setTitle("Hučka {$m[1]}" . ($theme !== "" ? " – {$theme}" : ""));
            }
        }
        return $result;
    }
}
