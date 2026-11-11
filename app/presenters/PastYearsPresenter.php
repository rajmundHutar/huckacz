<?php

namespace App\Presenters;

/**
 * Overview of all festival years
 *
 * @author Jaroslav
 */
class PastYearsPresenter extends BasePresenter {

    public function renderDefault() {
        $this->template->years = $this->galleryModel->getYears();
    }
}
