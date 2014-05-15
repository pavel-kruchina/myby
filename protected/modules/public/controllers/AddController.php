<?php

class AddController extends Controller
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
        if (actionControllers\saveProject::ifFormSend($form))
            Yii::app()->request->redirect('/public/mylist/?add_project=1');
        
        $randomProject = Project::getRandom();
        $this->render('add', array('regform'=>$regform, 'add'=>$form, 'randomProject'=>$randomProject, 'loginForm'=>$loginForm));
	}
    
}