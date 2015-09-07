<?php

namespace App\Presenters;

use App\Model\GalleryModel;

/**
 * Description of GalleryPresenter
 *
 * @author Jaroslav
 */
class GalleryPresenter extends BasePresenter {
    
    public function renderDefault($year){
        $gallery = $this->galleryModel->fetchGallery($year);
        $this->template->gallery = $gallery;
    }
}
