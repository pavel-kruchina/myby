<?php
namespace actionControllers;

use \Controller;
use \Yii;

class sendMailFromContacts extends Controller
{
	public static function checkMailSend(\models\forms\Contacts $form) {
        if (!$_POST['models_forms_Contacts']) {
            return false;
        }
        
        return self::validateAndSend($_POST['models_forms_Contacts'], $form);
    }
    
    protected static function validateAndSend($vars, \models\forms\Contacts $form) {
        $form->attributes = $vars;
        
        if (!$form->validate()) {
            return false;
        }
        
        $text = 'Емейл юзера: '.$form->mail.'<br />'.$form->text;
        return Mailer::send($text, "Вопрос пользователя, vk", 'ask@myby.com.ua');
    }
    
}