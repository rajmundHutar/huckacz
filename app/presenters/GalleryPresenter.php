<?php

namespace App\Presenters;

use App\Model\GalleryModel;

/**
 * Description of GalleryPresenter
 *
 * @author Jaroslav
 */
class GalleryPresenter extends BasePresenter {
    
    protected $galleryModel;
    
    public function __construct(GalleryModel $galleryModel) {
        parent::__construct();
        $this->galleryModel = $galleryModel;
    }
    
    public function renderDefault($year){
        $gallery = $this->galleryModel->fetchGallery($year);
        $this->template->gallery = $gallery;
    }
}
