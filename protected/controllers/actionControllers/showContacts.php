<?php
namespace actionControllers;

use \Controller;
use \Yii;

class showContacts extends Controller
{
	public static function processForm() {
        if (!$_POST['models_forms_ShowContactsForm']) {
            return false;
        }
        
        if (!self::validateAndSave($_POST['models_forms_ShowContactsForm']))
            return false;
        
        self::sendMailToManager($_POST['models_forms_ShowContactsForm']);
        return true;
    }
    
    protected static function sendMailToManager($vars) {
        $text = self::createText($vars);
        $manager = \ShopUserModel::getById($vars['manager_id']);
        $mail = $manager->mail;
        $topic = 'Пользователь открыл вам контакты';
        
        Mailer::send($text, $topic, $mail);
    }
    
    protected static function createText($vars) {
        $userInfo = \Yii::app()->user->getUserData();
        $project = \Project::getActiveById($vars['project_id']);
        
        $text = "Пользователь <b>@name</b> открыл вам контакты: <br /><b>телефон</b>: @phone, <b>почта</b>:@mail, <a href='http://vk.com/id@vkid'>профиль вконтакте</a>
            <br /> в ответ на ваше предложение на заказ <a href='http://myby.com.ua/shopmanager/project/@pid'><b><@project></b></a>";
        $text = str_replace('@name', $userInfo->name.' '.$userInfo->sname, $text);
        $text = str_replace('@vkid', $userInfo->viewer_id, $text);
        $text = str_replace('@phone', $vars['phone'], $text);
        $text = str_replace('@mail', $vars['email'], $text);
        $text = str_replace('@project', $project->title, $text);
        $text = str_replace('@pid', $project->id, $text);
        
        return $text;
    }
    
    protected static function validateAndSave($vars) {
        $form = new \models\forms\ShowContactsForm();
        $form->attributes = $vars;
        $form->user_id = \Yii::app()->user->getId();
        if (!$form->validate()) {
            return false;
        }
        return self::saveToDB($form, $project_id);
    }
    
    protected static function saveToDB(\models\forms\ShowContactsForm $form) {
        $model = new \ShowedContacts();
        $model->manager_id = $form->manager_id;
        $model->user_id = $form->user_id;
        $model->mail = $form->email;
        $model->phone = $form->phone;
        $model->comment = $form->comment;
        $model->project_id = $form->project_id;
        
        $model->save();
        return true;
    }
    
}