<?php

class RegController extends Controller
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
        if (\models\forms\UserRegistrationForm::sent())
        {
            echo json_encode($this->tryReg());
        }
        Yii::app()->end();
	}
    
    protected function tryReg() {
        $form = new \models\forms\UserRegistrationForm();
        $form->autoFill();
        if (!$form->validate())
            return array('is_error'=>true, 'errors'=>$form->getErrors());
        
        if (User::getByMail($form->mail))
            return array('is_error'=>true, 'errors'=>array('mail'=>1), 'mailExists'=>1);
        
        return $this->regUser($form);
    }
    
    protected function regUser(models\forms\UserRegistrationForm $form) {
        $user = new User();
        $user->create_date = helpers\Date::getCurrent();
        $user->name = $form->name;
        $user->sname = $form->sname;
        $user->mail = $form->mail;
        $user->password = $user->getPasswordHash($form->password);
        
        $user->save();
        Yii::app()->user->login($user);
        
        $this->sendNotification($form, $user);
        
        return array('is_error'=>false);
    }
    
    protected function sendNotification(models\forms\UserRegistrationForm $form, User $user) {
        $text = $this->createTextForRegLetter($form, $user);
        $topic = 'Спасибо за регистрацию';
        $email = $form->mail;
        
        actionControllers\Mailer::send($text, $topic, $email, MAIL_TYPE_REGISTRATION);
    }
    
    protected function createTextForRegLetter(models\forms\UserRegistrationForm $form, User $user) {
        $text = 'Спасибо за регистрацию на MyBy. Ваш пароль: '.$form->password;
        $qlink = QuickLink::createLink('/public/index', $user->id);
        $text .= '<br /> Вы также можете зайти, использая эту ссылку - <a href="http://myby.com.ua/public'.$qlink.'">вход</a>';
        
        return $text;
    }
    
}