<?php
namespace actionControllers;

use \Controller;
use \Project;
use \Yii;

class saveProject extends Controller
{
	public static function ifFormSend(\models\forms\AddProject $form) {
        if (!$_POST['models_forms_AddProject']) {
            return false;
        }
        
        if ($project_id = self::validateAndSave($_POST['models_forms_AddProject'], $form)) {
            Mailer::sendToAllActiveManagers('Добавлен новый заказ "'.$form->title.'"- <a href="http://myby.com.ua/shopmanager/project/'.$project_id.'">перейти к заказу</a>', 'Новый проект на сайте MyBy');
            
            return true;
        }
        
        return false;
    }
    
    protected static function validateAndSave($vars, \models\forms\AddProject $form) {
        $form->attributes = $vars;
        
        if (!$form->validate()) {
            return false;
        }
        
        return self::saveToDB($form);
    }
    
    protected static function saveToDB(\models\forms\AddProject $form) {
        $project = new \Project();
        $project->attributes = $form->getAttributes();
        $project->user_id = Yii::app()->user->getId();
        $project->date = \helpers\Date::getCurrent();
        $project->active = 1;
        
        $project->save();
        return $project->id;
    }
    
}