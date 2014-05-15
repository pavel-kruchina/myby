<?php

class QlController extends Controller
{
    protected $index = '/public/index';


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
        $qlink = $this->getLinkByCode();
        if (!$qlink) {
            Yii::app()->request->redirect($this->index);
            return false;
        }
        
        $this->loginUserById($qlink->user_id);
        Yii::app()->request->redirect($qlink->link);
	}
    
    protected function getLinkByCode() {
        $code = $_GET['code'];
        $qlink= QuickLink::getByCode($code);
        if (empty($qlink))
            return false;
        
        return $qlink;
    }
    
    protected function loginUserById($userId) {
        $user = User::getById($userId);
        
        if (!empty($user))
            Yii::app()->user->login($user);
    }
}