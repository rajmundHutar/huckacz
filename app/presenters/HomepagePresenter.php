<?php

namespace App\Presenters;

use App\Model\GallerySnapshotModel;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {

	/** @var GallerySnapshotModel */
    protected $gallerySnapshotModel;

    public function __construct(GallerySnapshotModel $gallerySnapshotModel) {
        $this->gallerySnapshotModel = $gallerySnapshotModel;
    }
    
    public function renderDefault() {
        $this->template->snapshots = $this->gallerySnapshotModel->fetch(6);
    }

}
