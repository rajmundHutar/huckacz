<?php

namespace App\Presenters;

use Nette,
    App\Model\GalleryModel;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    protected $galleryModel;
    
    public function injectGalleryModel(GalleryModel $galleryModel) {
        $this->galleryModel = $galleryModel;        
    }
    
    protected function createTemplate() {
        $template = parent::createTemplate();
        $template->getLatte()->addFilter('smiles', function ($s) {
            return preg_replace("~\*([0-9])+\*~i", "", $s);
        });
        return $template;
    }
    
    public function beforeRender() {
        parent::beforeRender();        
        
        $this->template->galleries = $this->galleryModel->getGalleries();
    }
}
