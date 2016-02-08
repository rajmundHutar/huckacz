<?php

namespace App\Presenters;

use App\Model\GuestbookModel,
    App\Model\Entities\GuestbookComment,
    DateTime,
    App\Model\GalleryModel;

/**
 * Description of GuestbookPresenter
 *
 * @author Jaroslav
 */
class GuestbookPresenter extends BasePresenter {

    protected $guestbookModel;


    public function __construct(GuestbookModel $guestbookModel) {
        parent::__construct();
        $this->guestbookModel = $guestbookModel;
    }
    
    public function renderDefault() {
        $this->template->guestBook = $this->guestbookModel->fetchAll();
    }
    
    public function createComponentGuestbookForm() {
        $form = new \Nette\Application\UI\Form;
        
        $form->addText("name", "Jméno")
                ->setRequired("Zadejte svoje jméno");
        $form->addTextArea("comment", "Váš příspěvek")
                ->setRequired("Zadejte text zprávy");
        $form->addSubmit("save", "Přidat příspěvek");
        
        $form->onSuccess[] = $this->guestbookFormSucceeded;
        
        return $form;
    }
    
    public function guestbookFormSucceeded($form){
        $values = $form->getValues();

        $comment = new GuestbookComment();
        $comment->setName($values["name"]);
        $comment->setText($values["comment"]);
        $comment->setDate(new DateTime());
        $comment->setIp(getenv('REMOTE_ADDR'));

        $this->guestbookModel->addComment($comment);
        
        $this->flashMessage('Příspěvek přidán do návštěvní knihy', 'success');
        $this->redirect("this");        
    }
}
