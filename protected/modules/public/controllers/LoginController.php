<?php

class LoginController extends Controller
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
                'actions'=>array('index', 'ajaxlogin'),
                'users'=>array('*'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionIndex()
	{
        $loginForm = new \models\forms\UserLogin();
        $loginForm->autoFill();
        
        if (\models\forms\UserLogin::sent()) {
            if ($this->login($loginForm)) {
                Yii::app()->request->redirect(Yii::app()->user->returnUrl);
            }
        }
        
        $this->render('index', array('loginForm'=>$loginForm));
	}
    
     public function actionAjaxLogin()
	{
        $loginForm = new \models\forms\UserLogin();
        $loginForm->autoFill();
        
        if (\models\forms\UserLogin::sent()) {
            echo json_encode(array('is_error'=>!$this->login($loginForm)));
        }
        
        Yii::app()->end();
	}
    
    protected function login(\models\forms\UserLogin $form) {
        if (!$form->validate())
            return false;
        
        $user = User::getByMail($form->mail);
        if ($user && User::getPasswordHash($form->password)==$user->password) {
            Yii::app()->user->login($user);
            return true;
        }
            
        $form->addError('mail', 'Не существует пользователя с таким e-mail или паролем');
        return false;
    }
    
}