<?php

class ContactsController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionIndex()
	{
        $form = new models\forms\Contacts();
        $message = false;
        
        if (actionControllers\sendMailFromContacts::checkMailSend($form))
            $message = 'Мы приняли ваш запрос, и постараемся в ближайшее время на него ответить';
        
        $this->render('contacts', array('contactsForm'=>$form, 'message'=>$message));
	}
}