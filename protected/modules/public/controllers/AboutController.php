<?php

class AboutController extends Controller
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
        $regform = new \models\forms\UserRegistrationForm();
        $loginForm =  new \models\forms\UserLogin();
        $form = new models\forms\AddProject();
        
        $this->render('about', array('regform'=>$regform, 'add'=>$form, 'loginForm'=>$loginForm));
	}
}