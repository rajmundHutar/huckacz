<?php

namespace App\Presenters;

use App\Model\GuestbookModel,
    App\Model\GallerySnapshotModel;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {

    protected $guestbookModel;
    protected $gallerySnapshotModel;

    public function __construct(GuestbookModel $guestbookModel, GallerySnapshotModel $gallerySnapshotModel) {
        parent::__construct();
        $this->guestbookModel = $guestbookModel;
        $this->gallerySnapshotModel = $gallerySnapshotModel;
    }
    
    public function renderDefault() {
        $this->template->guestBook = $this->guestbookModel->fetchAll();
        $this->template->snapshot = $this->gallerySnapshotModel->fetch(4);
    }

}
