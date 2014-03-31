<?php
namespace actionControllers;

use \Controller;
use \Yii;

class addComment extends Controller
{
	public static function checkFormSend(\models\forms\AddComment $form) {
        if (!$_POST['models_forms_AddComment']) {
            return false;
        }
        
        return self::validateAndSave($_POST['models_forms_AddComment'], $form);
    }
    
    protected static function validateAndSave($vars, \models\forms\AddComment $form) {
        $form->attributes = $vars;
        
        if (!$form->validate()) {
            return false;
        }
        
        self::saveToDB($form);
        self::sendMailToManager($vars);
        
        $form->text = '';
        
        return true;
    }
    
    protected static function sendMailToManager($vars) {
        
        $offer = \Offer::getById($vars['offer_id']);
        $manager = \ShopUserModel::getById($offer->shop_user_id);
        $mail = $manager->mail;
        $topic = 'Пользователь ответил на ваше предложение';
        $text = self::createText($vars, $offer);
        
        Mailer::send($text, $topic, $mail);
    }
    
    protected static function createText($vars, \Offer $offer) {
        $userInfo = \Yii::app()->user->getUserData();
        
        $text = "Пользователь <b>@name</b> ответил на ваше предложение <<@offer>>";
        $text = str_replace('@name', $userInfo->name.' '.$userInfo->sname, $text);
        $text = str_replace('@offer', $offer->text, $text);
        
        return $text;
    }
    
    protected static function saveToDB(\models\forms\AddComment $form) {
        $userInfo = \Yii::app()->user->getUserData();
        
        $comment = new \Comment();
        $comment->text = $form->text;
        $comment->offer_id = $form->offer_id;
        $comment->user_id = $userInfo->id;
        $comment->user_type = 'user';
        $comment->date = \helpers\Date::getCurrent();
        
        $comment->save();
        
        return true;
    }
    
}