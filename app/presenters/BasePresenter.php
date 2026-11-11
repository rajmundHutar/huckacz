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

	public function beforeRender() {

		parent::beforeRender();

		$this->template->galleries = $this->galleryModel->getGalleries();
	}

}
