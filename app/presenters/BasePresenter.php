<?php

namespace App\Presenters;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    protected function createTemplate() {
        $template = parent::createTemplate();
        $template->getLatte()->addFilter('smiles', function ($s) {
            return preg_replace("~\*([0-9])+\*~i", "", $s);
        });
        return $template;
    }

}
