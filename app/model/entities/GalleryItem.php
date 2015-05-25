<?php

namespace App\Model\Entities;

/**
 * Description of GalleryItem
 *
 * @author Jaroslav
 */
class GalleryItem {
    
    protected $image;
    protected $thumbnail;
    protected $title;
    
    function getImage() {
        return $this->image;
    }

    function getThumbnail() {
        return $this->thumbnail;
    }

    function getTitle() {
        return $this->title;
    }

    function setImage($image) {
        $this->image = $image;
        return $this;
    }

    function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    function setTitle($title) {
        $this->title = $title;
        return $this;
    }


    
}
