<?php

class LogoutController extends Controller
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
                'users'=>array('@'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
       
    public function actionIndex()
	{
        Yii::app()->user->logout();
		Yii::app()->request->redirect('/shopmanager/');
	}
    
}