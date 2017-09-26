<?php

namespace App\Presenters;

use Nette\Application\UI\Form,
	App\Model\SignInTheater,
	App\Model\Entities\Theater,
	Nette\Mail\IMailer,
	Nette\Mail\Message;

/**
 * Description of LoginPresenter
 *
 * @author Jaroslav
 */
class LoginPresenter extends BasePresenter {

	protected $signInTheater;
	protected $mailer;

	public function __construct(SignInTheater $signInTheater, IMailer $mailer) {
		parent::__construct();
		$this->signInTheater = $signInTheater;
		$this->mailer = $mailer;
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

		$form->onSuccess[] = [$this, "registrationFormSucceeded"];

		return $form;
	}

	public function registrationFormSucceeded(Form $form) {
		$values = $form->getValues();

		$theater = new Theater();
		$theater->setName($values->name);
		$theater->setEmail($values->email);
		$theater->setNumber($values->numberOfPeople);
		$theater->setComment($values->comment);

		try {
			$this->signInTheater->saveTheater($theater);

			$mail = new Message();
			$mail->setFrom('Hučka <festiva@hucka.cz>')
				->addTo('rajmund.hutar@gmail.com')
				->addTo('pokornaalice@email.cz')
				->setSubject('Přihlášení divadla')
				->setBody("Nové přihlášené divadlo: {$values->name}\nKontakt: {$values->email}\nLidí: {$values->numberOfPeople}\nVzkazy: {$values->comment}");
			$this->mailer->send($mail);
			$this->flashMessage('Děkujeme za přihlášení vašeho divadla.', 'success');
		} catch (Exception $e) {
			$this->flashMessage('Došlo k chybě při ukládání divadla, pokud tutu chybu vidíte i při opakovaném pokusu, dejte nám vědět.', 'error');
		}

		$this->redirect('this');
	}

}
