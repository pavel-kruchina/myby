<?php

class ShopUserAboutController extends Controller
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
        $id = (int)$_GET['id'];
        
        $shopuser = ShopUserModel::getById($id);
        if (!$shopuser->id) 
            return $this->render('shopuser-about-invalid', array());
        
        $this->render('shopuser-about', array('shopuser'=>$shopuser));
	}
}