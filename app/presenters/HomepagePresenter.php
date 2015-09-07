<?php

namespace App\Presenters;

use App\Model\GuestbookModel,
    App\Model\GallerySnapshotModel,
    App\Model\GalleryModel;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {

    protected $guestbookModel;
    protected $gallerySnapshotModel;

    public function __construct(GalleryModel $galleryModel, GuestbookModel $guestbookModel, GallerySnapshotModel $gallerySnapshotModel) {
        parent::__construct($galleryModel);
        $this->guestbookModel = $guestbookModel;
        $this->gallerySnapshotModel = $gallerySnapshotModel;
    }
    
    public function renderDefault() {
        $this->template->guestBook = $this->guestbookModel->fetchAll();
        $this->template->snapshots = $this->gallerySnapshotModel->fetch(4);
    }

}
