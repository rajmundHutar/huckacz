<?php

namespace App\Model;

use Nette\Utils\Finder;

/**
 * Description of GalleryModel
 *
 * @author Jaroslav
 */
class GalleryModel {

    protected $galleries = [
        "1999" => [
            "title" => "První Hučka",
        ],
        "2000" => [
            "title" => "",
        ],
        "2012" => [
            "title" => "Tuctová Hučka",
        ],
        "2014" => [
            "title" => "Hučka jako banán",
        ],
    ];

    const GALLERY_PATH = "/images/gallery";

    public function fetchGallery($year) {
        if (!isset($this->galleries[$year])) {
            throw new Exception("Galerie nenalezena", 404);
        }
        $gallery = $this->galleries[$year];
        $gallery["year"] = $year;
        $gallery["images"] = [];
        foreach (Finder::findFiles('*.jpg')->from("images/gallery/{$year}/thumbnails/") as $file) {
            $gallery["images"][] = [
                "thumbnail" => self::GALLERY_PATH . "/{$year}/thumbnails/" . basename($file),
                "image" => self::GALLERY_PATH . "/{$year}/images/" . basename($file),
            ];
        }
        return $gallery;
    }
    
    public function getGalleries(){
        return $this->galleries;
    }

}
