<?php
namespace actionControllers;

use \Controller;
use \Yii;

class addOffer extends Controller
{
	public static function checkOfferSend(\models\forms\AddProjectOffer $form, $project_id) {
        if (!$_POST['models_forms_AddProjectOffer']) {
            return false;
        }
        
        return self::validateAndSave($_POST['models_forms_AddProjectOffer'], $form, $project_id);
    }
    
    protected static function validateAndSave($vars, \models\forms\AddProjectOffer $form, $project_id) {
        $form->attributes = $vars;
        
        if (!$form->validate()) {
            return false;
        }
        
        self::saveToDB($form, $project_id);
        self::sendNotification($project_id);
        
        $form->offer = '';
        
        return true;
    }
    
    protected static function sendNotification($project_id) {
        $project = \Project::getActiveById($project_id);
        $user = \User::getById($project->user_id);
        
        \vendor\vk\vk::sendNotification($user->viewer_id, "По Вашему заказу <".$project->title."> есть новые предложения");
        
        return true;
    }
    
    protected static function saveToDB(\models\forms\AddProjectOffer $form, $project_id) {
        $offer = new \Offer();
        $offer->text = $form->offer;
        $offer->shop_user_id = Yii::app()->user->getId();
        $offer->date = \helpers\Date::getCurrent();
        $offer->project_id = $project_id;
        
        $offer->save();
        return true;
    }
    
}