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
        $form = new models\forms\ShopUserLogin();
        if (actionControllers\shopUserLogin::Login($form))
            Yii::app()->request->redirect(Yii::app()->user->returnUrl);
        
        $this->render('login', array('loginForm'=>$form));
	}
    
}