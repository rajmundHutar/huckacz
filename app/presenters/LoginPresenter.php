<?php

namespace App\Presenters;

use Nette\Application\UI\Form,
    App\Model\SignInTheater,
    App\Model\Entities\Theater,
    App\Model\GalleryModel;

/**
 * Description of LoginPresenter
 *
 * @author Jaroslav
 */
class LoginPresenter extends BasePresenter {

    protected $signInTheater;

    public function __construct(SignInTheater $signInTheater) {
        parent::__construct();
        $this->signInTheater = $signInTheater;
    }

    protected function createComponentSignInForm() {
        $form = new Form;

        $form->addText('name')
                ->setRequired("Vyplňte název divadla");

        $form->addText('email')
                ->setRequired("Vyplňte váš e-mail")
                ->addRule(Form::EMAIL, "Vyplňte existující e-mailovou adresu");

        $form->addText('numberOfPeople')
                ->setRequired("Vyplňte počet lidí ve vašem divadle")
                ->addRule(Form::INTEGER, "Zadejte celé číslo");

        $form->addTextArea('comment');

        $form->addSubmit('send', 'Přihlásit divadlo');

        $form->onSuccess[] = $this->registrationFormSucceeded;

        return $form;
    }

    public function registrationFormSucceeded(Form $form) {
        $values = $form->getValues();

        $theater = new Theater();
        $theater->setName($values->name);
        $theater->setEmail($values->email);
        $theater->setNumber($values->numberOfPeople);
        $theater->setComment($values->comment);

        $res = $this->signInTheater->saveTheater($theater);
        if ($res) {
            $this->flashMessage('Děkujeme za přihlášení vašeho divadla.', 'success');
        } else {
            $this->flashMessage('Došlo k chybě při ukládání divadla, pokud tutu chybu vidíte i při opakovaném pokusu, dejte nám vědět.', 'error');
        }
        $this->redirect('this');
    }
}
