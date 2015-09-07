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
        "2001" => [
            "title" => "",
        ],
        "2003" => [
            "title" => "Titanik",
        ],
        "2004" => [
            "title" => "Dobytí ráje",
        ],
        "2005" => [
            "title" => "Afrika",
        ],
        "2006" => [
            "title" => "Vrchní prchni!",
        ],
        "2007" => [
            "title" => "Hučka ve velkém",
        ],
        "2008" => [
            "title" => "Večerníček",
        ],
        "2009" => [
            "title" => "Možná přijde i kouzelník",
        ],
        "2010" => [
            "title" => "I love hučka",
        ],
        "2011" => [
            "title" => "TeleHučka",
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
        if (is_dir("images/gallery/{$year}/thumbnails/")){
            foreach (Finder::findFiles('*.jpg')->from("images/gallery/{$year}/thumbnails/") as $file) {
                $gallery["images"][] = [
                    "thumbnail" => self::GALLERY_PATH . "/{$year}/thumbnails/" . basename($file),
                    "image" => self::GALLERY_PATH . "/{$year}/images/" . basename($file),
                ];
            }
        }
        return $gallery;
    }
    
    public function getGalleries(){
        return $this->galleries;
    }

}
