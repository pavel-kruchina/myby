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
            $event = new \models\events\AddProjectEvent();
            $event->project_id = $project_id;
            $event->create();
            
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