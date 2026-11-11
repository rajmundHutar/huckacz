<?php

namespace App\Model;

use Nette\Utils\Finder;

/**
 * Festival years and their photo galleries.
 *
 * @author Jaroslav
 */
class GalleryModel {

    /** Festival theme per year, newest first */
    protected $years = [
        2017 => "Rytířská Hučka",
        2016 => "Hučka vesmírná",
        2015 => "Hučka půlmaraton",
        2014 => "Hučka jako banán",
        2012 => "Tuctová Hučka",
        2011 => "TeleHučka",
        2010 => "I ♥ Hučka",
        2009 => "Možná přijde i kouzelník",
        2008 => "Večerníček",
        2007 => "Hučka ve velkém",
        2006 => "Vrchní prchni!",
        2005 => "Afrika",
        2004 => "Dobytí ráje",
        2003 => "Titanik",
        2002 => "",
        2001 => "",
        2000 => "",
        1999 => "První Hučka",
    ];

    const GALLERY_PATH = "/images/gallery";

    /** @var array|null */
    private $overview;

    /**
     * All festival years with theme, cover image and photo count, newest first.
     */
    public function getYears(): array {
        if ($this->overview === null) {
            $this->overview = [];
            foreach ($this->years as $year => $title) {
                $cover = null;
                if (is_file("images/pastYears/thumbnails/year{$year}.jpg")) {
                    $cover = "/images/pastYears/thumbnails/year{$year}.jpg";
                } elseif ($year === 2017) {
                    $cover = "/images/pages/plakat2017_small.jpg";
                }
                $this->overview[$year] = [
                    "year" => $year,
                    "title" => $title,
                    "cover" => $cover,
                    "count" => count($this->findThumbnails($year)),
                ];
            }
        }
        return $this->overview;
    }

    /**
     * Years that have at least one photo, newest first (used by the menu).
     */
    public function getGalleries(): array {
        return array_filter($this->getYears(), fn($y) => $y["count"] > 0);
    }

    public function fetchGallery($year): array {
        $galleries = $this->getGalleries();
        if ($year === null || !isset($galleries[$year])) {
            throw new \Nette\Application\BadRequestException("Galerie nenalezena");
        }
        $gallery = $galleries[$year];
        $gallery["images"] = [];
        foreach ($this->findThumbnails($year) as $name) {
            $gallery["images"][] = [
                "thumbnail" => self::GALLERY_PATH . "/{$year}/thumbnails/{$name}",
                "image" => self::GALLERY_PATH . "/{$year}/images/{$name}",
            ];
        }

        $keys = array_keys($galleries);
        $pos = array_search((int) $year, $keys, true);
        $gallery["newer"] = $keys[$pos - 1] ?? null;
        $gallery["older"] = $keys[$pos + 1] ?? null;
        return $gallery;
    }

    /**
     * Thumbnail file names of a year's gallery, in natural order.
     */
    private function findThumbnails(int $year): array {
        $dir = "images/gallery/{$year}/thumbnails/";
        if (!is_dir($dir)) {
            return [];
        }
        $names = [];
        foreach (Finder::findFiles('*.jpg', '*.JPG')->in($dir) as $file) {
            $names[] = $file->getFilename();
        }
        natcasesort($names);
        return array_values($names);
    }

}
