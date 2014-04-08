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
        
        $offer = self::saveToDB($form, $project_id);
        self::sendNotification($offer);
        
        $form->offer = '';
        
        return true;
    }
    
    protected static function sendNotification(\Offer $offer) {
        $event = new \models\events\AddOfferEvent();
        $event->offer_id = $offer->id;
        $event->create();
        
        return true;
    }
    
    protected static function saveToDB(\models\forms\AddProjectOffer $form, $project_id) {
        $offer = new \Offer();
        $offer->text = $form->offer;
        $offer->shop_user_id = Yii::app()->user->getId();
        $offer->date = \helpers\Date::getCurrent();
        $offer->project_id = $project_id;
        
        $offer->save();
        return $offer;
    }
    
}