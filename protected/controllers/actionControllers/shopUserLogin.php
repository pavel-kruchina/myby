<?php
namespace actionControllers;

use \Controller;
use \ShopUserModel;
use \Yii;

class shopUserLogin extends Controller
{
    protected static $form_key = 'models_forms_ShopUserLogin';


    public static function Login(\models\forms\ShopUserLogin $form) {
        if (!self::isFormSent($form)) 
            return false;
        
        if (!self::checkAuthData($_POST[self::$form_key], $form))
            return false;
        
        $shopUser = self::findUserByMailAndPassword($form);
        return self::updateUserInfo($shopUser);
    }
    
    protected static function updateUserInfo($shopUser) {
        if (!$shopUser)
            return false;
        
        Yii::app()->user->login($shopUser);
        
        return true;
    }

    protected static function isFormSent(\models\forms\ShopUserLogin $form) {
        if (!$_POST[self::$form_key]) {
            return false;
        }
        
        return true;
    }
    
    protected static function checkAuthData($vars, \models\forms\ShopUserLogin $form) {
        $form->attributes = $vars;
        
        if (!$form->validate()) {
            return false;
        }
        
        return true;
    }
    
    protected static function findUserByMailAndPassword(\models\forms\ShopUserLogin $form) {
        $mail = trim($form->mail);
        $password = ShopUserModel::getPasswordHash($form->password);
        
        $shopUser = ShopUserModel::model()->find('active=1 and mail=:mail and password=:password',array(':mail'=>$mail, ':password'=>$password));
        
        return self::checkFindedUser($shopUser, $form);
    }
    
    protected static function checkFindedUser($shopUser, \models\forms\ShopUserLogin $form) {
        if (!$shopUser) {
            $shopUser = false;
            $form->addError('mail', 'Mail или пароль введены не верно');
        }
        
        return $shopUser;
    }
        
}