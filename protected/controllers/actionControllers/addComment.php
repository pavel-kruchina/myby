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
        
        $comment = self::saveToDB($form);
        self::setEvent($comment);
        
        $form->text = '';
        
        return true;
    }
    
    protected static function setEvent(\Comment $comment) {
        
        $event = new \models\events\AddCommentEvent();
        $event->comment_id = $comment->id;
        $event->create();
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
        
        return $comment;
    }
    
}